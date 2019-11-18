<?php

namespace _NAMESPACE_\core;

// use core\WP_Main;

/**
 * Loader class
 */
class WP_loader {
	
	function __construct() {
		$this->init();
		require_once WP_PLUGIN_DIR.'/'.PLUGIN_NAME.'/core/WP_Main.php';
		require_once WP_PLUGIN_DIR.'/'.PLUGIN_NAME.'/app/App.php';
	}

	/**
	 * Load all dependencies
	 * @return void
	 */
	private function init() {
		# loading traits
		require_once WP_PLUGIN_DIR.'/'.PLUGIN_NAME.'/core/traits/WP_db.php';
		require_once WP_PLUGIN_DIR.'/'.PLUGIN_NAME.'/core/traits/WP_view.php';
		# loading intefaces
		require_once WP_PLUGIN_DIR.'/'.PLUGIN_NAME.'/core/interfaces/WP_menu_interface.php';
		# loading classes
		require_once WP_PLUGIN_DIR.'/'.PLUGIN_NAME.'/core/classes/WP_hooks.php';
		require_once WP_PLUGIN_DIR.'/'.PLUGIN_NAME.'/core/classes/WP_menu.php';
		require_once WP_PLUGIN_DIR.'/'.PLUGIN_NAME.'/core/classes/WP_shortcodes.php';
		
	}

}