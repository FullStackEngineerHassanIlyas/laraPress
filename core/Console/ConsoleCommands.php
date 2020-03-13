<?php 

namespace TestApp\Core\Console;

use TestApp\Core\Commands\ControllerCommand;
use TestApp\Core\Commands\ModelCommand;

$application->add( new ControllerCommand() );
$application->add( new ModelCommand() );