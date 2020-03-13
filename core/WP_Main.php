<?php

namespace TestApp\Core;

use TestApp\Core\WP_loader;
use TestApp\Core\Traits\{ WP_db };

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
		$this->config = include TEST_APP_PLUGIN_PATH.'/app/config/classInstances.php';

		/*foreach ( $this->config as $key => $namespace ) {

			foreach ( $namespace as $i => $instance ) {
				$chunks = explode( '\\', $instance );
				$class = end( $chunks );
				$GLOBALS[ 'classes' ][ $key ][ $class ] = new $instance;
			}
			
		}*/
	}

}