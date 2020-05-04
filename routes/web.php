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
Route::get('/', function () {
    return redirect()->route('home');
});

 Route::get('home', 'HomeController@index')->name('home');

//============================MASTER=================

//majors
Route::resource('/majors', 'MajorController');
//student
Route::resource('students', 'StudentController');
Route::post('students_filter', 'StudentController@filter')->name('students.filter');

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
Route::delete('financing/periode/destroy/{id}/{kategori}', 'FinancingCategoryController@periode_destroy')->name('periode.destroy');
 
/**
 * Route resource untuk Pembayaran
 */
Route::resource('payment', 'PaymentController');
Route::get('payment/category/{id}', 'PaymentController@indexKategori2')->name('payment.category');
/**
 * Route pembayaran jenis "sekali bayar"
 */
Route::post('payment/metode','PaymentController@storeMetodePembayaran')->name('payment.storeMethod');
Route::get('payment/details/{id}/{id_siswa}/{id_payment}','PaymentController@details')->name('payment.details.cicilan');
Route::post('payment/details/store','PaymentController@cicilanStore')->name('payment.details.cicilan.store');
/**
 * Route pembayaran jenis "per bulan"
 */
Route::get('payment/perbulan/{id}', 'PaymentController@showBulanan')->name('payment.monthly.show');
Route::get('payment/perbulan/detail/{payment}/{student}/{category}', 'PaymentController@showBulananDetail')->name('payment.monthly.show.detail');
Route::post('payment/perbulan/detail/','PaymentController@bulananStore')->name('payment.monthly.detail.store');
Route::put('payment/perbulan/detail/update','PaymentController@updateStatusBulanan')->name('payment.monthly.detail.update');
Route::post('payment/perbulan/detail/add','PaymentController@addPeriodeBulanan')->name('payment.monthly.detail.add');
/**
 * Route resource untuk Pengeluaran
 */
Route::resource('expense', 'ExpenseController');

/**
 * Route resource untuk Pembayaran
 */
Route::resource('rekap', 'RekapController');

/**
 * Route resource untuk Pembayaran
 */
Route::resource('income', 'IncomeController');

/**
 * Route Login
 */
// Route::get('/','LoginController@index')->name('default');
// Route::get('/login','LoginController@index')->name('login');
// Route::post('/login', 'LoginController@loginPost')->name('login.store');
// Route::get('/logout', 'HomeController@logout')->name('logout');
Route::get('/change', 'HomeController@edit')->name('password.edit');
Route::post('/change', 'HomeController@update')->name('password.ubah');

Route::get('export','RekapController@index')->name('pdf');
Route::get('export/{id}','RekapController@print')->name('pdf.print');
Route::get('export_kwitansi','RekapController@listdata')->name('pdf.print.kwitansi');
Route::get('export/bulanan/{nama}/{id}','RekapController@rekapBulanan')->name('pdf.print.rekap.bulanan');
Route::post('export/siswa/','RekapController@rekapSiswa')->name('pdf.print.rekap.siswa');
Route::get('export/bulanan/rekap/{nama}/{id}/{filter?}','RekapController@rekapBulanan')->name('pdf.print.rekap.bulanan');
Route::get('export/bulanan/onepage/{nama}/{payment}','RekapController@kwitansiBulanan')->name('pdf.print.bulanan');
Route::get('export/bulanan/detail/{nama}/{payment}','RekapController@kwitansiBulananSatuan')->name('pdf.print.bulanan.detail');
Route::get('export/sesekali/rekap/{nama}/{id}','RekapController@rekapSesekali')->name('pdf.print.rekap.sesekali');
Route::get('export/sesekali/onepage/{nama}/{payment}','RekapController@kwitansiSesekali')->name('pdf.print.sesekali');
Route::get('export/sesekali/detail/{nama}/{payment}','RekapController@kwitansiSesekaliSatuan')->name('pdf.print.sesekali.detail');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

/**
 * Route resource untuk Pembayaran
 */
Route::resource('spp', 'SppController');
