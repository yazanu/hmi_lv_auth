<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::group(['namespace' => 'App\Http\Controllers'], function(){
    Route::get('/', 'HomeController@home');
    Route::get('/register', 'AuthController@registerForm');
    Route::post('/registration', 'AuthController@registration');
    Route::get('/logout', 'AuthController@logout');
    Route::get('/login', 'AuthController@loginForm');
    Route::post('/user-login', 'AuthController@login');
    Route::resource('products', 'ProductController')->middleware(['is_active']);
    Route::resource('permissions', 'PermissionController');
});

