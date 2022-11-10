<?php

namespace OpenTransposh\Logging;

use Psr\Log\LoggerTrait;
use Stringable;

class Query_Monitor_Logger {
	use LoggerTrait;

	public function log( $level, Stringable|string $message, array $context = [] ): void {
		do_action( "qm/$level", $message, $context );
	}
}
