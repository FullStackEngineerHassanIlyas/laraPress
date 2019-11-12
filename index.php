<?php
/**
 * Plugin Name
 *
 * @package     PluginPackage
 * @author      Your Name
 * @copyright   2019 Your Name or Company Name
 * @license     GPL-2.0-or-later
 *
 * @wordpress-plugin
 * Plugin Name: Plugin Name
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

use core\{WP_loader};
use app\App;

require_once WP_PLUGIN_DIR.'/'.PLUGIN_NAME.'/core/WP_loader.php';
$wp_loader = new WP_loader;
$app = new App;