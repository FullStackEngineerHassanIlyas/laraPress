<?php

namespace _NAMESPACE_\Core;

/**
 * WP Loader
 */
class WP_loader {

	private static $instance;

	private $controllersPath;
	private $_controllers;

	public function __construct() {}

	public function bootControllers() {
		if (!empty($this->_controllers)) {
			foreach ($this->_controllers as $key => $controller) {
				$namespacedController = '_NAMESPACE_\App\Controllers\\'.$controller;
				new $namespacedController;
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
		# loading database orm
		static::getInstance()->load( 'vendor/autoload' );

		# loading commands
		static::getInstance()->bootDependency( 'core/Commands' );
		
		# loading traits
		static::getInstance()->load( 'core/traits/WP_db' );
		static::getInstance()->load( 'core/traits/WP_view' );

		# loading intefaces
		static::getInstance()->load( 'core/interfaces/WP_menu_interface' );

		# core models
		static::getInstance()->bootDependency( 'core/models' );
		# core traits
		static::getInstance()->bootDependency( 'core/traits' );
		# core controllers
		static::getInstance()->bootDependency( 'core/controllers' );

		# app models
		static::getInstance()->bootDependency( 'app/models' );
		# app traits
		static::getInstance()->bootDependency( 'app/traits' );
		# app controllers
		static::getInstance()->bootDependency( 'app/controllers' );

		# loading classes
		static::getInstance()->load( 'core/classes/WP_table' );

		# main classes
		static::getInstance()->load( 'core/WP_Main' );
		static::getInstance()->load( 'app/App' );

		# register controllers
		static::getInstance()->registerControllers();

		# boot controllers
		static::getInstance()->bootControllers();
	}
	/**
	 * Load any file
	 * @param string $filePath path/to/file name
	 * @retun void
	 */
	private function load( $filePath ) {
		$filePath = trim( str_replace( '.php', '', $filePath ), '/' );

		$filePath = str_replace(PLUGIN_NAME_PATH, '', $filePath);

		$file = PLUGIN_NAME_PATH.'/'.$filePath.'.php';
		if ( file_exists( $file ) ) {
			require_once $file;
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

		foreach ( glob(PLUGIN_NAME_PATH .'/'. $directory.'/*.php') as $key => $file ) {
			$this->load( $file );

			if ( $directorySegments[0] == 'app' && $targetDirectory == 'Controllers' ) {

				$this->controllersPath[ $key ] = $file;
			}
		}
	}

	private function registerControllers() {
		if ( !empty( $this->controllersPath ) ) {
			foreach ( $this->controllersPath as $key => $path ) {
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