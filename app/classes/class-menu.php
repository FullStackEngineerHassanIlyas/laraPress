<?php 

namespace app\classes;

use app\traits\WP_menu_handler;
use core\interfaces\WP_menu_interface;
use core\classes\WP_menu;


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