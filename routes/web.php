<?php

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



$app->group(['prefix' => 'api/user/'], function() use($app)
{
    $app->post('register','UserController@createUser');
    $app->put('upadate/{id}','UserController@updateUser');
    $app->delete('delete/{id}','UserController@deleteUser');
    $app->get('query','UserController@index');
    $app->get('login/{username}/{password}','UserController@login');
});

// $app->get('/','UserController@index' );
//
$app->get('/', function () use ($app) {

     return $app->version();
    });
