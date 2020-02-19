<?php 

namespace _NAMESPACE_\Core\Console;

use _NAMESPACE_\Core\Commands\ControllerCommand;
use _NAMESPACE_\Core\Commands\ModelCommand;

$application->add( new ControllerCommand() );
$application->add( new ModelCommand() );