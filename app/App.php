<?php 

namespace app;

use core\WP_Main;
use app\classes\Hooks;

/**
 * App class
 */
class App extends WP_Main {
	
	function __construct() {
		parent::__construct();
		$this->loadDependencies();

		$hooks = new Hooks;
		// exit(print_r($this->db->wpdb));
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