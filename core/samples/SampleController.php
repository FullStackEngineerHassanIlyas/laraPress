<?php 

namespace TestApp\App\Controllers;

use TestApp\Core\Controllers\WP_Controller as Controller;
use TestApp\App\Traits\HandlerNamespace;

/**
 * SampleController
 */
class SampleController extends Controller {

	use SampleHandler;
	
	function __construct() {
		parent::__construct();
		
	}
}