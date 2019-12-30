<?php

namespace _NAMESPACE_\App\Classes;

use _NAMESPACE_\Core\Classes\WP_hooks;
use _NAMESPACE_\App\Traits\WP_hooks_handler;

/**
 * Hooks
 */
class Hooks extends WP_hooks {

	use WP_hooks_handler;

	function __construct() {
		$this->wp_ajax( 'sample_action', [ $this, 'sample_action_callback' ] );

		add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_scripts' ] );
		add_action( 'admin_enqueue_scripts', [ $this, 'admin_scripts'] );
	
	}
}