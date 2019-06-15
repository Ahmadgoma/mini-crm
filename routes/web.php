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
Auth::routes();

// disable register route
Route::match(['get', 'post'], 'register', function () {
    return redirect('/admin');
});


Route::group(['prefix' => 'admin', 'middleware' => 'auth', 'namespace' => 'Dashboard'], function () {
    Route::get('/', 'AdminController@index');
    // Routing employees
    Route::resource('employees', 'EmployeesController', [
        'except' => ['show']
    ]);
    // Routing companies
    Route::resource('companies', 'CompaniesController', [
        'except' => ['show']
    ]);

});
