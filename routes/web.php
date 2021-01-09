<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'HomeController@home')->name('home');
Route::get('category/{id?}', 'HomeController@category')->name('category');
Route::get('project/{slug?}', 'HomeController@project')->name('project');
Route::get('product/{slug?}', 'HomeController@product')->name('product');
Route::get('service/{slug?}', 'HomeController@service')->name('service');
Route::get('news/{slug?}', 'HomeController@news')->name('news');
Route::get('page/{slug}', 'HomeController@page')->name('page');
Route::post('subscribe', 'HomeController@subscribe')->name('subscribe');
Route::post('seo', 'HomeController@seo')->name('seo');
Route::match(['get', 'post'], 'contact', 'HomeController@contact')->name('contact');
Route::post('callme', 'HomeController@callme')->name('callme');
Route::get('setlocale/{locale}', 'HomeController@language')->name('lang');

Route::group([
    'prefix' => 'admin',
    'middleware' => ['auth', 'log']
], function () {
    Route::get('/', 'Admin\PanelController@home');
    Route::post('contact', 'Admin\PanelController@contact');
    Route::match(['get', 'post'], 'settings', 'Admin\PanelController@settings');
    Route::get('seo/{lang}', 'Admin\PanelController@seosocial');
    Route::post('seo/edit/{lang}', 'Admin\PanelController@seo');
    Route::post('social/edit', 'Admin\PanelController@social');
    Route::get('profile', 'Admin\PanelController@profile')->name('profile');
    Route::match(['get', 'post'], 'profile/edit', 'Admin\PanelController@profile_edit');
    Route::get('logout', 'Admin\PanelController@logout');
    Route::get('callme', 'Admin\PanelController@callme');
    Route::get('contacts', 'Admin\PanelController@contacts');
    Route::match(['get', 'post'], 'homepage/edit/{lang}', 'Admin\PanelController@homepage');
    Route::group([
        'prefix' => 'menu'
    ], function () {
        $name = 'Admin\MenuController@';
        Route::get('/', $name . 'list')->name('amenu');
        Route::post('order', $name . 'order');
        Route::match(['get', 'post'], 'create', $name . 'create');
        Route::match(['get', 'post'], 'edit/{id}/{lang}', $name . 'edit');
        Route::get('delete/{id}', $name . 'delete');
    });
    Route::group([
        'prefix' => 'category'
    ], function () {
        $name = 'Admin\CategoryController@';
        Route::get('/', $name . 'list')->name('acategory');
        Route::post('order', $name . 'order');
        Route::match(['get', 'post'], 'create', $name . 'create');
        Route::match(['get', 'post'], 'edit/{id}/{lang}', $name . 'edit');
        Route::get('delete/{id}', $name . 'delete');
    });
    Route::group([
        'prefix' => 'basic'
    ], function () {
        $name = 'Admin\BasicController@';
        Route::get('/', $name . 'list')->name('abasic');
        Route::match(['get', 'post'], 'create', $name . 'create');
        Route::match(['get', 'post'], 'edit/{id}/{lang}', $name . 'edit');
        Route::get('delete/{id}', $name . 'delete');
    });
    Route::group([
        'prefix' => 'news'
    ], function () {
        $name = 'Admin\NewsController@';
        Route::get('/', $name . 'list')->name('anews');
        Route::match(['get', 'post'], 'create', $name . 'create');
        Route::match(['get', 'post'], 'edit/{id}/{lang}', $name . 'edit');
        Route::get('delete/{id}', $name . 'delete');
    });
    Route::group([
        'prefix' => 'service'
    ], function () {
        $name = 'Admin\ServiceController@';
        Route::get('/', $name . 'list')->name('aservice');
        Route::match(['get', 'post'], 'create', $name . 'create');
        Route::match(['get', 'post'], 'edit/{id}/{lang}', $name . 'edit');
        Route::get('delete/{id}', $name . 'delete');
    });
    Route::group([
        'prefix' => 'slider'
    ], function () {
        $name = 'Admin\SliderController@';
        Route::get('/', $name . 'list')->name('aslider');
        Route::match(['get', 'post'], 'create', $name . 'create');
        Route::match(['get', 'post'], 'edit/{id}/{lang}', $name . 'edit');
        Route::get('delete/{id}', $name . 'delete');
    });
    Route::group([
        'prefix' => 'client'
    ], function () {
        $name = 'Admin\ClientController@';
        Route::get('/', $name . 'list')->name('aclient');
        Route::match(['get', 'post'], 'create', $name . 'create');
        Route::match(['get', 'post'], 'edit/{id}', $name . 'edit');
        Route::get('delete/{id}', $name . 'delete');
    });
    Route::group([
        'prefix' => 'project'
    ], function () {
        $name = 'Admin\ProjectController@';
        Route::get('/', $name . 'list')->name('aproject');
        Route::match(['get', 'post'], 'create', $name . 'create');
        Route::match(['get', 'post'], 'edit/{id}/{lang}', $name . 'edit');
        Route::get('delete/{id}', $name . 'delete');
    });
    Route::group([
        'prefix' => 'product'
    ], function () {
        $name = 'Admin\ProductController@';
        Route::get('/', $name . 'list')->name('aproduct');
        Route::match(['get', 'post'], 'create', $name . 'create');
        Route::match(['get', 'post'], 'edit/{id}/{lang}', $name . 'edit');
        Route::get('delete/{id}', $name . 'delete');
    });
    Route::group([
        'prefix' => 'feedback'
    ], function () {
        $name = 'Admin\FeedbackController@';
        Route::get('/', $name . 'list')->name('afeedback');
        Route::match(['get', 'post'], 'create', $name . 'create');
        Route::match(['get', 'post'], 'edit/{id}', $name . 'edit');
        Route::get('delete/{id}', $name . 'delete');
    });
    Route::group([
        'prefix' => 'users'
    ], function () {
        $name = 'Admin\UsersController@';
        Route::get('/', $name . 'list')->name('ausers');
        Route::get('logs/{id}', $name . 'logs');
        Route::match(['get', 'post'], 'create', $name . 'create');
        Route::match(['get', 'post'], 'edit/{id}', $name . 'edit');
        Route::get('delete/{id}', $name . 'delete');
    });
});

Auth::routes();
Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});

