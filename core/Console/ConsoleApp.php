<?php 
use Symfony\Component\Console\Application;

$application = new Application();

# add our commands
require_once PLUGIN_NAME_PATH . '/core/Console/ConsoleCommands.php';

$application->run();