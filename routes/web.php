<?php

use Dingo\Api\Routing\Router;

$apiConfig = config('api');
$api = app(Router::class);

\Illuminate\Support\Facades\Route::get('api/upload/verify', 'API\UploadController@verify');

$api->version(
    $apiConfig['version'],
    [
        'namespace' => 'App\\Http\\Controllers\API',
        'middleware' => 'api.throttle',
        'limit' => 60,
        'expires' => 1,
    ],
    function (Router $api) {
        $api->get('upload/direct', 'UploadController@direct');
        $api->get('search', 'Article\SearchArticle');
        $api->get('articles', 'Article\IndexArticle');
        $api->get('articles/{article}', 'Article\ShowArticle');
        $api->get('categories/{category}/articles', 'Article\ArticleCategory');
        $api->get('about', 'About\ShowAbout');
        $api->get('archives', 'Archive\IndexArchive');
        $api->get('settings', 'Setting\ShowSetting');
        $api->post('admin/login', 'Auth\Login');
        $api->post('admin/logout', 'Auth\Logout');
        $api->group([
            'prefix' => 'admin',
            'middleware' => 'token.refresh',
        ], function (Router $api) {
            $api->post('password', 'Auth\UpdatePassword');
            $api->post('images', 'Image\UploadImage');
            $api->delete('images', 'Image\DeleteImage');
            $api->get('about', 'About\ShowAbout');
            $api->post('about', 'About\UpdateAbout');
            $api->delete('tags/{tag}', 'Tag\DeleteTag');
            $api->get('settings', 'Setting\ShowSetting');
            $api->post('settings', 'Setting\UpdateSetting');
            $api->post('settings/avatar', 'Setting\UpdateAvatar');
            $api->get('categories', 'Category\IndexCategory');
            $api->post('categories', 'Category\StoreCategory');
            $api->patch('categories/{category}', 'Category\UpdateCategory');
            $api->delete('categories/{category}', 'Category\DeleteCategory');
            $api->patch('articles/{article}/publish', 'Article\TogglePublish');
            $api->get('articles', 'Article\IndexArticle');
            $api->post('articles', 'Article\StoreArticle');
            $api->get('articles/{article}', 'Article\ShowArticle');
            $api->patch('articles/{article}', 'Article\UpdateArticle');
            $api->delete('articles/{article}', 'Article\DeleteArticle');
        });
    });
