<?php 

namespace TestApp\Core\Routes;

use TestApp\Core\Route\Router;

$router = new Router;
// Router::get('mp-page/([^/]+)', 'UserController@template_cb');

$router->get('mp-page/{username}/{id}', 'UserController@template_cb')->where(['username' => '[a-zA-Z]+', 'id' => '[0-9]']);
$router->get('product/{product}/{id}', 'UserController@product_method')->where(['product' => '[a-z]+', 'id' => '[0-9]+']);


// print_r($router->get_uri_part());
echo '<pre>';
print_r($router->get_actions());
echo '</pre>';
exit;