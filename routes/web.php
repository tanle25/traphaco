<?php

use Illuminate\Support\Facades\Route;

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

Route::get('admin', 'HomeController@adminHome')->name('admin.home')->middleware('is_admin');
Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => ['auth', 'is_admin']], function () {

    Route::get('/department', 'DepartmentController@index')->name('department.index');
    Route::get('/department/create', 'DepartmentController@create')->name('department.create');
    Route::get('/department/store', 'DepartmentController@store')->name('department.store');
    Route::get('/department/edit', 'DepartmentController@edit')->name('department.edit');
    Route::get('/department/update', 'DepartmentController@update')->name('department.update');
    Route::get('/department/destroy', 'DepartmentController@destroy')->name('department.destroy');

});