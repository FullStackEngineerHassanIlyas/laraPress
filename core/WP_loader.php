<?php

namespace _NAMESPACE_\Core;

// use core\WP_Main;

/**
 * Loader class
 */
class WP_loader {

	function __construct() {
	}

	/**
	 * Load all dependencies
	 * @return void
	 */
	public static function init() {
		# loading traits
		self::load( 'core/traits/WP_db' );
		self::load( 'core/traits/WP_view' );
		# loading intefaces
		self::load( 'core/interfaces/WP_menu_interface' );
		# loading classes
		self::load( 'core/classes/WP_table' );
		self::load( 'core/classes/WP_hooks' );
		self::load( 'core/classes/WP_menu' );
		self::load( 'core/classes/WP_shortcodes' );

		# main classes
		self::load( 'core/WP_Main' );
		self::load( 'app/App' );
	}
	/**
	 * Load app classes
	 * @param  string $class name of class
	 * @return void
	 */
	public static function load( $filePath ) {
		$filePath = trim( str_replace( '.php', '', $filePath ), '/' );

		$file = PLUGIN_NAME_PATH.'/'.$filePath.'.php';
		if ( file_exists( $file ) ) {
			require_once $file;
		}
	}
	
}