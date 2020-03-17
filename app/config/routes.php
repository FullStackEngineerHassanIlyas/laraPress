<?php 

namespace TestApp\Core\Routes;


// Router::get('mp-page/([^/]+)', 'UserController@template_cb');

$router->get('my-page/{username}/{id}', 'UserController@template_cb')->where(['username' => '[a-zA-Z]+', 'id' => '[0-9]']);
$router->get('product/{product}/{id}', 'UserController@product_method')->where(['product' => '[a-z]+', 'id' => '[0-9]+']);
