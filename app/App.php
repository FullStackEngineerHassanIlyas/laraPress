<?php 

namespace app;

use core\WP_Main;
use app\classes\{Menu_page, Hooks, Shortcodes};

/**
 * App class
 */
class App extends WP_Main {
	
	function __construct() {
		parent::__construct();
		$this->loadDependencies();

		$hooks = new Hooks;
		$menu = new Menu_page;
		$shortcodes = new Shortcodes;
	}

	private function loadDependencies() {
		# loading dependencies
		$this->load('trait-hooks-handler', 'traits');
		$this->load('trait-menu-handler', 'traits');
		$this->load('trait-shortcodes-handler', 'traits');

		$this->load('class-hooks');
		$this->load('class-menu');
		$this->load('class-shortcodes');
	}
}