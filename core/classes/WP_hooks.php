<?php

namespace _NAMESPACE_\core\classes;

/**
 * WP_hooks
 */
class WP_hooks {

	function __construct() {}

	/**
	 * Add ajax event listner
	 * @param  string  		$action   name of action
	 * @param  callable  	$callable callback for ajax action
	 * @param  boolean 		$nopriv   Set action for non logged in users DEFAULT to false
	 * @param  boolean 		$both     Set action for both logged in and not logged in DEFAULT to false
	 * @return void
	 */
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

	/**
	 * Output from input
	 * @param  string  $input String input for output
	 * @param  boolean $json  Wheather output is json, DEFAULT true
	 * @return string         returned output
	 */
	protected function output($input, $json = true) {
		if ($json) {
			echo json_encode($input);
			exit;
		}
		echo $input;
	}
}