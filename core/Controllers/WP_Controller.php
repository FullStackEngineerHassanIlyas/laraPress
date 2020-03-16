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
		$this->blade = new BladeInstance(TEST_APP_PLUGIN_PATH.'/app/views', TEST_APP_PLUGIN_PATH.'/app/cache/views');
		add_action( 'admin_menu', [$this, 'add_menu_pages'], 11 );
	}

}