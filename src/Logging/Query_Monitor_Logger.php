<?php

namespace OpenTransposh\Logging;

use Stringable;
use Throwable;
use WP_Error;

class Query_Monitor_Logger {

	/**
	 * @param  string|Stringable|Throwable|WP_Error  $message
	 * @param  array<string, mixed>  $context
	 */
	public static function emergency( string|Stringable|Throwable|WP_Error $message, array $context = [] ): void {
		do_action( 'qm/emergency', $message, $context );
	}

	/**
	 * @param  string|Stringable|Throwable|WP_Error  $message
	 * @param  array<string, mixed>  $context
	 */
	public static function alert( string|Stringable|Throwable|WP_Error $message, array $context = [] ): void {
		do_action( 'qm/alert', $message, $context );
	}

	/**
	 * @param  string|Stringable|Throwable|WP_Error  $message
	 * @param  array<string, mixed>  $context
	 */
	public static function critical( string|Stringable|Throwable|WP_Error $message, array $context = [] ): void {
		do_action( 'qm/critical', $message, $context );
	}

	/**
	 * @param  string|Stringable|Throwable|WP_Error  $message
	 * @param  array<string, mixed>  $context
	 */
	public static function error( string|Stringable|Throwable|WP_Error $message, array $context = [] ): void {
		do_action( 'qm/error', $message, $context );
	}

	/**
	 * @param  string|Stringable|Throwable|WP_Error  $message
	 * @param  array<string, mixed>  $context
	 */
	public static function warning( string|Stringable|Throwable|WP_Error $message, array $context = [] ): void {
		do_action( 'qm/warning', $message, $context );
	}

	/**
	 * @param  string|Stringable|Throwable|WP_Error  $message
	 * @param  array<string, mixed>  $context
	 */
	public static function notice( string|Stringable|Throwable|WP_Error $message, array $context = [] ): void {
		do_action( 'qm/notice', $message, $context );
	}

	/**
	 * @param  string|Stringable|Throwable|WP_Error  $message
	 * @param  array<string, mixed>  $context
	 */
	public static function info( string|Stringable|Throwable|WP_Error $message, array $context = [] ): void {
		do_action( 'qm/info', $message, $context );
	}

	/**
	 * @param  string|Stringable|Throwable|WP_Error  $message
	 * @param  array<string, mixed>  $context
	 */
	public static function debug( string|Stringable|Throwable|WP_Error $message, array $context = [] ): void {
		do_action( 'qm/debug', $message, $context );
	}

	/**
	 * @param  string  $level
	 * @param  string|Stringable|Throwable|WP_Error  $message
	 * @param  array<string, mixed>  $context
	 */
	public static function log( string $level, string|Stringable|Throwable|WP_Error $message, array $context = [] ): void {
		do_action( "qm/$level", $message, $context );
	}
}
