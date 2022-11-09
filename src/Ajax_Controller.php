<?php

namespace BetterTransposh;

class Ajax_Controller {
	public function __construct(Plugin $plugin) {
		$this->plugin = $plugin;
	}

	public static function allow_cors() {
		header( 'Access-Control-Allow-Origin: *' );
		header( 'Access-Control-Allow-Methods: GET, POST, OPTIONS' );
		header( 'Access-Control-Allow-Headers: X-Requested-With' );
		header( 'Access-Control-Max-Age: 86400' );
	}
}