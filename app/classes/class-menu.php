<?php 

namespace _NAMESPACE_\app\classes;

use _NAMESPACE_\app\traits\WP_menu_handler;
use _NAMESPACE_\core\interfaces\WP_menu_interface;
use _NAMESPACE_\core\classes\WP_menu;


/**
 * Menu
 */
class Menu_page extends WP_menu implements WP_menu_interface {

	use WP_menu_handler;

	function __construct() {
		parent::__construct();

		add_action( 'admin_menu', [$this, 'menu_pages'] );
	}

	
}