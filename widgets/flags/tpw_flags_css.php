<?php

use OpenTransposh\Core\Utilities;
use OpenTransposh\Widgets\Base_Widget;

class tpw_flags_css extends Base_Widget {

	/**
	 * Creates the list of flags (with css)
	 *
	 * @param array $args
	 */
	static function tp_widget_do( $args ) {
		echo "<div class=\"" . NO_TRANSLATE_CLASS . " transposh_flags\" >";
		foreach ( $args as $langrecord ) {
			echo "<a href=\"{$langrecord['url']}\"" . ( $langrecord['active'] ? ' class="tr_active"' : '' ) . '>' .
			     Utilities::display_flag( "", $langrecord['flag'], $langrecord['langorig'], true ) .
			     "</a>";
		}
		echo "</div>";
	}

}
