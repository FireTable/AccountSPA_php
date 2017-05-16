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

//获取七牛token
$app->group(['prefix' => 'api/token/'], function() use($app)
{
    $app->get('query','UserController@getToken');

});

//用户方面
$app->group(['prefix' => 'api/user/'], function() use($app)
{
    $app->post('register','UserController@createUser');
    //PUT对资源完全替换,PATCH局部替换
    $app->patch('update/{id}','UserController@updateUser');
    $app->delete('delete/{id}','UserController@deleteUser');
    $app->get('query','UserController@index');
    $app->get('queryActor/{actor_id}','UserController@queryActor');
    $app->get('login/{username}/{password}','UserController@login');
});

//AA分账
$app->group(['prefix' => 'api/averagelist/'], function() use($app)
{
    $app->post('create','AverageListController@createAverageList');
    $app->patch('update/{id}','AverageListController@updateAverageList');
    $app->delete('delete/{id}','AverageListController@deleteAverageList');
    $app->get('query','AverageListController@index');
    $app->get('query/{id}','AverageListController@queryAverageList');
    $app->patch('addlist/{id}','AverageListController@addAverageList');
    $app->delete('outlist/{id}/{userid}/{actorid}/{averagelistsid}','AverageListController@outAverageList');
});

//AA分账细节
$app->group(['prefix' => 'api/averagedetail/'], function() use($app)
{
    $app->post('create','AverageDetailController@createAverageDetail');
    $app->patch('update/{id}','AverageDetailController@updateAverageDetail');
    $app->delete('delete/{id}','AverageDetailController@deleteAverageDetail');
    $app->get('query','AverageDetailController@index');
    $app->get('query/{id}','AverageDetailController@queryDetails');
});


//AA分账结果
$app->group(['prefix' => 'api/averageresult/'], function() use($app)
{
    $app->get('query/{id}/{userid}','AverageResultController@queryDetails');
});

// $app->get('/','UserController@index' );
//
$app->get('/', function () use ($app) {

     return $app->version();
    });
