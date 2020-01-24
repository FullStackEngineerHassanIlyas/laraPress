<?php 

namespace _NAMESPACE_\App\Traits;

/**
 * Hooks handler
 * Define all Hooks callbacks here
 */
trait WP_hooks_handler {

	public function enqueue_scripts() {
		wp_enqueue_script( 'jquery-form' );
	}

	public function admin_scripts() {
		$suffix = (defined('SCRIPT_DEBUG') && SCRIPT_DEBUG) ? '' : '.min';
		wp_enqueue_script( 'jquery-form' );

		wp_enqueue_script('admin_js', PLUGIN_NAME_URL.'app/assets/admin/js/'.PLUGIN_NAME.'-admin'.$suffix.'.js', ['jquery', 'jquery-form'], null, true);
		
	}

	public function sample_action_callback() {

		$this->output($_POST);
		exit;
	}

}