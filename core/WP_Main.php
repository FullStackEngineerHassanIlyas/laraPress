<?php 

namespace core;

use core\traits\WP_db;
/**
 * WP_Main class
 */
class WP_Main {

	use WP_db;

	function __construct() {
		$this->initDB();
		// exit(print_r($this));
	}

	/**
	 * Load app classes
	 * @param  string $class name of class
	 * @return void        void
	 */
	public function load($filePath, $type = 'classes') {
		if (!in_array($type, ['classes', 'traits'])) exit('Invalid type passsed');

		$file = WP_PLUGIN_DIR.'/'.PLUGIN_NAME.'/app/'.$type.'/'.$filePath.'.php';
		if (file_exists($file)) {
			require_once $file;
		}
	}

	protected function output($input, $json = true) {
		if ($json) {
			echo json_encode($input);
			exit;
		}
		echo $input;
	}

}