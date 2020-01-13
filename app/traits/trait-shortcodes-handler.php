<?php 

namespace _NAMESPACE_\App\Traits;
	

/**
 * Shortocdes handler
 * Define all shortcode callbacks here
 */
trait WP_shortcodes_handler {

	public function shortcode_cb($atts, $content) {
		$this->view('admin/shortcodes/sample', ['sample' => 'blabla']);
	}
}