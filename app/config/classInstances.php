<?php 
return [

    /*
    |--------------------------------------------------------------------------
    | Hooks autoloader
    |--------------------------------------------------------------------------
    |
    */
	'hooks' => [
		TestApp\App\Controllers\Hooks::class,
	],

    /*
    |--------------------------------------------------------------------------
    | Menus autoloader
    |--------------------------------------------------------------------------
    |
    */
	'menus' => [
		TestApp\App\Controllers\Menu_page::class
	],

    /*
    |--------------------------------------------------------------------------
    | Shortcodes autoloader
    |--------------------------------------------------------------------------
    |
    */
	'shortcodes' => [
		TestApp\App\Controllers\Shortcodes::class
	]

];