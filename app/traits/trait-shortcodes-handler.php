<?php 

namespace _NAMESPACE_\app\traits;
	
use _NAMESPACE_\core\traits\WP_view;

/**
 * Shortocdes handler
 * Define all shortcode callbacks here
 */
trait WP_shortcodes_handler {

	use WP_view;

	public function shortcode_cb($atts, $content) {
		$this->view('admin/shortcodes/sample', ['sample' => 'blabla']);
	}
}