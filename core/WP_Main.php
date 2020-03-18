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
		include TEST_APP_PLUGIN_PATH.'/app/config/routes.php';

		echo '<pre>';
		print_r($router->register_routes());
		echo '</pre>';

		add_action( 'init', [$router, 'init_routes'] );



	}

	public function init_routes() {
		add_rewrite_rule( '^my-page/([^/]+)/([0-9])/?$', 'index.php?pagename=my-page&custom_var=$matches[1]&id=$matches[2]', 'top' );
	}

}