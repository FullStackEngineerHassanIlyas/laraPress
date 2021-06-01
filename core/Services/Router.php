<?php 

namespace _NAMESPACE_\Core\Services;

use _NAMESPACE_\Core\WP_loader;

/**
 * Router
 */
class Router {

	/**
	 * Routes array
	 * @var array
	 */
	private $routes = [];

	/**
	 * WP_loader instance
	 * @var object
	 */
	private $_wp_loader;
	
	/**
	 * Router instance object
	 * @var object
	 */
	private static $_instance;

	/**
	 * Constructor
	 * @param object $wp_loader Instance of WP_loader
	 */
	function __construct( WP_loader $wp_loader ) {
		$this->_wp_loader = $wp_loader;
	}

	/**
	 * Dump
	 * @param  mixed $value
	 * @return void
	 */
	private function dump( $value ) {
		echo '<pre>';
		print_r($value);
		echo '</pre>';
	}

	/**
	 * Access private property
	 * @param  string $key key name
	 * @return mixed
	 */
	public function __get( $key ) {
		return $this->{ $key };
	}

	/**
	 * Router instance
	 * @return object returns Router instance object
	 */
	public static function instance() {
		if ( ! self::$_instance instanceof self ) {
			self::$_instance = new self;
		}
		return self::$_instance;
	}

	/**
	 * Add a route for custom wp routes
	 * @param string $uri            The Route path
	 * @param string $action         The Controller action
	 * @param string $request_method HTTP request method
	 */
	private function add_route( $uri, $action, $request_method = 'get' ) {
		preg_match_all( '/{([^}]*)}/', $uri, $matches );
		$uri = str_replace( [ '{', '}', '?' ], [ '(', ')', '' ], $uri );
		$uri_segments = explode( '/(', $uri );
		$page 		  =	current( $uri_segments );
		$pagename 	  = str_replace( '/', '_', $page );

		$action_parts 	= explode( '@', $action );

		$this->action_method = end( $action_parts );

		$patterns = array_flip( $matches[1] );

		// if there is any query vars, set default pattern for them
		array_walk( $patterns, function( &$v, $k ) { $v = '[.*?]';} );

		$this->routes[ $this->action_method ] = [
			'uri' 		=> $uri,
			'page' 		=> $page,
			// 'pagename' => $pagename . '_' . $this->action_method,
			'pagename' 	=> strtolower( str_replace( '@', '__', $action ) ),
			'action' 	=> $action,
			'method' 	=> $request_method,
			'matches' 	=> $matches[1],
			'patterns' 	=> $patterns
		];


		return $this;
	}

	/**
	 * Adds rewrite tags for route
	 * @param  array $tags     The rewrite tags to add
	 * @return string          The query string for route pattern
	 */
	private function make_rewrite_tags( $tags ) {
		$query_str = '';
		$regex_str = '';

		if ( ! empty( $tags ) ) {
			$i = 1;
			foreach ( $tags as $tag => $regex ) {
				add_rewrite_tag( "%{$tag}%", $regex );
				$query_str .= '&' . $tag . '=$matches[' . $i . ']';
				$regex_str .= '/(' . $regex . ')';
				$i++;

				# TODO: check this later
				// add_rewrite_rule( $page . $regex_str . '/?$', $redirect . $query_str, 'top' );
			}
		}

		return $query_str;
	}

	/**
	 * Fill all routes into array
	 * 
	 * @return array all routes registered
	 */
	private function register_routes() {
		foreach ( $this->routes as $route => $route_array ) {
			foreach ( $route_array['patterns'] as $k => $value ) {
				$this->routes[ $route ][ 'uri' ] = str_replace( "({$k})", "({$value})", $this->routes[ $route ][ 'uri' ] );
			}
		}

		return $this->routes;
	}

	/**
	 * Add all routes to rewrite rules
	 * @return void
	 */
	public function prepare_routes() {
		foreach ( $this->register_routes() as $key => $route ) {
			// $page 		= '^'.$route['page'];
			$page 		= '^' . $route['uri'];
			$redirect 	= 'index.php?pagename=' . $route['pagename'];
			$query_str  = $this->make_rewrite_tags( $route['patterns'], $page, $redirect );

			add_rewrite_rule( $page . '/?$', $redirect . $query_str, 'top' );
		}
	}

	/**
	 * Routes page template view
	 * @return void
	 */
	public function routes_view() {

		foreach ( $this->routes as $route ) {
			$route_parts 	= explode( '@', $route['action'] );
			$controller 	= current( $route_parts );
			$method 		= end( $route_parts );
			$controllerObj  = $this->_wp_loader->controllerInstances[ $controller ];
			$params 		= array_keys( $route['patterns'] );
			$args 			= [];

			foreach ( $params as $param ) {
				$args[] = get_query_var( $param );
			}

			if ( get_query_var( 'pagename' ) == $route['pagename'] ) {
				if ( $_SERVER['REQUEST_METHOD'] !== strtoupper( $route['method'] ) ) {
					wp_die( $_SERVER['REQUEST_METHOD'] . ' method is not allowed for this route!', __('Method not allowed!') );
				}

				if ( method_exists( $this->_wp_loader->controllerInstances[ $controller ], $method ) ) {
					status_header( 200 );
					$wp_query->is_404 = false;

					add_filter( 'template_include', function( $template ) use ( $controllerObj, $method, $args ) {
						$args[] = $template;

						return $controllerObj->$method( ...$args );
					}, 10, 1 );
				}
			}			
		}
	}

	/**
	 * Add route for get request
	 * @param  string $uri    The Route URL
	 * @param  string $action Controller and Method
	 * @return object         retruns Router object
	 */
	public function get( $uri, $action ) {

		$this->add_route( $uri, $action, 'get' );
		return $this;
	}

	/**
	 * Add route for post request
	 * @param  string $uri    The Route URL
	 * @param  string $action Controller and Method
	 * @return object         retruns Router object
	 */
	public function post( $uri, $action ) {

		$this->add_route( $uri, $action, 'post' )->where( ['.*?'] );

		return $this;
	}

	/**
	 * Add route for put request
	 * @param  string $uri    The Route URL
	 * @param  string $action Controller and Method
	 * @return object         retruns Router object
	 */
	public function put( $uri, $action ) {

		$this->add_route( $uri, $action, 'put' )->where( ['.*?'] );

		return $this;
	}

	/**
	 * Add route for patch request
	 * @param  string $uri    The Route URL
	 * @param  string $action Controller and Method
	 * @return object         retruns Router object
	 */
	public function patch( $uri, $action ) {

		$this->add_route( $uri, $action, 'patch' )->where( ['.*?'] );

		return $this;
	}

	/**
	 * Add route for delete request
	 * @param  string $uri    The Route URL
	 * @param  string $action Controller and Method
	 * @return object         retruns Router object
	 */
	public function delete( $uri, $action ) {

		$this->add_route( $uri, $action, 'delete' )->where( ['.*?'] );

		return $this;
	}

	/**
	 * Add regex pattern for query_vars
	 * @param  array $patterns regex pattern
	 * @return void
	 */
	public function where( $patterns ) {

		if ( is_array( $patterns ) ) {
			foreach ( $patterns as $k => $pattern ) {
				$this->routes[ $this->action_method ]['patterns'][ $k ] = $pattern;
			}
		}
	}
}