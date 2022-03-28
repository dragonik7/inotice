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
            ['prefix' => '/notes', 'namespace'=>'Note'],
            function () {
                Route::get('/list', 'ListController')->name('list');
                Route::get('/detail/{note}', 'DetailController')->name('detail');

                Route::get('/create', 'CreateController')->name('create');
                Route::post('', 'StoreController')->name('store');

                Route::get('/{note}/edit', 'EditController')->name('edit');
                Route::patch('/{note}', 'UpdateController')->name('update');

                Route::delete('/{note}', 'DestroyController')->name('destroy');
            }
        );
    }
);
