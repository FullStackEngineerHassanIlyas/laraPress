<?php

namespace _NAMESPACE_\app;

use _NAMESPACE_\core\{WP_Main, WP_loader};
use _NAMESPACE_\app\classes\{Menu_page, Hooks, Shortcodes};

/**
 * App class
 */
class App extends WP_Main {

	function __construct( WP_loader $loader ) {

		$this->loader = $loader;
		$this->loadDependencies();

		// This is example list table
		// you can add your own table
		// classes here by adding them
		// into tables folder
		$this->loader->load('tables/class-list-table');

		$hooks = new Hooks;
		$menu = new Menu_page;
		$shortcodes = new Shortcodes;

		parent::__construct();
	}

	private function loadDependencies() {
		# loading dependencies
		$this->loader->load('trait-hooks-handler', 'traits');
		$this->loader->load('trait-menu-handler', 'traits');
		$this->loader->load('trait-shortcodes-handler', 'traits');

		$this->loader->load('class-hooks');
		$this->loader->load('class-menu');
		$this->loader->load('class-shortcodes');
	}
}