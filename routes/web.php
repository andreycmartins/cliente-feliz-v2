<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::get('/', 'HomeController@index');
Route::get('/users', 'UserController@index');
Auth::routes(['verify' => true]);
Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');
Route::post('/users', 'UserController@store')->name('users.store');
Route::delete('/users/delete/{id}', 'UserController@destroy')->name('users.destroy');
Route::put('/users/edit/{id}', 'UserController@update')->name('users.update');
Route::get('/users/edit/{id}', 'UserController@edit')->name('users.edit');