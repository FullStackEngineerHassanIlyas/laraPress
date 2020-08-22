<?php 

namespace _NAMESPACE_\Core\Controllers;

use _NAMESPACE_\Core\Traits\{ WP_menu, WP_hooks, WP_view };
use duncan3dc\Laravel\BladeInstance;

/**
 * WP_Controller
 */
class WP_Controller {

	/**
	 * Base traits of framework.
	 */
	use WP_menu,
		WP_hooks,
		WP_view;

	/**
	 * The blade instance.
	 */
	protected $blade;

	/**
	 * Constructor
	 */
	function __construct() {
		$this->blade = new BladeInstance( PLUGIN_NAME_PATH . '/app/views', PLUGIN_NAME_PATH . '/app/cache/views' );
		add_action( 'admin_menu', [ $this, 'add_menu_pages' ], 11 );
	}

}