<?php

namespace _NAMESPACE_\Core;

use _NAMESPACE_\Core\WP_loader;
use _NAMESPACE_\Core\Traits\{ WP_db };

/**
 * WP_Main class
 */
abstract class WP_Main {

	use WP_db;

	protected $config;
	protected $load;

	function __construct() {
		$this->load = WP_loader::getInstance();

		$this->initDB();
		$this->loadDependencies();
		$this->config = include PLUGIN_NAME_PATH.'/app/config/classInstances.php';

		foreach ( $this->config as $key => $namespace ) {

			foreach ( $namespace as $i => $instance ) {
				$chunks = explode( '\\', $instance );
				$class = end( $chunks );
				$GLOBALS[ 'classes' ][ $key ][ $class ] = new $instance;
			}
			
		}

	}

}