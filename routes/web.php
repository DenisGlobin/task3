<?php

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

Route::redirect('/', '/p=0');
Route::get('/p={n}', 'FeedsController@index')->where(['n' => '[0-9]+'])->name('/');
Route::get('news/{id}', 'FeedsController@showNews')->where(['id' => '[0-9a-z]+'])->name('news');