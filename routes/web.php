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

Auth::routes();

Route::get('/', 'TaskController@index')->name('home');
Route::get('/tasks/{task}/complete', 'TaskController@complete')
    ->name('tasks.complete');
Route::get('/tasks/{task}/revert', 'TaskController@revert')
    ->name('tasks.revert');
Route::resource('tasks', 'TaskController');

