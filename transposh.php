<?php

/*
  Plugin Name: Transposh Translation Filter
  Plugin URI: https://transposh.org/
  Description: Translation filter for WordPress, After enabling please set languages at the <a href="admin.php?page=tp_main">the options page</a> Want to help? visit our development site at <a href="https://github.com/oferwald/transposh">github</a>.
  Author: Team Transposh
  Version: %VERSION%
  Author URI: https://transposh.org/
  License: GPL (https://www.gnu.org/licenses/gpl.txt)
  Text Domain: transposh
  Domain Path: /langs
 */

/*
 * Transposh v%VERSION%
 * https://transposh.org/
 *
 * Copyright %YEAR%, Team Transposh
 * Licensed under the GPL Version 2 or higher.
 * https://transposh.org/license
 *
 * Date: %DATE%
 */

/* * *****************************************************************************
  Version: 1.11 ($Rev: 175 $)
  Website: http://sourceforge.net/projects/simplehtmldom/
  Author: S.C. Chen <me578022@gmail.com>
  Acknowledge: Jose Solorzano (https://sourceforge.net/projects/php-html/)
  Contributions by:
  Yousuke Kumakura (Attribute filters)
  Vadim Voituk (Negative indexes supports of "find" method)
  Antcs (Constructor with automatically load contents either text or file/url)
  Licensed under The MIT License
  Redistributions of files must retain the above copyright notice.
 * ***************************************************************************** */

//avoid direct calls to this file where wp core files not present

if (!function_exists('add_action')) {
    header('Status: 403 Forbidden');
    header('HTTP/1.1 403 Forbidden');
    exit();
}

require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/constants.php';
require __DIR__ . '/legacy.php';

// We create a global singelton instance
$GLOBALS['tp_logger'] = tp_logger::getInstance( true );


require_once("wp/transposh_db.php");
require_once("wp/transposh_widget.php");
require_once("wp/transposh_admin.php");
require_once("wp/transposh_options.php");
require_once("wp/transposh_postpublish.php");
require_once("wp/transposh_backup.php");
require_once("wp/transposh_3rdparty.php");
require_once("wp/transposh_mail.php");
//require_once("wp/transposh_wpmenu.php");

$my_transposh_plugin = new BetterTransposh\Plugin();

// some global functions for programmers

/**
 * Function provided for old widget include code compatability
 * @param array $args Not needed
 */
function transposh_widget($args = array(), $instance = array('title' => 'Translation'), $extcall = false) {
    global $my_transposh_plugin;
    $my_transposh_plugin->widget->widget($args, $instance, $extcall); //TODO!!! 
}

/**
 * Function for getting the current language
 * @return string
 */
function transposh_get_current_language() {
    global $my_transposh_plugin;
    return $my_transposh_plugin->target_language;
}

/**
 * Function for use in themes to allow different outputs
 * @param string $default - the default text in the default language
 * @param array $altarray - array including alternatives in the format ("es" => "hola")
 */
function transposh_echo($default, $altarray) {
    global $my_transposh_plugin;
    if (isset($altarray[transposh_get_current_language()])) {
        if (transposh_get_current_language() != $my_transposh_plugin->options->default_language) {
            echo TP_GTXT_BRK . $altarray[transposh_get_current_language()] . TP_GTXT_BRK_CLOSER;
        } else {
            echo $altarray[transposh_get_current_language()];
        }
    } else {
        echo $default;
    }
}

/**
 * This function provides easier access to logging using the singleton object
 * @param mixed $msg
 * @param int $severity
 */
function tp_logger($msg, $severity = 3, $do_backtrace = false) {
    global $my_transposh_plugin;
    if (isset($my_transposh_plugin) && is_object($my_transposh_plugin) && !$my_transposh_plugin->options->debug_enable) {
        return;
    }
    $GLOBALS['tp_logger']->do_log($msg, $severity, $do_backtrace);
}
