<?php

use Illuminate\Support\Facades\Auth;
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
            ['prefix' => '/notes'],
            function () {
                Route::get('', 'NotesController@list')->name('note.list');
                Route::get('/detail', 'NotesController@detail')->name('note.detail');
                Route::get('/filter', 'NotesController@filter')->name('note.filter');


                Route::get('/create', 'NotesController@create')->name('note.create');
                Route::post('', 'NotesController@store')->name('note.store');


                Route::patch('', 'NotesController@update')->name('note.update');

                Route::delete('/detail', 'NotesController@Destroy')->name('note.destroy');
            });

        Route::group(
            ['prefix' => '/tags'],
            function () {
                Route::post('/create', 'TagsController@create');
                Route::delete('/delete', 'TagsController@delete');

                Route::get('/list', 'TagsController@list');
                Route::get('/detail', 'TagsController@detail');

            });

        Route::group(
            ['prefix' => '/favorite', 'middleware' => 'auth:sanctum'],
            function () {
                Route::get('/list', 'FavoriteController@list')->name('fav.list');
                Route::post('/create', 'FavoriteController@create')->name('fav.create');
            });
        Route::group(
            ['prefix' => '/user'],
            function () {
                Route::get('/search', 'UserController@search')->name('user.search');
                Route::get('/detail', 'UserController@detail')->name('user.detail');

                Route::get('/registration', function (){if(Auth::check()){return redirect(route('note.list'));}return view('user.registration');})->name('user.reg');
                Route::post('/registration', 'UserController@registration')->name('user.registration');

                Route::get('/login', function (){
                    if(Auth::check()) {
                        return redirect(route('note.list'));
                    }
                    return view('user.auth');})->name('user.auth');
                Route::post('/login', 'UserController@login')->name('user.login');
                Route::get('/logout','UserController@logout')->name('user.logout');

                Route::patch('', 'UserController@update')->name('user.update');
            });
        Route::group(
            ['prefix' => '/sub'],
            function () {
                Route::post('', 'SubscriberController@createSub')->name('sub.create');
                Route::delete('', 'SubscriberController@destroySub')->name('sub.destroy');
            });
    }
);
