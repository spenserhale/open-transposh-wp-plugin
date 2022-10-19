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

defined( 'ABSPATH' ) or die();

require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/constants.php';
require __DIR__ . '/legacy.php';
require __DIR__ . '/functions.php';

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
