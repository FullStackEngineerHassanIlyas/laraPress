<?php

namespace TestApp\Core;

use TestApp\Core\WP_loader;
use TestApp\Core\Traits\{ WP_db };
use TestApp\Core\Services\Router;

/**
 * WP_Main class
 */
abstract class WP_Main {

	use WP_db;

	protected $config;
	protected $load;

	function __construct( WP_loader $loader ) {
		$this->load = $loader;

		$router = new Router( $loader );

		$this->initDB();
		$this->loadDependencies();
		# routes
		require config_path('routes.php');

		add_action( 'init', [$this, 'flush_rewirtes'], 10, 1 );
		add_action( 'init', [$router, 'prepare_routes'] );
		add_action( 'wp', [$router, 'init_routes'] );
	}
	public function flush_rewirtes() {
    	global $wp_rewrite;
		$wp_rewrite->flush_rules();
	}

}