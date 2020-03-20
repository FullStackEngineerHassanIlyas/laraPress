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
		$router->register_routes();
		// echo '<pre>';
		// print_r();
		// echo '</pre>';

		add_action( 'init', [$router, 'init_routes'] );



	}

}