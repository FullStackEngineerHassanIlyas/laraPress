<?php 

namespace app\classes;

use core\classes\WP_hooks;
use app\traits\WP_hooks_handler;

/**
 * Hooks
 */
class Hooks extends WP_hooks {

	use WP_hooks_handler;
	
	function __construct() {
	}
}