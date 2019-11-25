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
		$this->load_core_file('traits/WP_db');
		$this->load_core_file('traits/WP_view');
		# loading intefaces
		$this->load_core_file('interfaces/WP_menu_interface');
		# loading classes
		$this->load_core_file('classes/WP_table');
		$this->load_core_file('classes/WP_hooks');
		$this->load_core_file('classes/WP_menu');
		$this->load_core_file('classes/WP_shortcodes');
	}
	/**
	 * Load app classes
	 * @param  string $class name of class
	 * @return void
	 */
	public function load( $filePath, $type = 'classes' ) {
		if (!in_array($type, ['classes', 'traits'])) exit('Invalid type passsed');

		$file = WP_PLUGIN_DIR.'/'.PLUGIN_NAME.'/app/'.$type.'/'.$filePath.'.php';
		if (file_exists($file)) {
			require_once $file;
		}
	}
	/**
	 * Load Core classes|interfaces|traits
	 * @param  string $filePath path to file
	 * @return void
	 */
	private function load_core_file( $filePath ) {
		$file = WP_PLUGIN_DIR.'/'.PLUGIN_NAME.'/core/'.$filePath.'.php';
		if (file_exists($file)) {
			require_once $file;
		}
	}

}