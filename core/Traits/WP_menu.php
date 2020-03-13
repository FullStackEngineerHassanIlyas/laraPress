<?php 

namespace TestApp\Core\Traits;

use TestApp\Core\Traits\WP_view;

/**
 * WP_menu trait
 */
trait WP_menu {
	

	/**
	 * List of all added menu pages tags
	 * added by add_menu_page @method
	 * @var array
	 */
	protected $menu_pages = [];

	/**
	 * Add menu page in admin
	 * @param array $args   arguments for add_menu_page
	 * @param function $caller callback for add_menu_page
	 */
	final protected function add_menu_page( $args, $caller ) {
		$defaults = [
			'page_title' 	=> '',
			'menu_title' 	=> '',
			'capability' 	=> '',
			'menu_slug' 	=> '',
			'icon' 			=> '',
			'order' 		=> null,
		];

		$args = array_merge( $defaults, $args );
		$tag = add_menu_page( 
			$args['page_title'], 
			$args['menu_title'], 
			$args['capability'], 
			$args['menu_slug'], [$this, 'get_view'], 
			$args['icon'], 
			$args['order'] 
		);
		$this->menu_pages[$tag] = $caller;
	}
	/**
	 * Add sub menu page in admin
	 * @param array $args   arguments for add_menu_page
	 * @param function $caller callback for add_submenu_page
	 */
	final protected function add_submenu_page( $args, $caller ) {
		$defaults = [
			'parent_slug' 	=> '',
			'page_title' 	=> '',
			'menu_title' 	=> '',
			'capability' 	=> '',
			'menu_slug' 	=> '',
			'menu_slug' 	=> '',
			'order' 		=> null,
		];

		$args = array_merge( $defaults, $args );
		$tag = add_submenu_page( 
			$args['parent_slug'],
			$args['page_title'], 
			$args['menu_title'],
			$args['capability'], 
			$args['menu_slug'], 
			[$this, 'get_view'],
			$args['order']
		);
		$this->menu_pages[$tag] = $caller;
	}

	/**
	 * Add all pages added by WP_menu::add_menu_page
	 */
	final public function add_menu_pages() {
		if (!empty($this->menu_pages)) {
			foreach ($this->menu_pages as $hook => $caller) {
				if (is_array($caller)) {
					call_user_func($caller, $hook);
				}
			}
		}
	}
}
