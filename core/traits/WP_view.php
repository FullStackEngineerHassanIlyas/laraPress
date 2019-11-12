<?php 
namespace core\traits;

/**
 * Views
 */
trait WP_view {
    protected 
		$views = [],
		$args = [];

	protected function view( $view, $args = [] ) {		
		extract($args);
		include_once WP_PLUGIN_DIR.'/'.PLUGIN_NAME.'/app/views/'.$view.'.php';
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
}