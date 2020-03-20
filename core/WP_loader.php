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
	private function load( $filePath ) {
		$filePath = trim( str_replace( '.php', '', $filePath ), '/' );

		$filePath = str_replace(TEST_APP_PLUGIN_PATH, '', $filePath);

		$file = TEST_APP_PLUGIN_PATH.'/'.$filePath.'.php';
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