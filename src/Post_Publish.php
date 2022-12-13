<?php

namespace OpenTransposh;

use JsonException;
use OpenTransposh\Core\Constants;
use OpenTransposh\Core\Parser;
use OpenTransposh\Logging\LogService;
use OpenTransposh\Traits\Enqueues_Styles_And_Scripts;

/**
 * Provides the side widget in the page/edit pages which will do translations
 *
 * class that makes changed to the edit page and post page, adding our change to the sidebar
 */
class Post_Publish {
    use Enqueues_Styles_And_Scripts;

	/** @var Plugin Container class */
	private Plugin $transposh;

	/** @var bool Did we just edit or save? */
	private bool $just_published = false;

	/**
	 *
	 * Construct our class
	 *
	 * @param  Plugin  $transposh
	 */
	public function __construct( Plugin $transposh ) {
		$this->transposh = $transposh;
		// we need this anyway because of the change language selection
		add_action( 'edit_post', [ &$this, 'on_edit_update_post_meta' ] );
		add_action( 'admin_menu', [ &$this, 'on_admin_menu_add_meta_boxes' ] );
		add_action( 'admin_menu', [ &$this, 'on_admin_menu_enqueue_styles_and_scripts' ] );
	}

	public function on_admin_menu_add_meta_boxes(): void {
		$post_type = get_current_screen()->post_type ?? null;
		if( $post_type === null ) {
			return;
		}

		if ( in_array( $post_type, [ 'attachment', 'revision', 'nav_menu_item' ], true ) ) {
			return;
		}

		if ( $this->transposh->options->enable_autoposttranslate ) {
			add_meta_box(
				'transposh_post publish',
				__( 'Open Transposh', TRANSPOSH_TEXT_DOMAIN ),
				[ $this, "transposh_post_publish_box" ],
				$post_type,
				'side',
				'core'
			);
		}

		add_meta_box(
			'transposh_set language',
			__( 'Set post language', TRANSPOSH_TEXT_DOMAIN ),
			[ $this, "transposh_set_language_box" ],
			$post_type,
			'advanced',
			'core'
		);
	}

	/**
	 * Admin menu created action, where we create our meta boxes
	 */
	public function on_admin_menu_enqueue_styles_and_scripts(): void {
		$post_id = $this->get_post_id();
		if ( ! $post_id ) {
			return;
		}

		if ( ! get_post_meta( $post_id, 'transposh_can_translate', true ) ) {
			return;
		}

		$this->just_published = true;
		$this->enqueueFooterScript( "transposh_backend", '/admin/backendtranslate.js', [ 'transposh' ] );
		try {
			wp_localize_script( "transposh_backend", "t_be", [
				'post'             => $post_id,
				'l10n_print_after' =>
					't_be.a_langs = ' . json_encode( Constants::$engines['a']['langs'],	JSON_THROW_ON_ERROR ) . ';' .
					't_be.b_langs = ' . json_encode( Constants::$engines['b']['langs'],	JSON_THROW_ON_ERROR ) . ';' .
					't_be.g_langs = ' . json_encode( Constants::$engines['g']['langs'],	JSON_THROW_ON_ERROR ) . ';' .
					't_be.y_langs = ' . json_encode( Constants::$engines['y']['langs'], JSON_THROW_ON_ERROR ) . ';'
			] );
		} catch ( JsonException $e ) {
			/** @noinspection ForgottenDebugOutputInspection */
			error_log( $e->getMessage() );
		}
		wp_enqueue_script( 'jquery-ui-progressbar' );
		wp_enqueue_style( 'jqueryui', $this->jquerySource('/themes/ui-lightness/jquery-ui.min.css'), [], JQUERYUI_VER );

		// as we have used the meta - it can go now, another option would have been to put this in the get phrases
		delete_post_meta( $post_id, 'transposh_can_translate' );
	}

	/**
	 * Function to allow mass translate of tags
	 * @return array list of tags
	 */
	public function get_tags(): array {
		$tags    = get_terms( 'post_tag' ); // Always query top tags
		$phrases = [];
		foreach ( $tags as $tag ) {
			$phrases[] = $tag->name;
		}

		return $phrases;
	}

	/**
	 * Loop through all the post phrases and return them in json formatted script
	 *
	 * @param  int  $post_id
	 */
	public function get_post_phrases( int $post_id ): void {
		// Some security, to avoid others from seeing private posts
		// fake post for tags
		if ( $post_id === - 555 ) {
			$phrases = $this->get_tags();
			$title   = "tags";
		} // a normal post
		else {
			if ( ! current_user_can( 'edit_post', $post_id ) ) {
				return;
			}
			global $post; // the id is needed because some of the functions below expect it...
			$post = get_post( $post_id );
			// Display filters
			$title            = apply_filters( 'the_title', $post->post_title );
			$content          = apply_filters( 'the_content', $post->post_content );
			$the_content_feed = apply_filters( 'the_content_feed', $content );
			$excerpt          = apply_filters( 'get_the_excerpt', $post->post_excerpt );
			$excerpt_rss      = apply_filters( 'the_excerpt_rss', $excerpt );

			//TODO - get comments text

			$parser   = new Parser();
			$phrases  = $parser->get_phrases_list( $content );
			$phrases2 = $parser->get_phrases_list( $title );
			$phrases3 = $parser->get_phrases_list( $the_content_feed );
			$phrases4 = $parser->get_phrases_list( $excerpt );
			$phrases5 = $parser->get_phrases_list( $excerpt_rss );

			// Merge the two arrays for traversing
			$phrases = array_merge( $phrases, $phrases2, $phrases3, $phrases4, $phrases5 );
			LogService::legacy_log( $phrases, 4 );

			// Add phrases from permalink
			if ( $this->transposh->options->enable_url_translate ) {
				$permalink = get_permalink( $post_id );
				$permalink = substr( $permalink, strlen( $this->transposh->home_url ) + 1 );
				foreach ( explode( '/', $permalink ) as $part ) {
					if ( ! $part || is_numeric( $part ) ) {
						continue;
					}
					$part      = str_replace( '-', ' ', $part );
					$phrases[] = urldecode( $part );
				}
			}
		}
		// We provide the post title here
		$json['posttitle'] = $title;
		// and all languages we might want to target
		$json['langs'] = [];

		foreach ( $phrases as $key ) {
			foreach ( explode( ',', $this->transposh->options->viewable_languages ) as $lang ) {
				// if this isn't the default language or we specifically allow default language translation, we will seek this out...
				// as we don't normally want to auto-translate the default language -FIX THIS to include only correct stuff, how?
				if ( $this->transposh->options->enable_default_translate || ! $this->transposh->options->is_default_language( $lang ) ) {
					// There is no point in returning phrases, languages pairs that cannot be translated
					if ( in_array( $lang, Constants::$engines['b']['langs'] ) ||
					     in_array( $lang, Constants::$engines['g']['langs'] ) ||
					     in_array( $lang, Constants::$engines['y']['langs'] ) ||
					     in_array( $lang, Constants::$engines['a']['langs'] ) ) {
						[ $source, $translation ] = $this->transposh->database->fetch_translation( $key, $lang );
						if ( ! $translation ) {
							// p stands for phrases, l stands for languages, t is token
							if ( ! @is_array( $json['p'][ $key ]['l'] ) ) {
								$json['p'][ $key ]['l'] = [];
							}
							$json['p'][ $key ]['l'][] = $lang;
							if ( ! in_array( $lang, $json['langs'] ) ) {
								$json['langs'][] = $lang;
							}
						}
					}
				}
			}
			// only if a languages list was created we'll need to translate this
			if ( @is_array( $json['p'][ $key ]['l'] ) ) {
				//$json['p'][$key]['t'] = $key;//OpenTransposh\Core\transposh_utils::base64_url_encode($key);
				@$json['length'] ++;
			}
		}

		// the header helps with debugging
		header( "Content-type: text/javascript" );
		try {
			echo json_encode( $json, JSON_THROW_ON_ERROR );
		} catch ( JsonException $e ) {
			/** @noinspection ForgottenDebugOutputInspection */
			error_log( $e->getMessage() );
			echo "{\"error\":\"{$e->getMessage()}\"}";
		}
	}

	/**
	 * This is the box that appears on the side
	 */
	public function transposh_post_publish_box(): void {
		$post_id = $this->get_post_id();
		if ( $post_id && get_post_meta( $post_id, 'transposh_can_translate', true ) ) {
			$this->just_published = true;
		}

		if ( $this->just_published ) {
			echo '<div id="tr_loading">Publication happened - loading phrases list...</div>';
		} else {
			echo 'Waiting for publication';
		}
	}

	/**
	 * This is a selection of language box which should hopefully appear below the post edit
	 */
	public function transposh_set_language_box(): void {
		$post_id = $this->get_post_id();
		if ( ! $post_id ) {
			return;
		}
		$lang = get_post_meta( $post_id, 'tp_language', true );
		echo '<select name="transposh_tp_language">';
		echo '<option value="">' . __( 'Default' ) . '</option>';
		foreach ( $this->transposh->options->get_sorted_langs() as $langcode => $langrecord ) {
			[ $langname, $langorigname, $flag ] = explode( ",", $langrecord );
			echo '<option value="' . $langcode . ( $langcode == $lang ? '" selected="selected' : '' ) . '">' . $langname . ' - ' . $langorigname . '</option>';
		}
		echo '</select>';
	}

	/**
	 * When this happens, the boxes are not created we now use a meta to inform the next step (cleaner)
	 * we now also update the tp_language meta for the post
	 */
	public function on_edit_update_post_meta( $post_id ): void {
		$raw_transposh_tp_language = filter_input( INPUT_POST, 'transposh_tp_language' );
		// This should prevent the meta from being added when not needed
		if ( empty( $raw_transposh_tp_language ) ) {
			return;
		}

		$transposh_tp_language = sanitize_key( $raw_transposh_tp_language );
		if ( $this->transposh->options->enable_autoposttranslate ) {
			add_post_meta( $post_id, 'transposh_can_translate', 'true', true );
		}
		if ( empty( $transposh_tp_language ) ) {
			delete_post_meta( $post_id, 'tp_language' );
		} else {
			update_post_meta( $post_id, 'tp_language', $transposh_tp_language );
			// if a language is set for a post, default language translate must be enabled, so we enable it
			if ( ! $this->transposh->options->enable_default_translate ) {
				$this->transposh->options->enable_default_translate = true;
				$this->transposh->options->update_options();
			}
		}
	}

	private function get_post_id(): int|null|false {
		return filter_input( INPUT_GET, 'post', FILTER_VALIDATE_INT );
	}

}

