<?php 

namespace TestApp\Core\Console;

use Symfony\Component\Console\Application;

$application = new Application();

# add our commands
require_once TEST_APP_PLUGIN_PATH . '/core/Console/ConsoleCommands.php';

$application->run();