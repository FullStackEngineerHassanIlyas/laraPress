<?php 

namespace app\classes;

use core\classes\WP_shortcodes;
use app\traits\WP_shortcodes_handler;

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
		
	}
}