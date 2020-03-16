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

	function __construct( WP_loader $loader ) {
		$this->load = $loader;

		$this->initDB();
		$this->loadDependencies();
		$this->config = include TEST_APP_PLUGIN_PATH.'/app/config/classInstances.php';
		// global $wp_query;
		// echo '<pre>';
		// print_r($wp_query);
		// echo '</pre>';

		/*foreach ( $this->config as $key => $namespace ) {

			foreach ( $namespace as $i => $instance ) {
				$chunks = explode( '\\', $instance );
				$class = end( $chunks );
				$GLOBALS[ 'classes' ][ $key ][ $class ] = new $instance;
			}
			
		}*/
	}

}