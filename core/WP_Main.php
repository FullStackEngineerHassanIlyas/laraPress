<?php

namespace _NAMESPACE_\Core;

use _NAMESPACE_\Core\Traits\WP_db;
/**
 * WP_Main class
 */
abstract class WP_Main {

	use WP_db;

	function __construct() {
		$this->initDB();
	}


}