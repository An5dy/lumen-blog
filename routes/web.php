<?php

$apiConfig = config('api');
$api = app('Dingo\Api\Routing\Router');

$api->version($apiConfig['version'], [
    'namespace' => 'App\\Http\\Controllers',
], function ($api) {
    $api->post('login', 'AuthController@login');
    $api->post('refresh', 'AuthController@refresh');
    $api->group(['middleware' => 'token.refresh'], function ($api) {
        $api->get('me', 'UserController@me');
        $api->post('categories', 'CategoriesController@store');
        $api->patch('categories/{category}', 'CategoriesController@update');
        $api->delete('categories/{category}', 'CategoriesController@destroy');
        $api->post('articles', 'ArticlesController@store');
        $api->patch('articles/{article}', 'ArticlesController@update');
        $api->delete('articles/{article}', 'ArticlesController@destroy');
    });
    $api->group(['middleware' => 'auth'], function ($api) {
        $api->post('logout', 'AuthController@logout');
    });
    $api->get('categories', 'CategoriesController@index');
    $api->get('articles', 'ArticlesController@index');
    $api->get('articles/{article}', 'ArticlesController@show');
});
