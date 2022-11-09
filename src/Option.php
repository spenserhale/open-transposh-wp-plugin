<?php

namespace BetterTransposh;

/**
 * @property string $desc Description
 */
class Option {

	private $name;
	private $value;
	private $type;

	public function __construct( $name, $value = '', $type = '' ) {
		$this->name  = $name;
		$this->value = $value;
		$this->type  = $type;
	}

	public function __toString() {
		return (string) $this->value;
	}

	public function set_value( $value ) {
		$this->value = $value;
	}

	public function from_post() {
		$this->value = $_POST[ $this->name ];
	}

	public function get_name() {
		return $this->name;
	}

	public function get_value() {
		return $this->value;
	}

	public function get_type() {
		return $this->type;
	}

	public function post_value_id_name() {
		return 'value="' . $this->value . '" id="' . $this->name . '" name="' . $this->name . '"';
	}

}
