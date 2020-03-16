<?php 

namespace TestApp\Core\Controllers;

use TestApp\Core\Traits\{ WP_menu, WP_hooks, WP_view };
use duncan3dc\Laravel\BladeInstance;

/**
 * WP_Controller
 */
class WP_Controller {

	use WP_menu,
		WP_hooks,
		WP_view;

	protected $blade;

	/**
	 * Constructor
	 */
	function __construct() {
		# routes
		$router = include TEST_APP_PLUGIN_PATH.'/app/config/routes.php';
		// var_dump($router);
		add_action( 'init', [$router, 'init_routes'] );
		$this->blade = new BladeInstance(TEST_APP_PLUGIN_PATH.'/app/views', TEST_APP_PLUGIN_PATH.'/app/cache/views');
		add_action( 'admin_menu', [$this, 'add_menu_pages'], 11 );
	}

}