<?php

namespace _NAMESPACE_\Core;

/**
 * WP Loader
 */
class WP_loader {

	/**
	 * Private WP_loader $_instance
	 * @var WP_loader object
	 */
	private static $_instance;

	/**
	 * Absolute path for controller path
	 * @var array
	 */
	private $_controllersPath;

	/**
	 * Registered Controlelrs
	 * @var array
	 */
	private $_controllers;

	/**
	 * Constructed Controllers
	 * @var array
	 */
	public $controllerInstances = [];

	/**
	 * Load all dependencies
	 * @return void
	 */
	public function __construct() {
		# loading database orm
		$this->load( 'vendor/autoload' );

		# loading helpers
		$this->load( 'core/Helpers/path' );

		# loading commands
		$this->loadAll( 'core/Commands' );

		# loading intefaces
		$this->load( 'core/Interfaces/WP_menu_interface' );

		# loading services
		$this->loadAll( 'core/Services' );
		# loading classes
		$this->loadAll( 'core/Classes' );

		# core traits
		$this->loadAll( 'core/Traits' );
		# core models
		$this->loadAll( 'core/Models' );
		# core controllers
		$this->loadAll( 'core/Controllers' );

		# app models
		$this->loadAll( 'app/Models' );
		# app traits
		$this->loadAll( 'app/Traits' );
		# app controllers
		$this->loadAll( 'app/Controllers' );
				
		# main classes
		$this->load( 'core/WP_Main' );
		$this->load( 'app/App' );

		# register controllers
		$this->registerControllers();

		# boot them all
		$this->bootControllers();
	}

	/**
	 * Prepare controllers namespaces
	 * And boot them
	 * @return void
	 */
	public function bootControllers() {
		if (!empty($this->_controllers)) {
			foreach ($this->_controllers as $key => $controller) {
				$namespacedController = '_NAMESPACE_\App\Controllers\\'.$controller;
				$this->controllerInstances[$controller] = new $namespacedController;
			}			
		}
	}

	/**
	 * get Instance of WP_loader
	 * @return WP_loader instance
	 */
    public static function getInstance() {
        if (!(self::$_instance instanceof self)) {
            self::$_instance = new self;
        }
        return self::$_instance;
    }

	/**
	 * Load any file
	 * @param string $filePath path/to/file name
	 * @param bool $include true|false default: false
	 * @retun void
	 */
	private function load( $filePath ) {
		$relativePath = str_replace( [ PLUGIN_NAME_PATH, '.php' ], '', $filePath );

		$relativePath = trim( $relativePath, '/' );

		$file = PLUGIN_NAME_PATH . '/'. $relativePath . '.php';
		if ( file_exists( $file ) ) {
			require $file;
		}
	}

	/**
	 * Boot Dependency
	 * @param boolean $core true|false
	 * @param string $directory Controllers|Traits|Models
	 * @return void
	 */
	private function loadAll( $directory ) {

		$directorySegments = explode( '/', $directory );

		$targetDirectory = ucfirst( $directorySegments[1] );

		$directory = $directorySegments[0] .'/'. $targetDirectory;

		foreach ( glob(PLUGIN_NAME_PATH .'/'. $directory.'/*.php') as $key => $file ) {
			$this->load( $file );

			if ( $directorySegments[0] == 'app' && $targetDirectory == 'Controllers' ) {

				$this->_controllersPath[ $key ] = $file;
			}
		}
	}

	/**
	 * Register all controllers
	 * @return void
	 */
	private function registerControllers() {
		if ( !empty( $this->_controllersPath ) ) {
			foreach ( $this->_controllersPath as $key => $path ) {
				$class = basename($path, '.php');
				$this->_controllers[ $key ] = $class;
			}
		}
	}

	/**
	 * Load app Trait
	 * @param  string $filePath name of trait
	 * @return void
	 */
	public function trait( $filePath ) {
		$this->load( 'app/traits/'.$filePath );
	}
	/**
	 * Load app class
	 * @param  string $filePath name of class
	 * @return void
	 */
	public function class( $filePath ) {
		$this->load( 'app/classes/'.$filePath );
	}
	/**
	 * Load model class
	 * @param  string $filePath name of class
	 * @return void
	 */
	public function model( $filePath ) {
		$this->load( 'app/models/'.$filePath );
	}
	
}