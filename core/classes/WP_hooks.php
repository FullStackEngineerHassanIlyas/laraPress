<?php 

namespace _NAMESPACE_\core\classes;

/**
 * WP_hooks
 */
class WP_hooks {
	
	function __construct() {
		
	}

	protected static function wp_ajax($action, $callable, $nopriv = false, $both = false) {
		if ($nopriv) {
			add_action("wp_ajax_nopriv_{$action}", $callable);
			if ($both) {
				add_action("wp_ajax_{$action}", $callable);	
			}
		} else {
			add_action("wp_ajax_{$action}", $callable);
		}
	}
}