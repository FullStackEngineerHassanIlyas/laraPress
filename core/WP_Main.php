<?php 

namespace _NAMESPACE_\core;

use _NAMESPACE_\core\traits\WP_db;
/**
 * WP_Main class
 */
abstract class WP_Main {

	use WP_db;

	function __construct() {
		$this->initDB();
	}


}