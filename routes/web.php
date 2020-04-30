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

/**
 * @description Route home
 * 
 */

 Route::get('home', function(){
     return view('dashboard.index');
 })->name('home');

//============================MASTER=================

//majors
Route::resource('/majors', 'MajorController');
//student
Route::resource('students', 'StudentController');

/**
 * Route resource untuk User
 */
Route::resource('user', 'UserController');

/**
 * Route resource untuk Kategori Pembiayaan
 */
Route::resource('financing', 'FinancingCategoryController');
Route::get('financing/history/{id}', 'FinancingCategoryController@history');
Route::get('financing/periode/{id}', 'FinancingCategoryController@periode')->name('financing.periode');
Route::get('financing/ajax/periode/{id}', 'FinancingCategoryController@periode_ajax');

/**
 * Route Periode Pembayaran
 */
Route::post('financing/periode/store', 'FinancingCategoryController@periode_store')->name('periode.store');

/**
 * Route resource untuk Pembayaran
 */
Route::resource('payment', 'PaymentController');
// Route::get('payment/{id}/{}', 'FinancingCategoryController@history');
Route::post('payment/metode','PaymentController@storeMetodePembayaran')->name('payment.storeMethod');
Route::get('payment/details/{id}/{id_siswa}/{id_payment}','PaymentController@details')->name('payment.details.cicilan');
Route::post('payment/details/store','PaymentController@cicilanStore')->name('payment.details.cicilan.store');

/**
 * Route resource untuk Pengeluaran
 */
Route::resource('expense', 'ExpenseController');

/**
 * Route resource untuk Pembayaran
 */
Route::resource('rekap', 'RekapController');


/**
 * Route Login
 */
Route::get('/','LoginController@index')->name('default');
Route::get('/login','LoginController@index')->name('login');
Route::post('/login', 'loginController@loginPost')->name('login.store');
Route::get('/logout', 'HomeController@logout')->name('logout');
Route::post('/ChangePassword', 'HomeController@change')->name('password.change');