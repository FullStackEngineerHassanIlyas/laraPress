<?php 
namespace _NAMESPACE_\core\traits;

/**
 * WP_db database
 */
trait WP_db {

	public $wpdb;
	protected $db;
	function initDB() {
		global $wpdb;
		$this->wpdb = $wpdb;
		$this->db = $this;
	}
	
}