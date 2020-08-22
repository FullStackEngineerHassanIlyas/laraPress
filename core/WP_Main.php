<?php

namespace _NAMESPACE_\Core;

use _NAMESPACE_\Core\WP_loader;
use _NAMESPACE_\Core\Traits\{ WP_db };
use _NAMESPACE_\Core\Services\Router;

use function _NAMESPACE_\Core\Helpers\config_path;

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

		add_action( 'init', [ $this, 'flush_rewirtes' ] );
		add_action( 'init', [ $router, 'prepare_routes' ] );
		add_action( 'wp', [ $router, 'routes_view' ] );
	}
	public function flush_rewirtes() {
    	global $wp_rewrite;
		$wp_rewrite->flush_rules();
	}

}