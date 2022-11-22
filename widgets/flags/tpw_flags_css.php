<?php
/**
 * Plugin Name: Flags (With CSS)
 * Plugin URI: http://transposh.org/
 * Description: Widget with flags links (Using css sprites)
 * Author: Team Transposh
 * Version: 1.0
 * Author URI: http://transposh.org/
 * License: GPL (http://www.gnu.org/licenses/gpl.txt)
 */

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