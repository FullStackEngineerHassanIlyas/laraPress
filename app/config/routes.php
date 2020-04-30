<?php 

namespace _NAMESPACE_\Core\Routes;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your WordPress website.
| Now create something great!
|
| use $router @var to add your routes
| 
| Example:
| $router->get('custom/route/page', 'PageController@myPage');
|
*/

$router->get('my-page', 'UserController@template_cb');
$router->get('my-page/{username}/id/{id}', 'UserController@sample_cb')->where(['username' => '[a-zA-Z]+', 'id' => '[0-9]']);
$router->get('products/sample', 'UserController@product_method');
