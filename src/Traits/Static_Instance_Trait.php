<?php

namespace BetterTransposh\Traits;

trait Static_Instance_Trait {
	public static function get_instance(): static {
		static $instance = null;

		if ( null === $instance ) {
			$instance = new static();
		}

		return $instance;
	}
}