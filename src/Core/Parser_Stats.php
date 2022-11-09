<?php

namespace BetterTransposh\Core;

/**
 * parserstats class - holds parser statistics
 */
class Parser_Stats {

	/** @var int Holds the total phrases the parser encountered */
	public $total_phrases;

	/** @var int Holds the number of phrases that had translation */
	public $translated_phrases;

	/** @var int Holds the number of phrases that had human translation */
	public $human_translated_phrases;

	/** @var int Holds the number of phrases that are hidden - yet still somewhat viewable (such as the title attribure) */
	public $hidden_phrases;

	/** @var int Holds the number of phrases that are hidden and translated */
	public $hidden_translated_phrases;

	/** @var int Holds the amounts of hidden spans created for translation */
	public $hidden_translateable_phrases;

	/** @var int Holds the number of phrases that are hidden and probably won't be viewed - such as meta keys */
	public $meta_phrases;

	/** @var int Holds the number of translated phrases that are hidden and probably won't be viewed - such as meta keys */
	public $meta_translated_phrases;

	/** @var float Holds the time translation took */
	public $time;

	/** @var int Holds the time translation started */
	private $start_time;

	/**
	 * This function is when the object is initialized, which is a good time to start ticking.
	 */
	public function __construct() {
		$this->start_time = microtime( true );
	}

	/**
	 * Calculated values - computer translated phrases
	 * @return int How many phrases were auto-translated
	 */
	public function get_computer_translated_phrases() {
		return $this->translated_phrases - $this->human_translated_phrases;
	}

	/**
	 * Calculated values - missing phrases
	 * @return int How many phrases are missing
	 */
	public function get_missing_phrases() {
		return $this->total_phrases - $this->translated_phrases;
	}

	/**
	 * Start the timer
	 */
	public function start_timing() {
		$this->start_time = microtime( true );
	}

	/**
	 * Stop timing, store time for reference
	 */
	public function stop_timing() {
		$this->time = number_format( microtime( true ) - $this->start_time, 3 );
	}

}