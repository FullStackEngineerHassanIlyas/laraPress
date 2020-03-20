<?php 

function plugin_path( $path = '' ) {
	return TEST_APP_PLUGIN_PATH . '/'. trim($path, '/');
}

function config_path( $path = '' ) {
	return plugin_path('app/config/'.$path);
}