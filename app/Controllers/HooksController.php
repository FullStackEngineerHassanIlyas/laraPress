<?php 

namespace _NAMESPACE_\App\Controllers;

use _NAMESPACE_\Core\Controllers\WP_Controller as Controller;
use _NAMESPACE_\App\Traits\WP_hooks_handler;

/**
 * HooksController
 */
class HooksController extends Controller {

	use WP_hooks_handler;
	
	function __construct() {
		$this->wp_ajax( 'sample_action', [ $this, 'sample_action_callback' ] );

		add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_scripts' ] );
		add_action( 'admin_enqueue_scripts', [ $this, 'admin_scripts'] );

	    add_action('init', [$this, 'custom_rewrite_tag_rule'], 10, 0);
		// add_filter( 'query_vars', [$this, 'rewrite_add_var'], 10, 1 );
	}
	function custom_rewrite_tag_rule() {
    	global $wp_rewrite;

		add_rewrite_tag( '%food%', '(.*)' );
		add_rewrite_tag( '%variaty%', '(.*)' );
		add_rewrite_rule( '^pages/(.*)/(.*)/(.*)/?$', 'index.php?pagename=$matches[1]&food=$matches[2]&variaty=$matches[3]', 'top' );
  		// $wp_rewrite->page_structure = 'pages/%pagename%';
		$wp_rewrite->flush_rules();
    	// echo '<pre>';
    	// print_r($wp_rewrite);
    	// exit;
    }

}