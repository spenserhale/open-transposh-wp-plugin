<?php
/**
 * Plugin Name: Open Transposh Translation Filter
 * Plugin URI: https://github.com/spenserhale/open-transposh-wp-plugin
 * Description: Translation Filter Plugin for WordPress offers a unique approach to blog translation. It allows your blog to combine automatic and human translation aided by your users with an easy-to-use in-context interface.
 * Author: Open Transposh Community
 * Version: 2.0.0
 * License: GPL V3 (https://www.gnu.org/licenses/gpl-3.0.txtt)
 * Text Domain: transposh
 *Domain Path: /langs
 */

/**
 * Open Transposh 2.0.0 a fork of Transposh
 *
 * Copyright 2022 by Spenser Hale
 * Copyright 2009 - 2022 by Transposh Team (Ofer Wald)
 *
 * Licensed under GNU General Public License 3.0 or later.
 * Some rights reserved. See COPYING, AUTHORS.
 *
 * @license GPL-3.0+ <http://spdx.org/licenses/GPL-3.0+>
 */

/**
 * simplehtmldom Copyright
 *
 * Version: 1.11 ($Rev: 175 $)
 * Website: http://sourceforge.net/projects/simplehtmldom/
 * Author: S.C. Chen <me578022@gmail.com>
 * Acknowledge: Jose Solorzano (https://sourceforge.net/projects/php-html/)
 * Contributions by:
 * Yousuke Kumakura (Attribute filters)
 * Vadim Voituk (Negative indexes supports of "find" method)
 * Antcs (Constructor with automatically load contents either text or file/url)
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 **/

//avoid direct calls to this file where wp core files not present

defined( 'ABSPATH' ) or die();

require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/constants.php';
require __DIR__ . '/legacy.php';
require __DIR__ . '/functions.php';

$open_transposh_plugin = OpenTransposh\Plugin::get_instance(__FILE__);

/** @var OpenTransposh\Plugin|transposh_plugin $my_transposh_plugin */
$my_transposh_plugin = new transposh_plugin($open_transposh_plugin);

/** @var OpenTransposh\Logging\Logger|tp_logger $tp_logger */
$tp_logger = new tp_logger(new OpenTransposh\Logging\Logger());
