<?php

use Illuminate\Http\Request;
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

Route::group(
    ['prefix' => '/notes', 'middleware' => 'auth:sanctum'],
    function () {
        Route::get('', 'NotesController@list')->name('note.list');
        Route::get('/detail', 'NotesController@detail')->name('note.detail');
        Route::get('/filter', 'NotesController@filter')->name('note.filter');


        Route::get('/create', 'NotesController@create')->name('note.create');
        Route::post('', 'NotesController@store')->name('note.store');


        Route::get('/edit', 'NotesController@edit')->name('note.edit');
        Route::patch('', 'NotesController@update')->name('note.update');

        Route::delete('/detail', 'NotesController@destroy')->name('note.destroy');
    });

Route::group(
    ['prefix' => '/tags', 'middleware' => 'auth:sanctum'],
    function () {
        Route::post('/create', 'TagsController@create');
        Route::delete('/delete', 'TagsController@delete');

        Route::get('', 'TagsController@list');
        Route::get('/{tagName}', 'TagsController@detail');

    });

Route::group(
    ['prefix' => '/favorite', 'middleware' => 'auth:sanctum'],
    function () {
        Route::get('/list', 'FavoriteController@list')->name('fav.list');
        Route::post('/create', 'FavoriteController@create')->name('fav.create');
    });


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::group(
    ['prefix' => '/user'],
    function () {
        Route::get('/search', 'UserController@search')->name('user.search');
        Route::get('/detail', 'UserController@detail')->name('user.detail');

        Route::get('/registration', 'UserController@reg')->name('user.reg');
        Route::post('/registration', 'UserController@registration')->name('user.registration');
        Route::get('/login', 'UserController@auth')->name('user.auth');
        Route::post('/login', 'UserController@login')->name('user.login');
        Route::get('/logout', 'UserController@logout')->name('user.logout');

        Route::patch('', 'UserController@update')->name('user.update');
    });
Route::group(
    ['prefix' => '/sub', 'middleware' => 'auth:sanctum'],
    function () {
        Route::post('', 'SubscriberController@createSub')->name('sub.create');
        Route::delete('', 'SubscriberController@destroySub')->name('sub.destroy');
    });
