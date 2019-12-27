<?php 

namespace _NAMESPACE_\App\Traits;
	
use _NAMESPACE_\Core\Traits\WP_view;

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