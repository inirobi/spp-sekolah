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
Route::get('payment/details/{id}','PaymentController@details')->name('payment.details');

/**
 * Route resource untuk Pengeluaran
 */
Route::resource('expense', 'ExpenseController');

/**
 * Route resource untuk Pembayaran
 */
Route::resource('rekap', 'RekapController');