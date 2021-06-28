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
	 * View and arguments for blade view
	 */
	public $bladeView,
		   $bladeArgs;

	/**
	 * Loads view file
	 * 
	 * @param  string $view Path to the view file.
	 * @param  array  $args The Data passed to the view.
	 * 
	 * @return duncan3dc\Laravel\BladeInstance
	 */
	protected function view( $view, $args = [] ) {
		if ( ! empty( $args )) extract( $args );
		if ( wp_is_json_request() ) return;

		if ( ! empty( $args['title'] ) ) {
			add_filter('pre_get_document_title', function( $title ) use ( $args ) {
				return ! empty( $args['title'] ) ? $args['title'] : $title;
			}, 10, 1);
		}
		$this->bladeView = $view;
		$this->bladeArgs = $args;

		return $this->blade;
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
		$this->useBlade( $view, $args );
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