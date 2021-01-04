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

Route::get('/', function () {
    return view('welcome');
});

Route::group([
    'prefix' => 'admin',
    'middleware' => ['auth']
], function () {
    Route::get('/', 'Admin\PanelController@home');
    Route::post('contact', 'Admin\PanelController@contact');
    Route::match(['get', 'post'], 'settings', 'Admin\PanelController@settings');
    Route::get('profile', 'Admin\PanelController@profile')->name('profile');
    Route::match(['get', 'post'], 'profile/edit', 'Admin\PanelController@profile_edit');
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
});

Auth::routes();
Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});

