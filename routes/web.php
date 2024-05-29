<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->post('/register', 'AuthController@register');
$router->post('/login', 'AuthController@login');

$router->get('/role', ['middleware' => ['auth:api', 'permission:role-index'], 'uses' => 'RoleController@index']);
$router->get('/role/{id}', ['middleware' => ['auth:api', 'permission:role-index'], 'uses' => 'RoleController@show']);
$router->post('/role',['middleware' => ['auth:api', 'permission:role-store'], 'uses' => 'RoleController@store']);
$router->put('/role/{id}', ['middleware' => ['auth:api', 'permission:role-update'], 'uses' => 'RoleController@update']);
$router->delete('/role/{id}', ['middleware' => ['auth:api', 'permission:role-destroy'], 'uses' => 'RoleController@destroy']);

$router->get('/permission', ['middleware' => ['auth:api', 'permission:role-index'], 'uses' => 'PermissionController@index']);
$router->put('/permission/{id}/sync', ['middleware' => ['auth:api', 'permission:role-update'], 'uses' => 'PermissionController@sync']);

$router->get('/user', ['middleware' => ['auth:api', 'permission:user-index'], 'uses' => 'UserController@index']);
$router->get('/user/{id}', ['middleware' => ['auth:api', 'permission:user-index'], 'uses' => 'UserController@show']);
$router->post('/user',['middleware' => ['auth:api', 'permission:user-store'], 'uses' => 'UserController@store']);
$router->put('/user/{id}', ['middleware' => ['auth:api', 'permission:user-update'], 'uses' => 'UserController@update']);
$router->delete('/user/{id}', ['middleware' => ['auth:api', 'permission:user-destroy'], 'uses' => 'UserController@destroy']);

$router->get('/contact', ['middleware' => ['auth:api', 'permission:contact-index'], 'uses' => 'ContactController@index']);
$router->get('/contact/{id}', ['middleware' => ['auth:api', 'permission:contact-index'], 'uses' => 'ContactController@show']);
$router->post('/contact',['middleware' => ['auth:api', 'permission:contact-store'], 'uses' => 'ContactController@store']);
$router->put('/contact/{id}', ['middleware' => ['auth:api', 'permission:contact-update'], 'uses' => 'ContactController@update']);
$router->delete('/contact/{id}', ['middleware' => ['auth:api', 'permission:contact-destroy'], 'uses' => 'ContactController@destroy']);