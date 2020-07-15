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

use Illuminate\Support\Facades\Route;

// Single route
Route::name('welcome')->get('/', 'PagesController@welcome');

// Multiple routes: index, store, show, update, destroy, edit
Route::resource('orders', 'OrdersController');

