<?php 

namespace TestApp\App\Models;

use TestApp\Core\Models\WP_Model;

/**
 * User Model
 */
class User extends WP_Model {

	protected $table = 'users';
	
	function __construct() {
		
	}

}