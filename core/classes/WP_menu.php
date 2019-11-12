<?php 

namespace core\classes;

/**
 * WP_menus
 */
class WP_menu {

	protected $menu_pages = [];
	
	public function __construct() {
		add_action( 'admin_menu', [$this, 'add_menu_pages'], 11 );
	}
	/**
	 * Add menu page in admin
	 * @param array $args   arguments for add_menu_page
	 * @param function $caller callback for add_menu_page
	 */
	protected function add_menu_page( $args, $caller ) {
		$defaults = [
			'menu_title' 	=> '',
			'page_title' 	=> '',
			'capability' 	=> '',
			'menu_slug' 	=> '',
			'icon' 			=> '',
			'order' 		=> null,
		];

		$args = array_merge( $defaults, $args );
		$tag = add_menu_page( $args['page_title'], $args['menu_title'], $args['capability'], $args['menu_slug'], [$this, 'get_view'], $args['icon'], $args['order'] );
		$this->menu_pages[$tag] = $caller;
	}
	/**
	 * Add all pages added by WP_menu::add_menu_page
	 */
	public function add_menu_pages() {
		if (!empty($this->menu_pages)) {
			foreach ($this->menu_pages as $hook => $caller) {
				if (is_array($caller)) {
					call_user_func($caller, $hook);
				}
			}
		}
	}
}