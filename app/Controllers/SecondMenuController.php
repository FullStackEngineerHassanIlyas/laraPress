<?php 

namespace _NAMESPACE_\App\Controllers;

use _NAMESPACE_\Core\Controllers\WP_Controller as Controller;
use _NAMESPACE_\App\Traits\SecondMenuHandler;

/**
 * SecondMenuController
 */
class SecondMenuController extends Controller {

	use SecondMenuHandler;
	
	function __construct() {
		parent::__construct();
		add_action( 'admin_menu', [$this, 'menu_pages'] );
	}

	public function menu_pages() {
		$args = [
			'page_title' => 'sample menu 2 title',
			'menu_title' => 'sample menu 2',
			'capability' => 'manage_options',
			'menu_slug'  => 'sample-menu-2',
			'order' 	 => 3,
		];

		$this->add_menu_page( $args, [ $this, 'second_menu_cb' ] );
	}
}