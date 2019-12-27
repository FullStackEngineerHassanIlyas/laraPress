<?php 

namespace _NAMESPACE_\App\Classes;

use _NAMESPACE_\App\Traits\WP_menu_handler;
use _NAMESPACE_\Core\Classes\WP_menu;


/**
 * Menu
 */
class Menu_page extends WP_menu {

	use WP_menu_handler;

	function __construct() {
		parent::__construct();

		add_action( 'admin_menu', [$this, 'menu_pages'] );
	}

	public function menu_pages() {
		$args = [
			'page_title' => 'sample title',
			'menu_title' => 'sample menu',
			'capability' => 'manage_options',
			'menu_slug' => 'sample',
			'order' => 2,
		];
		$this->add_menu_page( $args, [$this, 'sample_callback'] );
	}
	
}