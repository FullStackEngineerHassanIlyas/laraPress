<?php

namespace _NAMESPACE_\App\Controllers;

use _NAMESPACE_\Core\Controllers\WP_Controller as Controller;
use _NAMESPACE_\App\Traits\WP_shortcodes_handler;

/**
 * Shortcodes
 */
class ShortcodesController extends Controller {

	use WP_shortcodes_handler;

	/**
	 * Constructor
	 *
	 * Add your shortcodes in this constructor
	 */
	function __construct() {

		add_shortcode( 'short_code', [$this, 'shortcode_cb'] );

	}
}