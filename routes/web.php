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


//用户方面
$app->group(['prefix' => 'api/user/'], function() use($app)
{
    $app->post('register','UserController@createUser');
    //PUT对资源完全替换,PATCH局部替换
    $app->patch('update/{id}','UserController@updateUser');
    $app->delete('delete/{id}','UserController@deleteUser');
    $app->get('query','UserController@index');
    $app->get('login/{username}/{password}','UserController@login');
});

//AA分账
$app->group(['prefix' => 'api/averagelist/'], function() use($app)
{
    $app->post('create','AverageListController@createAverageList');
    $app->patch('update/{id}','AverageListController@updateAverageList');
    $app->delete('delete/{id}','AverageListController@deleteAverageList');
    $app->get('query','AverageListController@index');
});

//AA分账细节
$app->group(['prefix' => 'api/averagedetail/'], function() use($app)
{
    $app->post('create','AverageDetailController@createAverageDetail');
    $app->patch('update/{id}','AverageDetailController@updateAverageDetail');
    $app->delete('delete/{id}','AverageDetailController@deleteAverageDetail');
    $app->get('query','AverageDetailController@index');
});

// $app->get('/','UserController@index' );
//
$app->get('/', function () use ($app) {

     return $app->version();
    });
