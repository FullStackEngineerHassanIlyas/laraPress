<?php 

namespace core\classes;

/**
 * Shortcodes
 */
class WP_shortcodes {

	protected 
		$shortcodes = [];
	
	function __construct() {
		
		$this->add_shortcodes();
	}

	/**
	 * add_shortcode method 
	 * @param string $tag      shortcode tag
	 * @param callable|array $callback callable function or array containing callback and object
	 */
	protected function add_shortcode($tag, $callback) {
		$this->shortcodes[$tag] = $callback;
	}
	/**
	 * add_shortcodes register all shortcodes
	 */
	protected function add_shortcodes() {
		if (!empty($this->shortcodes)) {
			foreach ($this->shortcodes as $tag => $callback) {
				add_shortcode( $tag, $callback );
			}
		}
	}
}