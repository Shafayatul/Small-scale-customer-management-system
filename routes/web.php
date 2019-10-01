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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('customers', 'CustomersController');
Route::get('/customer-invoice/{id}', 'CustomersController@invoiceCreate');
Route::resource('invoices', 'InvoicesController');
Route::get('invoice-email/{id}', 'CustomersController@invoiceEmail');
Route::get('/invoice-pdf-view/{id}', 'InvoicesController@pdfView');
Route::get('/invoice-pdf-download/{id}', 'InvoicesController@pdfDownload');
Route::get('/invoice-edit/{id}', 'InvoicesController@edit');
