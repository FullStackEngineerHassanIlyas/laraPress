<?php

namespace _NAMESPACE_\Core\Controllers;

use _NAMESPACE_\Core\Interfaces\WP_menu_interface;
use _NAMESPACE_\Core\Traits\WP_view;
use _NAMESPACE_\Core\WP_loader;

/**
 * WP_menus
 */
abstract class WP_menu implements WP_menu_interface {

	use WP_view;

	/**
	 * List of all added menu pages tags
	 * added by add_menu_page @method
	 * @var array
	 */
	protected $menu_pages = [];

	/**
	 * Connstructor
	 *
	 * The default action hook added in this constructor for adding all
	 * other menu pages
	 */
	public function __construct() {
		$this->load = WP_loader::getInstance();

		add_action( 'admin_menu', [$this, 'add_menu_pages'], 11 );
	}

	/**
	 * Add menu page in admin
	 * @param array $args   arguments for add_menu_page
	 * @param function $caller callback for add_menu_page
	 */
	final protected function add_menu_page( $args, $caller ) {
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