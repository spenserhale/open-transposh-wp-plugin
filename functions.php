<?php

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
