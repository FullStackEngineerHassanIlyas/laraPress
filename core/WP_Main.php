<?php

namespace _NAMESPACE_\Core;

use _NAMESPACE_\Core\Traits\WP_db;
/**
 * WP_Main class
 */
abstract class WP_Main {

	use WP_db;

	protected $config;

	function __construct() {
		$this->initDB();
		$this->loadDependencies();
		$this->config = include PLUGIN_NAME_PATH.'/app/config.php';

		foreach ($this->config as $key => $namespace) {
			foreach ($namespace as $i => $instance) {
				$chunks = explode('\\', $instance);
				$class = end($chunks);
				$GLOBALS['classes'][$key][$class] = new $instance;
			}
		}
	}


}