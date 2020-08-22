<?php 

namespace _NAMESPACE_\Core\Helpers;

/**
 * The plugin's base path.
 * @param  string $path Relative path to the file.
 * @return string       Full path to file.
 */
function plugin_path( $path = '' ) {
	return PLUGIN_NAME_PATH . '/'. trim( $path, '/' );
}
/**
 * The plugin's config path.
 * @param  string $path Relative path to the file.
 * @return string       Full path to file.
 */
function config_path( $path = '' ) {
	return plugin_path( 'app/config/' . $path );
}