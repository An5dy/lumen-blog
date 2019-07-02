<?php

$apiConfig = config('api');
$api = app('Dingo\Api\Routing\Router');

$api->version($apiConfig['version'], [
    'namespace' => 'App\\Http\\Controllers',
], function ($api) {
    $api->get('categories', 'CategoriesController@index');
    $api->post('categories', 'CategoriesController@store');
    $api->patch('categories/{category}', 'CategoriesController@update');
    $api->delete('categories/{category}', 'CategoriesController@destroy');
    $api->get('articles', 'ArticlesController@index');
    $api->post('articles', 'ArticlesController@store');
    $api->get('articles/{article}', 'ArticlesController@show');
    $api->patch('articles/{article}', 'ArticlesController@update');
    $api->delete('articles/{article}', 'ArticlesController@destroy');

    $api->post('auth/login', 'AuthController@login');
});