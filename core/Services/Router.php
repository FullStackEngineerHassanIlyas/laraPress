<?php 

namespace TestApp\Core\Services;

/**
 * Router
 */
class Router {
	public $routes = [];
	public $query_vars = [];
	private $matches = [];
	private $uri_part = [];
	private $actions;
	
	private static $instance;

	function __construct() {
		
	}

	public function __get( $key ) {
		return $this->{$key};
	}

	private function make_rewrite_tags($vars) {
		$query_str = '';
		$i = 1;
		foreach ($vars as $tag => $regex) {
			add_rewrite_tag( "%{$tag}%", $regex );
			$query_str .= '&'.$tag.'=$matches['.$i.']';
			$i++;
		}
		return $query_str;
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

	private function add_route( $uri, $action, $request_method = 'get' ) {
		$action_parts 	= explode('@', $action);

		$this->action_method = end($action_parts);

		$this->actions[$this->action_method] = [ 'uri' => $uri, 'action' => $action, 'method' => $request_method ];


		return $this;
	}

	/*private function prepare_route( $uri_parts ) {

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
	}*/

	public function register_routes() {
		foreach ($this->actions as $key => $action) {
			foreach ($action['paterns'] as $k => $value) {
				$this->actions[$key]['uri'] = str_replace('{'.$k.'}', '('.$action['paterns'][$k].')', $this->actions[$key]['uri']);
				$uri_segments = explode('/', $this->actions[$key]['uri']);

				$this->actions[$key]['pagename'] = current($uri_segments);
			}
		}

		return $this->actions;
	}

	public function init_routes() {
		global $wp_rewrite;
		// $wp_rewrite->flush_rules();

		foreach ($this->actions as $key => $action) {
			$action_parts 	= explode('@', $action['action']);
			$controller 	= current($action_parts);
			$method 		= end($action_parts);

			add_filter( 'template_include', [ 'TestApp\\App\\Controllers\\'.$controller, $method ], 10, 1 );
			add_rewrite_rule( '^'.$action['uri'].'/?$', 'index.php?pagename='.$action['pagename'].$this->make_rewrite_tags($action['paterns']), 'top' );
		}
		global $wp_query;
		// echo '<pre>';
		// print_r($wp_query);
		// echo '</pre>';
		// return $this->actions;
	}

	public function get( $uri, $action ) {

		$this->add_route( $uri, $action, 'get' )->where(['.*?']);

		return $this;
	}
	public function post( $uri, $action ) {

		$this->add_route( $uri, $action, 'post' )->where(['.*?']);

		return $this;
	}
	public function put( $uri, $action ) {

		$this->add_route( $uri, $action, 'put' )->where(['.*?']);

		return $this;
	}
	public function patch( $uri, $action ) {

		$this->add_route( $uri, $action, 'patch' )->where(['.*?']);

		return $this;
	}
	public function delete( $uri, $action ) {

		$this->add_route( $uri, $action, 'delete' )->where(['.*?']);

		return $this;
	}

	public function where( $paterns ) {
		$this->actions[$this->action_method]['paterns'] = $paterns;
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