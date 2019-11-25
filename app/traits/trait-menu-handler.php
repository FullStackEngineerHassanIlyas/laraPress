<?php 

namespace _NAMESPACE_\app\traits;
	
use _NAMESPACE_\core\traits\WP_view;
use _NAMESPACE_\app\classes\tables\Example_List_Table;

/**
 * WP menus handler
 * Define all wp menu callbacks here
 */
trait WP_menu_handler {
	
	use WP_view;
	
	public function sample_callback( $tag ) {
		$table = new Example_List_Table;

		$table->set_default_columns(['file','type', 'uploaded_by']);
		$table->set_sortable_columns([
	        'file'    		=> ['file', true],     //true means it's already sorted
	        'type'    		=> ['type', false],
	        'uploaded_by'   => ['uploaded_by', false],
	    ]);
	    $table->set_bulk_actions(['delete' => 'Delete']);
	    $table->set_order_column('file');
		$table->set_columns([
			'cb' => '<input type="checkbox">',
			'file' => __('File'),
			'type' => __('Type'),
			'uploaded_by' => __('Uploaded By')
		]);

		$table->prepare_items();

		$this->set_view('admin/sample', $tag, ['table' => $table]);
	}

}