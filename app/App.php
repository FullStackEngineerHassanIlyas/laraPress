<?php

namespace TestApp\App;

use TestApp\Core\{WP_Main, WP_loader};
use TestApp\App\Models\User;
/**
 * App class
 */
class App extends WP_Main {

	function __construct( WP_loader $loader ) {
		parent::__construct( $loader );


	}

	protected function loadDependencies() {
		/**
		 * This is example list table
		 * you can add your own table
		 * classes here by adding them
		 * into tables folder
		 */
		$this->load->class( 'tables/class-list-table' );

		// $user = new User;
		// echo User::find(1)->user_email;
		// exit;
	}
}