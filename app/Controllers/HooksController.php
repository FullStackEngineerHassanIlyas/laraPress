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
		
	}
}