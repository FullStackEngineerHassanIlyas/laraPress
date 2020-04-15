<?php 

namespace _NAMESPACE_\Core\Helpers;

function plugin_path( $path = '' ) {
	return PLUGIN_NAME_PATH . '/'. trim($path, '/');
}

function config_path( $path = '' ) {
	return plugin_path('app/config/'.$path);
}