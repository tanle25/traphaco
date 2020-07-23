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
    Route::get('/department', 'DepartmentController@index')->name('admin.department.index');
    Route::post('/department/store', 'DepartmentController@store')->name('admin.department.store');
    Route::get('/department/edit/{id}', 'DepartmentController@edit')->name('admin.department.edit');
    Route::post('/department/update/{id}', 'DepartmentController@update')->name('admin.department.update');
    Route::post('/department/destroy', 'DepartmentController@destroy')->name('admin.department.destroy');
    Route::post('/department/savetree', 'DepartmentController@saveTree')->name('admin.department.savetree');

    Route::post('/user-position/store', 'UserPositionController@store')->name('admin.user_position.store');
    Route::post('/user-position/update', 'UserPositionController@update')->name('admin.user_position.update');
    Route::post('/user-position/destroy', 'UserPositionController@destroy')->name('admin.user_position.destroy');

    Route::get('/usermanage', 'UsermanageController@index')->name('admin.usermanage.index');
    Route::get('/usermanage/create', 'UsermanageController@create')->name('admin.usermanage.create');
    Route::post('/usermanage/store', 'UsermanageController@store')->name('admin.usermanage.store');
    Route::get('/usermanage/edit/{id}', 'UsermanageController@edit')->name('admin.usermanage.edit');
    Route::post('/usermanage/update/{id}', 'UsermanageController@update')->name('admin.usermanage.update');
    Route::get('/usermanage/destroy/{id}', 'UsermanageController@destroy')->name('admin.usermanage.destroy');
    Route::get('/usermanage/list-user', 'UsermanageController@listUser')->name('admin.usermanage.list_user');

});