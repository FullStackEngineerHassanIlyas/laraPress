<?php 

namespace _NAMESPACE_\Core\Controllers;

use _NAMESPACE_\Core\Traits\{ WP_menu, WP_hooks };

/**
 * WP_Controller
 */
class WP_Controller {

	use WP_menu,
		WP_hooks;

	/**
	 * Constructor
	 */
	function __construct() {
		add_action( 'admin_menu', [$this, 'add_menu_pages'], 11 );
	}

}