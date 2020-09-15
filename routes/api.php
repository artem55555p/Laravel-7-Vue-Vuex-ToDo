<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/todo', 'Api\TodoController@index')->name('todo');
Route::post('/todo-store', 'Api\TodoController@store')->name('todo-store');
Route::put('/todo-edit/{id}', 'Api\TodoController@update')->name('todo-edit');
Route::put('/todo-drag/{id}', 'Api\TodoController@drag')->name('todo-drag');
Route::delete('/todo-delete/{id}', 'Api\TodoController@destroy')->name('todo-delete');
