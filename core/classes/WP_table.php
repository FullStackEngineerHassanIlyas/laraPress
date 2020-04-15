<?php

namespace _NAMESPACE_\Core\Classes;

/**
 * Include WP list table core class
 * if not already added
 */
if(!class_exists('WP_List_Table')){
	require_once( ABSPATH . 'wp-admin/includes/screen.php' );
	require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
}

/**
 * WP table base class for framwork
 */
abstract class WP_table extends \WP_List_Table {

	/**
	 * All table protected properties
	 */
	protected
		$_data = [],
		$viwe_links = [],

		$bulk_actions = [],
		$default_columns = [],
		$sortable_columns = [],
		$columns = [],
		$order_column = 'id';

	/**
	 * Constructor
	 *
	 * The child class should call this constructor from its own constructor to override
	 * the default $args.
	 *
	 * @param array|string $args Array or string of arguments.
	 */
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

    /**
     * Set view links for get view links
     * @param array $viwe_links
     */
    public function set_views($viwe_links = []) {
    	$this->viwe_links = $viwe_links;
    }

    /**
     * Get an associative array ( id => link ) with the list
	 * of views available on this table.
     * @return array
     */
	protected function get_views() {
		/*$this->viwe_links = [
			'all'       => __('<a href="#">All</a>','my-plugin-slug'),
			'published' => __('<a href="#">Published</a>','my-plugin-slug'),
			'trashed'   => __('<a href="#">Trashed</a>','my-plugin-slug')
		];*/
		return $this->viwe_links;
	}

	/**
	 * Set default columns for table
	 * @param array $columns
	 */
	public function set_default_columns($columns) {
		$this->default_columns = $columns;
	}

	/**
	 * For default column
	 * @param  object $item        Item object
	 * @param  string $column_name Column name to be default
	 * @return array
	 */
	public function column_default($item, $column_name) {
		if (in_array($column_name, $this->default_columns)) {
			return $item[$column_name];
		}
	}

	/**
	 * Set sortable columns
	 * @param array $columns
	 */
	public function set_sortable_columns($columns) {
		$this->sortable_columns = $columns;
	}

	/**
	 * Get sortable columns
	 * @return array
	 */
	public function get_sortable_columns() {
	    return $this->sortable_columns;
	}

	/**
	 * Sorting for clumns
	 * @param  array $a
	 * @param  array $b
	 * @return array
	 */
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

	/**
	 * Set Bullk actions
	 * @param array $bulk_actions
	 */
	public function set_bulk_actions($bulk_actions) {
		$this->bulk_actions = $bulk_actions;
	}

	/**
	 * Get Bulk actions
	 * @return array
	 */
	public function get_bulk_actions() {
	    return $this->bulk_actions;
	}

	/**
	 * Process bulk actions
	 * @param  callable $callback
	 * @return callable
	 */
	public function process_bulk_action($callback = '') {
		if (is_callable($callback)) {
			return $callback($this->current_action());
		}
	}

	/**
	 * Set table columns
	 * @param array $columns
	 */
	public function set_columns($columns) {
		$this->columns = $columns;
	}

	/**
	 * Get table columns
	 * @return array
	 */
	public function get_columns() {
		return $this->columns;
	}

	/**
	 * Set table order column
	 * @param string $column
	 */
	public function set_order_column($column) {
		$this->order_column = $column;
	}

	/**
	 * Get ready table items to be display
	 */
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

	/**
	 * This method should be owerite by child class
	 */
	abstract protected function table_data();
}