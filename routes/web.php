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

Route::get('/', function () {
    return view('dashboard.index');
});


// hanya untuk tamu yg belum auth
Route::get('/login', 'LoginController@getLogin')->middleware('guest');
Route::post('/login', 'LoginController@postLogin');
Route::get('/logout', 'LoginController@logout');

Route::get('/adminAuth', function() {
    return view('admin');
})->middleware('auth:admin');

Route::get('/userAuth', function() {
    return view('user');
})->middleware('auth:user');

//============================MASTER=================

//majors
Route::resource('/majors', 'MajorController');
Route::resource('students', 'StudentController');

/**
 * Route resource untuk User
 */
Route::resource('user', 'UserController');

/**
 * Route resource untuk Kategori Pembiayaan
 */
Route::resource('financing', 'FinancingCategoryController');
