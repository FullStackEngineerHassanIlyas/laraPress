<?php

use _NAMESPACE_\Core\WP_loader;
use _NAMESPACE_\App\App;

/**
 * Plugin_Name
 *
 * @package     PluginPackage
 * @author      Your Name
 * @copyright   2019 Your Name or Company Name
 * @license     GPL-2.0-or-later
 *
 * @wordpress-plugin
 * Plugin Name: Plugin_Name
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

define('PLUGIN_NAME', basename(__DIR__));
define('PLUGIN_NAME_URL', plugin_dir_url( __FILE__ ));
define('PLUGIN_NAME_PATH', WP_PLUGIN_DIR.'/'.PLUGIN_NAME);

require_once PLUGIN_NAME_PATH.'/core/WP_loader.php';
WP_loader::init();
$app = new App();