<?php

namespace _NAMESPACE_\Core;

/**
 * WP Loader
 */
class WP_loader {

	private static $instance;

	public function __construct() {
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
		static::getInstance()->load( 'core/database/vendor/autoload' );
		
		# loading traits
		static::getInstance()->load( 'core/traits/WP_db' );
		static::getInstance()->load( 'core/traits/WP_view' );
		# loading intefaces
		static::getInstance()->load( 'core/interfaces/WP_menu_interface' );
		# loading classes
		static::getInstance()->load( 'core/classes/WP_table' );
		static::getInstance()->load( 'core/classes/WP_hooks' );
		static::getInstance()->load( 'core/classes/WP_menu' );
		static::getInstance()->load( 'core/classes/WP_shortcodes' );
		# models 
		static::getInstance()->load( 'core/models/WP_Model' );

		# main classes
		static::getInstance()->load( 'core/WP_Main' );
		static::getInstance()->load( 'app/App' );
	}
	/**
	 * Load any file
	 * @param string $filePath path/to/file name
	 * @retun void
	 */
	private function load( $filePath ) {
		$filePath = trim( str_replace( '.php', '', $filePath ), '/' );

		$file = PLUGIN_NAME_PATH.'/'.$filePath.'.php';
		if ( file_exists( $file ) ) {
			require_once $file;
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