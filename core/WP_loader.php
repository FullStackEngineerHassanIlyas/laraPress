<?php

namespace TestApp\Core;

/**
 * WP Loader
 */
class WP_loader {

	private static $instance;

	private $_controllersPath;
	private $_controllers;

	public $controllerInstances = [];

	public function __construct() {
		# loading database orm
		$this->load( 'vendor/autoload' );

		# loading commands
		$this->bootDependency( 'core/Commands' );

		
		# loading traits
		$this->load( 'core/traits/WP_db' );
		$this->load( 'core/traits/WP_view' );

		# loading intefaces
		$this->load( 'core/Interfaces/WP_menu_interface' );

		# loading services
		$this->bootDependency( 'core/Services' );
		# loading classes
		$this->bootDependency( 'core/Classes' );

		# core models
		$this->bootDependency( 'core/Models' );
		# core traits
		$this->bootDependency( 'core/Traits' );
		# core controllers
		$this->bootDependency( 'core/Controllers' );

		# app models
		$this->bootDependency( 'app/Models' );
		# app traits
		$this->bootDependency( 'app/Traits' );
		# app controllers
		$this->bootDependency( 'app/Controllers' );
				
		# main classes
		$this->load( 'core/WP_Main' );
		$this->load( 'app/App' );

		# register controllers
		$this->registerControllers();

		# boot controllers
		$this->bootControllers();

	}

	public function bootControllers() {
		if (!empty($this->_controllers)) {
			foreach ($this->_controllers as $key => $controller) {
				$namespacedController = 'TestApp\App\Controllers\\'.$controller;
				$this->controllerInstances[$controller] = new $namespacedController;
			}			
		}
	}

	/**
	 * get Instance of WP_loader
	 * @return WP_loader instance
	 */
    public static function getInstance() {
        if (!(self::$instance instanceof self)) {
            self::$instance = new self;
        }
        return self::$instance;
    }

	/**
	 * Load all dependencies
	 * @return void
	 */
	public static function init() {
	}
	/**
	 * Load any file
	 * @param string $filePath path/to/file name
	 * @param bool $include true|false default: false
	 * @retun void
	 */
	private function load( $filePath, $include = false ) {
		$filePath = trim( str_replace( '.php', '', $filePath ), '/' );

		$filePath = str_replace(TEST_APP_PLUGIN_PATH, '', $filePath);

		$file = TEST_APP_PLUGIN_PATH.'/'.$filePath.'.php';
		if ( file_exists( $file ) ) {
			if (!$include) {
				require_once $file;				
			} else {
				include_once $file;
			}
		}
	}

	/**
	 * Boot Dependency
	 * @param boolean $core true|false
	 * @param string $directory Controllers|Traits|Models
	 * @return void
	 */
	private function bootDependency( $directory ) {

		$directorySegments = explode( '/', $directory );

		$targetDirectory = ucfirst( $directorySegments[1] );

		$directory = $directorySegments[0] .'/'. $targetDirectory;

		foreach ( glob(TEST_APP_PLUGIN_PATH .'/'. $directory.'/*.php') as $key => $file ) {
			$this->load( $file );

			if ( $directorySegments[0] == 'app' && $targetDirectory == 'Controllers' ) {

				$this->_controllersPath[ $key ] = $file;
			}
		}
	}

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