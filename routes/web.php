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
});