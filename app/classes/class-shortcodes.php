<?php 

namespace _NAMESPACE_\app\classes;

use _NAMESPACE_\core\classes\WP_shortcodes;
use _NAMESPACE_\app\traits\WP_shortcodes_handler;

/**
 * Shortcodes
 */
class Shortcodes extends WP_shortcodes {

	use WP_shortcodes_handler;
	
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
		
		// $this->add_shortcode( 'short_code', [$this, 'shortcode_cb'] );
		
		/**
		 * Parent connstruct must call at the end.
		 */
		parent::__construct();
	}
}