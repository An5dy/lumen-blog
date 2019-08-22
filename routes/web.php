<?php

$apiConfig = config('api');
$api = app('Dingo\Api\Routing\Router');

// 前台 API
$api->version($apiConfig['version'], [
    'namespace' => 'App\\Http\\Controllers',
    'middleware' => 'api.throttle',
    'limit' => 20,
    'expires' => 1,
], function ($api) {
    $api->get('search', 'SearchController@index');
    $api->get('articles', 'ArticlesController@index');
    $api->get('articles/{article}', 'ArticlesController@show');
    $api->get('about', 'AboutController@index');
    $api->get('categories/{category}/articles', 'CategoriesController@articles');
    $api->get('archives', 'ArchivesController@index');
    $api->get('setting', 'SettingController@index');
});

// 后台 API
$api->version($apiConfig['version'], [
    'namespace' => 'App\\Http\\Controllers\\Admin',
    'prefix' => 'api/admin',
], function ($api) {
    $api->post('login', 'AuthController@login');
    $api->group(['middleware' => 'token.refresh'], function ($api) {
        $api->get('articles', 'ArticlesController@index');
        $api->post('articles', 'ArticlesController@store');
        $api->get('articles/{article}', 'ArticlesController@show');
        $api->patch('articles/{article}', 'ArticlesController@update');
        $api->patch('articles/{article}/upper', 'ArticlesController@upper');
        $api->patch('articles/{article}/lower', 'ArticlesController@lower');
        $api->delete('articles/{article}', 'ArticlesController@destroy');
        $api->get('categories', 'CategoriesController@index');
        $api->post('categories', 'CategoriesController@store');
        $api->patch('categories/{category}', 'CategoriesController@update');
        $api->delete('categories/{category}', 'CategoriesController@destroy');
        $api->delete('tags/{tag}', 'TagController@index');
        $api->get('about', 'AboutController@index');
        $api->post('about', 'AboutController@updateOrCreate');
        $api->post('password', 'AuthController@password');
        $api->post('images', 'ImagesController@store');
        $api->delete('images', 'ImagesController@destroy');
        $api->get('settings', 'SettingsController@index');
        $api->post('settings', 'SettingsController@updateOrCreate');
        $api->post('settings/avatar', 'SettingsController@avatar');
    });

    $api->group(['middleware' => 'auth'], function ($api) {
        $api->post('logout', 'AuthController@logout');
    });
});