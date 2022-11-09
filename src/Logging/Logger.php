<?php

namespace BetterTransposh\Logging;

use BetterTransposh\Core\Utilities;
use BetterTransposh\Libraries\ChromePhp;
use BetterTransposh\Traits\Static_Instance_Trait;

class Logger {
	use Static_Instance_Trait;

	/** @var string Name of file to log into */
	private $logfile;

	/** @var int Tracing level, 0 is disabled (almost) and higher numbers show more debug info */
	private $debug_level = 3;

	/** @var boolean should logging be outputted to stdout */
	public $printout = false;

	/** @var boolean should logging outputted to stdout include an EOL */
	public $eolprint = false;

	/** @var boolean shell we show which function called the logger */
	public $show_caller = true;

	/** @var mixed used for remote firephp debugging */
	private $remoteip;

	private $global_log = 0;

	private $logstr = "";

	public function __construct() {
		// If not outputting to stdout, we should buffer so firephp will work
		if ( ! $this->printout ) {
			ob_start();
		}
	}

	/**
	 * Print a message to log.
	 *
	 * @param mixed $msg
	 * @param int $severity
	 */
	public function do_log( $msg, $severity = 3, $do_backtrace = false, $nest = 0 ) {
		//globalvarlogging
		if ( $severity < $this->global_log ) {
			$this->logstr .= $msg . "<br>";
		}
		if ( $severity <= $this->debug_level ) {
			if ( $this->show_caller ) {
				$trace = debug_backtrace();
				if ( $do_backtrace ) {
					ChromePhp::log( $trace[3] );
				}
				if ( isset( $trace[ 2 + $nest ]['class'] ) ) {
					$log_prefix = str_pad( "{$trace[2 + $nest]['class']}::{$trace[2 + $nest]['function']} {$trace[1 + $nest]['line']}", 55 + $nest, '_' );
				} else {
					$prefile    = substr( $trace[ 1 + $nest ]['file'], strrpos( $trace[ 1 + $nest ]['file'], "/" ) );
					$log_prefix = str_pad( "{$prefile}::{$trace[1 + $nest]['function']} {$trace[1 + $nest]['line']}", 55 + $nest, '_' );
				}
			}
			if ( isset( $this->logfile ) && $this->logfile ) {
				if ( ! is_array( $msg ) && ! is_object( $msg ) ) {
					error_log( date( DATE_W3C ) . " $log_prefix: " . $msg . "\n", 3, $this->logfile );
				} else {
					if ( is_array( $msg ) ) {
						error_log( date( DATE_W3C ) . " $log_prefix: Array start\n", 3, $this->logfile );
					} else {
						error_log( date( DATE_W3C ) . " $log_prefix: Object start\n", 3, $this->logfile );
					}
					foreach ( $msg as $key => $item ) {
						if ( ! is_array( $item ) ) {
							if ( ! is_object( $item ) || method_exists( $item, '__toString' ) ) {
								error_log( date( DATE_W3C ) . " $log_prefix: $key => $item\n", 3, $this->logfile );
							}
						} else {
							error_log( date( DATE_W3C ) . " $log_prefix: subarray -> $key\n", 3, $this->logfile );
							$this->do_log( $item, $severity, false, $nest + 1 );
						}
					}
					error_log( date( DATE_W3C ) . " $log_prefix: Array stop\n", 3, $this->logfile );
				}
			}
			if ( $this->printout/* || !isset($this->firephp) */ ) {
				echo "$log_prefix:$msg";
				echo ( $this->eolprint ) ? "\n" : "<br/>";
			} else {
				if ( ! Utilities::get_clean_server_var( 'REMOTE_ADDR' ) || $this->remoteip != Utilities::get_clean_server_var( 'REMOTE_ADDR' ) ) {
					return;
				}
				if ( ( is_array( $msg ) || is_object( $msg ) ) && $this->show_caller ) {
					ChromePhp::groupCollapsed( "$log_prefix: object/array" );
					ChromePhp::log( $msg );
					ChromePhp::groupEnd();
				} else if ( is_array( $msg ) || is_object( $msg ) ) {
					ChromePhp::log( $msg );
				} else {
					ChromePhp::log( "$log_prefix:$msg" );
				}
			}
		}
	}

	public function set_debug_level( $int ) {
		$this->debug_level = $int;
	}

	public function set_global_log( $int ) {
		if ( $int == 0 ) {
			$this->logstr = "";
		}
		$this->global_log = $int;
	}

	public function get_logstr() {
		return $this->logstr;
	}

	public function set_log_file( $filename ) {
		$this->logfile = $filename;
	}

	public function set_remoteip( $remoteip ) {
		$this->remoteip = $remoteip;
	}

}
