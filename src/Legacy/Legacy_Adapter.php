<?php

namespace OpenTransposh\Legacy;

class Legacy_Adapter {
	private static object $staticObject;

	public function __construct( private readonly object $object ) {
		self::$staticObject = $object;
	}

	public function __isset( string $name ): bool {
		return isset( $this->object->$name );
	}

	public function __get( string $name ) {
		return $this->object->$name;
	}

	public function __set( string $name, $value ): void {
		$this->object->$name = $value;
	}

	public function __call( string $name, array $arguments ) {
		return $this->object->$name( ...$arguments );
	}

	public static function __callStatic( string $name, array $arguments ) {
		return static::$staticObject::$name( ...$arguments );
	}
}
