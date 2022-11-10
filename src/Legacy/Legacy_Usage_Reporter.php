<?php

namespace OpenTransposh\Legacy;

class Legacy_Usage_Reporter {
	public function __isset( string $name ): bool {
		_doing_it_wrong( __METHOD__, 'Legacy Transposh usage, please use updated version', '0.1.0' );
		return false;
	}
	public function __get( string $name ) {
		_doing_it_wrong( __METHOD__, 'Legacy Transposh usage, please use updated version', '0.1.0' );
		return null;
	}
	public function __set( string $name, $value ): void {
		_doing_it_wrong( __METHOD__, 'Legacy Transposh usage, please use updated version', '0.1.0' );
	}
	public function __call( string $name, array $arguments ) {
		_doing_it_wrong( __METHOD__, 'Legacy Transposh usage, please use updated version', '0.1.0' );
	}
	public static function __callStatic( string $name, array $arguments ) {
		_doing_it_wrong( __METHOD__, 'Legacy Transposh usage, please use updated version', '0.1.0' );
	}
}