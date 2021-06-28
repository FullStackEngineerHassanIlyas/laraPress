<?php 

namespace _NAMESPACE_\Core\Middleware;

/**
 * Middleware Request class
 */
class WP_Request {
	
	protected $request;

	protected $request_methods = [
		'PUT',
		'PATCH',
		'DELETE',
		'HEAD',
		'OPTIONS',
		'CONNECT',
	];

	function __construct() {
		$this->request = $_REQUEST;

		if ( in_array( $_SERVER['REQUEST_METHOD'], $this->request_methods ) ) {
			parse_str( file_get_contents('php://input'), $request );
			$this->request =  $request;
		}
	}

	public function get( $field = '' ) {
		if ( ! empty( $field ) ) {
			return $this->request[ $field ];
		}

		return $this->all();
	}

	public function all() {
		return $this->request;
	}

	public function __get( $key ) {
		if ( array_key_exists( $key, $this->request ) ) {
            return $this->request[ $key ];
        }
	}
}