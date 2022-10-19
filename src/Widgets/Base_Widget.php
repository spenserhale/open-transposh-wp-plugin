<?php

namespace BetterTransposh\Widgets;

/**
 * Class for subwidgets to inherit from
 */
class Base_Widget {

	/**
	 * Function that performs the actual subwidget rendering
	 */
	static function tp_widget_do( $args ) {
		echo "you should override this function in your widget";
	}

	/**
	 * Attempts inclusion of css needed for the subwidget
	 *
	 * @param string $file
	 * @param string $plugin_dir
	 * @param string $plugin_url
	 */
	static function tp_widget_css( $file, $plugin_dir, $plugin_url ) {
		tp_logger( 'looking for css:' . $file, 4 );
		$basefile   = substr( $file, 0, - 4 );
		$widget_css = TRANSPOSH_DIR_WIDGETS . '/' . $basefile . ".css";
		if ( file_exists( $plugin_dir . $widget_css ) ) {
			wp_enqueue_style( str_replace( '/', '_', $basefile ), $plugin_url . '/' . $widget_css, '', TRANSPOSH_PLUGIN_VER );
		}
	}

	/**
	 * Attempts inclusion of javascript needed for the subwidget
	 *
	 * @param string $file
	 * @param string $plugin_dir
	 * @param string $plugin_url
	 */
	static function tp_widget_js( $file, $plugin_dir, $plugin_url ) {
		tp_logger( 'looking for js:' . $file, 4 );
		$basefile  = substr( $file, 0, - 4 );
		$widget_js = TRANSPOSH_DIR_WIDGETS . '/' . $basefile . ".js";
		if ( file_exists( $plugin_dir . $widget_js ) ) {
			wp_enqueue_script( 'transposh_widget', $plugin_url . '/' . $widget_js, '', TRANSPOSH_PLUGIN_VER );
		}
	}

}