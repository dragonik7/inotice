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

Route::group(
    ['prefix' => '/notice'],
    function () {

        Route::group(
            ['prefix' => '/tags'],
            function () {
                Route::post('/create', 'TagsController@create');
                Route::delete('/delete', 'TagsController@delete');

                Route::get('/list', 'TagsController@list');
                Route::get('/detail', 'TagsController@detail');

            }
        );
        Route::group(
            ['prefix' => '/notes'],
            function () {
                Route::get('/list', 'NotesController@list')->name('list');
                Route::get('/detail', 'NotesController@detail')->name('detail');

                Route::get('/create', 'NotesController@create')->name('create');
                Route::post('', 'NotesController@store')->name('store');

                Route::get('/edit', 'NotesController@Edit')->name('edit');
                Route::patch('', 'NotesController@update')->name('update');

                Route::delete('', 'NotesController@Destroy')->name('destroy');
            }
        );
        Route::group(
            ['prefix' => '/favorite'],function(){
                Route::get('/list', 'FavoriteController@list')->name('favor_list');
                Route::post('/create', 'FavoriteController@create')->name('create_favorite');
        });
    }
);
