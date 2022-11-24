<?php

use OpenTransposh\Core\Utilities;
use OpenTransposh\Plugin;
use OpenTransposh\Widgets\Base_Widget;

class tpw_list_with_flags extends Base_Widget {

	/**
	 * Instructs usage of a different .css file
	 * @global Plugin $my_transposh_plugin
	 */
	static function tp_widget_css( $file, $dir, $url ) {
		wp_enqueue_style( "flags_tpw_flags", "$url/widgets/flags/tpw_flags.css", array(), TRANSPOSH_PLUGIN_VER );
	}

	/**
	 * Creates the list of flags - followed by a language name link
	 *
	 * @param array $args
	 *
	 * @global Plugin $my_transposh_plugin
	 */
	static function tp_widget_do( $args ) {
		global $my_transposh_plugin;
		// we calculate the plugin path part, so we can link the images there
		$plugpath = parse_url( $my_transposh_plugin->transposh_plugin_url, PHP_URL_PATH );

		echo "<div class=\"" . NO_TRANSLATE_CLASS . " transposh_flags\" >";
		foreach ( $args as $langrecord ) {
			echo "<a href=\"{$langrecord['url']}\"" . ( $langrecord['active'] ? ' class="tr_active"' : '' ) . '>' .
			     Utilities::display_flag( "$plugpath/img/flags", $langrecord['flag'], $langrecord['langorig'], false ) . "</a>";
			echo "<a href=\"{$langrecord['url']}\"" . ( $langrecord['active'] ? ' class="tr_active"' : '' ) . '>' . "{$langrecord['langorig']}</a><br/>";
		}
		echo "</div>";
	}

}
