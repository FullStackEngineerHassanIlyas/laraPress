<?php 

namespace TestApp\Core\Routes;

use TestApp\Core\Services\Router;


$router = new Router;
// print_r($router);
// exit;
// Router::get('mp-page/([^/]+)', 'UserController@template_cb');

$router->get('mp-page/{username}/{id}', 'UserController@template_cb')->where(['username' => '[a-zA-Z]+', 'id' => '[0-9]']);
$router->get('product/{product}/{id}', 'UserController@product_method')->where(['product' => '[a-z]+', 'id' => '[0-9]+']);


$router->register_routes();

// exit;
// echo '<pre>';
// print_r($router->get_actions());
// echo '</pre>';
// exit;
return $router;