<?php

namespace BetterTransposh\Core;

use Psr\Log\LoggerTrait;
use Stringable;

class Query_Monitor_Logger {
	use LoggerTrait;

	/** @var self Singelton instance of our logger */
	protected static $instance = null;

	/**
	 * Print a message to log.
	 *
	 * @param mixed $message
	 * @param int $severity
	 */
	public function do_log( $message, $severity = 3 ) {
		if ( is_object( $message ) ) {
			$this->log( $this->severity_to_level( $severity ), 'Object', [ 'object' => $message ] );
		} elseif ( is_array( $message ) ) {
			$this->log( $this->severity_to_level( $severity ), 'Array', $message );
		} else {
			$this->log( $this->severity_to_level( $severity ), $message );
		}
	}

	private function severity_to_level( $severity ) {
		return match ( $severity ) {
			0 => 'emergency',
			1 => 'alert',
			2 => 'critical',
			3 => 'error',
			4 => 'warning',
			5 => 'notice',
			6 => 'info',
			default => 'debug',
		};
	}

	public function log( $level, Stringable|string $message, array $context = [] ): void {
		do_action( "qm/$level", $message, $context );
	}

	/**
	 * Gets singleton instance of logger
	 *
	 * @param boolean $AutoCreate
	 *
	 * @return self
	 */
	public static function getInstance( $AutoCreate = false ) {
		if ( $AutoCreate === true && ! self::$instance ) {
			self::init();
		}

		return self::$instance;
	}

	/**
	 * Creates logger object and stores it for singleton access
	 * @return self
	 */
	public static function init() {
		return self::$instance = new self();
	}

}
