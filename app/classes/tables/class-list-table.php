<?php

namespace _NAMESPACE_\app\classes\tables;

use _NAMESPACE_\core\classes\WP_table;

/**
 * Example Table class
 */
class Example_List_Table extends WP_table {

	function __construct() {
		$args = [
			'singular'  => 'service',
			'plural'    => 'services',
			'ajax'      => true
		];
		parent::__construct($args);
	}

	public function column_name($item) {
		$actions = [
			'delete' => sprintf(
				'<a href="#" onclick="return false;" data-service_id="%2$s" data-ajax_url="%1$s">Delete</a>',
				admin_url('admin-ajax.php'),
				$item['id']
			),
		];
		return sprintf('%1$s %2$s', $item['name'], $this->row_actions($actions) );
	}
	public function column_cb($item) {
		return sprintf(
			'<input type="checkbox" name="id[]" value="%s">', $item['id']
		);
	}
	public function column_cost($item) {
		return sprintf('$%s', $item['cost']);
	}

	protected function table_data() {
		return [];
	}
}