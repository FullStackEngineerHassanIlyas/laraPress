<?php

namespace _NAMESPACE_\App\Controllers;

use _NAMESPACE_\Core\Controllers\WP_shortcodes;
use _NAMESPACE_\App\Traits\WP_shortcodes_handler;

/**
 * Shortcodes
 */
class ShortcodesController extends WP_shortcodes {

	use WP_shortcodes_handler;

	/**
	 * Constructor
	 *
	 * Add your shortcodes in this constructor
	 */
	function __construct() {
		/**
		 * Add shortcodes here
		 *
		 * @usage
		 * $this->add_shortcode( $tag, $callback );
		 *
		 * @example
		 * class MyPlugin {
		 *		public static function baztag_func( $atts, $content = "" ) {
		 *			return "content = $content";
		 *	 	}
	 	 * }
	 	 * $this->add_shortcode( 'baztag', array( 'MyPlugin', 'baztag_func' ) );
		 */

		$this->add_shortcode( 'short_code', [$this, 'shortcode_cb'] );

		/**
		 * Parent connstruct must call at the end.
		 */
		parent::__construct();
	}
}