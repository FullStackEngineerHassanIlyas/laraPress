<?php

namespace _NAMESPACE_\Core\Controllers;

use _NAMESPACE_\Core\WP_loader;
use _NAMESPACE_\Core\Traits\WP_view;

/**
 * Shortcodes
 */
class WP_shortcodes {

	use WP_view;

	protected $load;

	/**
	 * Shortcodes tags list added by add_shortcode @method
	 */
	protected
		$shortcodes = [];

	/**
	 * Constructor
	 *
	 * Adds all shortcodes added by add_shortcode @method
	 */
	function __construct() {
		$this->load = WP_loader::getInstance();

		$this->add_shortcodes();

	}

	/**
	 * add_shortcode method
	 * @param string $tag      shortcode tag
	 * @param callable|array $callback callable function or array containing callback and object
	 */
	protected function add_shortcode( $tag, $callback ) {
		$this->shortcodes[$tag] = $callback;
	}

	/**
	 * Remove shortcode tag
	 * @param  string $tag shortcode tag to remove
	 * @return void      nothing returns
	 */
	protected function remove_shortcode( $tag ) {
		unset($this->shrotcodes[$tag]);
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