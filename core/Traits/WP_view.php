<?php 

namespace _NAMESPACE_\Core\Traits;

use duncan3dc\Laravel\BladeInstance;

/**
 * Views
 */
trait WP_view {
	/**
	 * Views and arguments for Menu pages
	 */
    protected 
		$views = [],
		$args  = [];

	/**
	 * Loads view file
	 * @param  string $view Path to the view file.
	 * @param  array  $args The Data passed to the view.
	 * @return void
	 */
	protected function view( $view, $args = [] ) {
		if ( ! empty( $args )) extract( $args );
		if ( wp_is_json_request() ) return;

		if ( ! empty( $args['title'] ) ) {
			add_filter('pre_get_document_title', function( $title ) use ( $args ) {
				return ! empty( $args['title'] ) ? $args['title'] : $title;
			}, 10, 1);
		}

		$this->useBlade( $view, $args );
	}

	/**
	 * Loads view for menu pages.
	 * 
	 * @return void
	 */
	public function get_view() {
		$tag  = current_action();
		$view = $this->views[ $tag ];
		$args = $this->args[ $tag ];
		$this->view( $view, $args );
	}

	/**
	 * Sets view for menu pages
	 * @param string $view Path to the view file.
	 * @param string $tag  The filter tag name.
	 * @param array  $args The Data passed to the view.
	 */
	protected function set_view( $view, $tag, $args = [] ) {
		if ( ! empty( $tag ) ) {
			$this->views[ $tag ] = $view;
			$this->args[ $tag ] = $args;
		}
	}

	/**
	 * Renders the view file.
	 * @param  string $view Path to the view file.
	 * @param  array $args Data passed to the view file.
	 * @return void       Renders out the view file content.
	 */
	private function useBlade( $view, $args ) {
		if ( ! empty( $this->blade ) ) {
			echo $this->blade->render( $view, $args );			
		}
	}
}