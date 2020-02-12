<?php 

namespace _NAMESPACE_\App\Controllers;

use _NAMESPACE_\Core\Controllers\WP_Controller as Controller;
use _NAMESPACE_\App\Traits\HandlerNamespace;

/**
 * SampleController
 */
class SampleController extends Controller {

	use SampleHandler;
	
	function __construct() {
		
	}
}