<?php

namespace _NAMESPACE_\App;

use _NAMESPACE_\Core\{WP_Main, WP_loader};
use _NAMESPACE_\App\Models\User;
/**
 * App class
 */
class App extends WP_Main {

	function __construct() {
		parent::__construct();

	}

	protected function loadDependencies() {
		/**
		 * This is example list table
		 * you can add your own table
		 * classes here by adding them
		 * into tables folder
		 */
		$this->load->class( 'tables/class-list-table' );

		// $this->load->trait( 'trait-hooks-handler' );
		// $this->load->trait( 'trait-menu-handler' );
		// $this->load->trait( 'trait-shortcodes-handler' );

		// $this->load->class( 'class-hooks' );
		// $this->load->class( 'class-menu' );
		// $this->load->class( 'class-shortcodes' );

		# models
		// $this->load->model( 'user' );

		// $user = new User;
		// echo User::find(1)->user_email;
		// exit;
	}
}