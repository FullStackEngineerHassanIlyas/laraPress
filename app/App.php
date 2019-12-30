<?php

namespace _NAMESPACE_\App;

use _NAMESPACE_\Core\{WP_Main, WP_loader};

/**
 * App class
 */
class App extends WP_Main {

	function __construct() {
		parent::__construct();

	}

	protected function loadDependencies() {
		// This is example list table
		// you can add your own table
		// classes here by adding them
		// into tables folder
		WP_loader::load('app/classes/tables/class-list-table');
		# loading dependencies
		WP_loader::load('app/traits/trait-hooks-handler');
		WP_loader::load('app/traits/trait-menu-handler');
		WP_loader::load('app/traits/trait-shortcodes-handler');

		WP_loader::load('app/classes/class-hooks');
		WP_loader::load('app/classes/class-menu');
		WP_loader::load('app/classes/class-shortcodes');
	}
}