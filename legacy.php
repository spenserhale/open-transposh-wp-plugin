<?php

use OpenTransposh\Core\{Constants, Parser, Parser_Stats, Utilities};
use OpenTransposh\Legacy\{Legacy_Adapter};
use OpenTransposh\Widgets\{Base_Widget, Plugin_Widget};

/**
 * Legacy Transposh Names for Backwards Compatibility
 */

class tp_logger extends Legacy_Adapter {}

class transposh_plugin extends Legacy_Adapter {}

class transposh_consts extends Constants {}

class transposh_utils extends Utilities {}

class tp_parserstats extends Parser_Stats {}

class tp_parser extends Parser {}

class transposh_base_widget extends Base_Widget {}

class transposh_plugin_widget extends Plugin_Widget {}
