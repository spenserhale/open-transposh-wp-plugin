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

	function __toString() {
		return (string) $this->value;
	}

	function set_value( $value ) {
		$this->value = $value;
	}

	function from_post() {
		$this->value = $_POST[ $this->name ];
	}

	function get_name() {
		return $this->name;
	}

	function get_value() {
		return $this->value;
	}

	function get_type() {
		return $this->type;
	}

	function post_value_id_name() {
		return 'value="' . $this->value . '" id="' . $this->name . '" name="' . $this->name . '"';
	}

}
