<?php 

namespace _NAMESPACE_\Core\Traits;

use duncan3dc\Laravel\BladeInstance;

/**
 * Views
 */
trait WP_view {
    protected 
		$views = [],
		$args = [];

	protected function view( $view, $args = [] ) {		
		if (!empty($args)) extract($args);
		if (wp_is_json_request()) return;
		$this->useBlade($view, $args);
	}

	public function get_view() {
		$tag  = current_action();
		$view = $this->views[$tag];
		$args = $this->args[$tag];
		$this->view($view, $args);
	}

	protected function set_view( $view, $tag, $args = [] ) {
		if (!empty($tag)) {
			$this->views[$tag] = $view;
			$this->args[$tag] = $args;
		}
	}


	private function useBlade( $view, $args ) {
		$blade = new BladeInstance(PLUGIN_NAME_PATH.'/app/views', PLUGIN_NAME_PATH.'/app/cache/views');

		echo $blade->render( $view, $args );
	}
}