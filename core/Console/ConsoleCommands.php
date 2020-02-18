<?php 

namespace _NAMESPACE_\Core\Console;

_NAMESPACE_\Core\Commands\ControllerCommand;
_NAMESPACE_\Core\Commands\ModelCommand;

$application->add( new ControllerCommand() );
$application->add( new ModelCommand() );