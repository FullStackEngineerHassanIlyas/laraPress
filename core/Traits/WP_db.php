<?php 
namespace _NAMESPACE_\Core\Traits;
use Illuminate\Database\Capsule\Manager as Db;

/**
 * WP_db database
 */
trait WP_db {

	public $wpdb;
	protected $db;

	/**
	 * Init the Eloquent.
	 * @return void
	 */
	function initDB() {

		global $wpdb;
		$this->wpdb = $wpdb;
		$db = new Db;

		$db->addConnection([
		    'driver'    => 'mysql',
		    'host'      => DB_HOST,
		    'database'  => DB_NAME,
		    'username'  => DB_USER,
		    'password'  => DB_PASSWORD,
		    'charset'   => DB_CHARSET,
		    'collation' => $this->wpdb->collate, 
		    'prefix'    => $this->wpdb->prefix,
		]);
		$db->setAsGlobal();
    	$db->bootEloquent();
	}
	
}