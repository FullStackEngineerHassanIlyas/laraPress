<?php 

namespace _NAMESPACE_\app\traits;
	
use _NAMESPACE_\core\traits\WP_view;

/**
 * WP menus handler
 * Define all wp menu callbacks here
 */
trait WP_menu_handler {
	
	use WP_view;
	
	public function sample_callback($tag) {
		$this->set_view('admin/sample', $tag);
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