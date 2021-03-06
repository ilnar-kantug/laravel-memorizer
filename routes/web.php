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

Route::get('/', 'LandingController@index')->name('landing');

Auth::routes();

Route::get('/verify/{token}', 'Auth\RegisterController@verify')->name('register.verify');

Route::get('/dashboard', 'DashboardController@show')->name('dashboard');

Route::get('/repeat/{pack}', 'RepeatController@index')->name('repeat');

Route::get('/repeat/{id}/session', 'RepeatController@session')->name('repeat.session');
