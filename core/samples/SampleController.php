<?php 

namespace _NAMESPACE_\App\Controllers;

use _NAMESPACE_\Core\Controllers\baseController;
use _NAMESPACE_\App\Traits\HandlerNamespace;

/**
 * SampleController
 */
class SampleController extends baseController {

	use SampleHandler;
	
	function __construct() {
		
	}
}