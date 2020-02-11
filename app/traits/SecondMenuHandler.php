<?php 

namespace _NAMESPACE_\App\Traits;

/**
 * SecondMenuHandler
 */
trait SecondMenuHandler {

	public function second_menu_cb( $tag ) {
		
		$this->set_view( 'admin/second_menu_page', $tag, [ 'func' => __FUNCTION__ ] );
	}
}