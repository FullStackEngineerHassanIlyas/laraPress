<?php 

namespace _NAMESPACE_\core\classes;

if(!class_exists('WP_List_Table')){
	require_once( ABSPATH . 'wp-admin/includes/screen.php' );
	require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
}
abstract class WP_table extends \WP_List_Table {

	protected 
		$_data = [],
		$viwe_links = [],

		$bulk_actions = [],
		$default_columns = [],
		$sortable_columns = [],
		$columns = [],
		$order_column = 'id';
	function __construct(array $args = []){

		parent::__construct($args);
	}

	private static $addedClosures = [];

    public function __set($name, $value) {
        if ($value instanceof \Closure) {
            self::$addedClosures[$name] = $value;
        } else {
            parent::__set($name, $value);
        }
    }

    public function __get($name) {
    	return $this->$name;
    }

    public function __isset($name) {
    	return isset($this->$name);
    }

    public function __call($method, $arguments) {
        if (isset(self::$addedClosures[$method]))
            return call_user_func_array(self::$addedClosures[$method], $arguments);
        return call_user_func_array($method, $arguments);
    }

    public function set_views($viwe_links = []) {
    	$this->viwe_links = $viwe_links;
    }

	protected function get_views() { 
		/*$this->viwe_links = [
			'all'       => __('<a href="#">All</a>','my-plugin-slug'),
			'published' => __('<a href="#">Published</a>','my-plugin-slug'),
			'trashed'   => __('<a href="#">Trashed</a>','my-plugin-slug')
		];*/
		return $this->viwe_links;
	}

	public function set_default_columns($columns) {
		$this->default_columns = $columns;
	}
	public function column_default($item, $column_name) {
		if (in_array($column_name, $this->default_columns)) {
			return $item[$column_name];
		}
	}

	public function set_sortable_columns($columns) {
		$this->sortable_columns = $columns;
	}
	public function get_sortable_columns() {
	    return $this->sortable_columns;
	}
	public function usort_reorder( $a, $b ) {
		// If no sort, default to title
		$orderby = ( ! empty( $_GET['orderby'] ) ) ? $_GET['orderby'] : $this->order_column;
		// If no order, default to asc
		$order = ( ! empty($_GET['order'] ) ) ? $_GET['order'] : 'asc';
		// Determine sort order
		$result = strcmp( $a[$orderby], $b[$orderby] );
		// Send final sort direction to usort
		return ( $order === 'asc' ) ? $result : -$result;
	}

	public function set_bulk_actions($bulk_actions) {
		$this->bulk_actions = $bulk_actions;
	}
	public function get_bulk_actions() {
	    return $this->bulk_actions;
	}

	public function process_bulk_action($callback = '') {
		if (is_callable($callback)) {
			return $callback($this->current_action());
		}
	}

	public function set_columns($columns) {
		$this->columns = $columns;
	}
	public function get_columns() {
		return $this->columns;
	}

	public function set_order_column($column) {
		$this->order_column = $column;
	}
  

	public function prepare_items() {
		global $wpdb; //This is used only if making any database queries

		$columns = $this->get_columns();
		$h_idden = [];
		$sortable = $this->get_sortable_columns();
		$this->_column_headers = [$columns, $h_idden, $sortable];

		$data = $this->table_data();
		usort( $data, [&$this, 'usort_reorder' ] );

		$this->process_bulk_action();

		$per_page = 10;
		$current_page = $this->get_pagenum();
		$total_items = count($data);

		$this->_data = array_slice($data,(($current_page-1)*$per_page),$per_page); 

		$this->items = $this->_data;

		$this->set_pagination_args([
			'total_items' => $total_items,                  // WE have to calculate the total number of items
			'per_page'    => $per_page,                     // WE have to determine how many items to show on a page
			'total_pages' => ceil($total_items/$per_page)	// WE have to calculate the total number of pages
		]);
	}
	abstract protected function table_data();
}