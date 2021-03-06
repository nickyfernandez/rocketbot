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

Route::post('/', "PostController@createPost");

Route::post('/post/{id}', "PostController@createComment");

Route::get('/mirar/{id}', "PostController@seePost");

Route::get('/mirartodos', "PostController@seeAllPosts");

Route::get('/mirarmisposts', "PostController@seeMyPosts");

Route::get('/mirarmiscomentarios', "PostController@seeMyComments");

Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');

});
