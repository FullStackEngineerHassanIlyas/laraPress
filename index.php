<?php

use TestApp\Core\WP_loader;
use TestApp\App\App;

/**
 * Test App
 *
 * @package     PluginPackage
 * @author      Your Name
 * @copyright   2019 Your Name or Company Name
 * @license     GPL-2.0-or-later
 *
 * @wordpress-plugin
 * Plugin Name: Test App
 * Plugin URI:  https://example.com/plugin-name
 * Description: Description of the plugin.
 * Version:     1.0.0
 * Author:      Your Name
 * Author URI:  https://example.com
 * Text Domain: plugin-slug
 * License:     GPL v2 or later
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 */
defined('ABSPATH') || exit('No direct script access allowed');

define('TEST_APP_PLUGIN', basename(__DIR__));
define('TEST_APP_PLUGIN_URL', plugin_dir_url( __FILE__ ));
define('TEST_APP_PLUGIN_PATH', WP_PLUGIN_DIR.'/'.TEST_APP_PLUGIN);

require_once TEST_APP_PLUGIN_PATH.'/core/WP_loader.php';
WP_loader::init();
$app = new App();