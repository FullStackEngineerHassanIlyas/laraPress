<?php 

namespace TestApp\Core\Route;

/**
 * Router
 */
class Router {
	public $routes = [];
	public $query_vars = [];
	private $matches = [];
	private $uri_part = [];
	
	private static $instance;

	function __construct() {
		
	}

	public static function instance() {
		if ( !self::$instance instanceof self ) {
			self::$instance = new self;
		}
		return self::$instance;
	}

	public function get_actions() {
		return $this->actions;
	}

	private function add_route( $uri, $action ) {
		$action_parts 	= explode('@', $action);

		$this->action_method = end($action_parts);

		$this->actions[$this->action_method] = [ 'uri' => $uri, 'action' => $action ];


		return $this;
	}

	private function prepare_route( $uri_parts ) {

		foreach ($uri_parts as $part) {

			if ( preg_match('/\{([^)]*)\}/', $part ,$matches) ) {
				$query_var = str_replace(['{', '}'], '', $part);
				$this->query_vars[$query_var] = $query_var;
				$this->matches[$query_var] = '.*?';
			} else {
				$this->uri_part[$part] = $part;
			}

		}

		$this->add_paterns()->add_routes();

	}

	public function register_routes() {
		if ( !empty( $this->actions ) ) {
			foreach ( $this->actions as $i => $args ) {
				$uri 	= $args['uri'];
				$action = $args['action'];

				$uri_parts 	= explode('/', $uri);

				$this->prepare_route( $uri_parts );
				
			}
		}
	}

	public function get( $uri, $action ) {

		$this->add_route( $uri, $action )->where(['.*?']);


		// add_action( 'init', function() {
		// 	add_rewrite_rule( '^'.implode('/', self::instance()->get_uri_part()).'/?$', 'index.php?pagename=my-page', 'top' );
		// } );
		return $this;
	}

	public function where( $paterns ) {
		$this->actions[$this->action_method]['paterns'] = $paterns;
		// $this->matches = $matches;

		// $this->add_paterns()->add_routes();
	}

	public function add_paterns() {
		if ( !empty( $this->matches ) ) {
			foreach ( $this->matches as $key => $match ) {
				$this->query_vars[ $key ] = '('.$match.')';
			}
		}

		// clean empty keys
		foreach ($this->query_vars as $key => $value) {
			if (isset( $this->query_vars[ $value ] )) {				
				unset( $this->query_vars[ $value ] );
			}
		}

		return $this;
	}

	public function add_routes() {
		$this->routes[$this->action_method] = $this->get_uri_part();
	}
	public function get_query_vars() {

		return $this->query_vars;
	}

	public function get_uri_part() {
		return array_merge($this->uri_part, $this->query_vars);
	}
}