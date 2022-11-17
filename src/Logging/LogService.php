<?php

namespace OpenTransposh\Logging;

class LogService {
	private static Logger|NullLogger|Query_Monitor_Logger $instance;

	public static function set_instance( Logger|NullLogger|Query_Monitor_Logger $instance ) {
		self::$instance = $instance;
	}

	public static function legacy_log( $message, $severity = 3 ) {
		$level = match ( $severity ) {
			0 => 'emergency',
			1 => 'alert',
			2 => 'critical',
			3 => 'error',
			4 => 'warning',
			5 => 'notice',
			6 => 'info',
			default => 'debug',
		};

		if ( is_object( $message ) ) {
			$message = 'Object: ' . var_export( $message, true );
		} elseif ( is_array( $message ) ) {
			$message = 'Array: ' . var_export( $message, true );
		}

		self::$instance->log( $level, $message );
	}
}
