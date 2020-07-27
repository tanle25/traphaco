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

    Route::get('/survey', 'SurveyController@index')->name('admin.survey.index');
    Route::get('/survey/create', 'SurveyController@create')->name('admin.survey.create');
    Route::post('/survey/store', 'SurveyController@store')->name('admin.survey.store');
    Route::get('/survey/edit/{id}', 'SurveyController@edit')->name('admin.survey.edit');
    Route::post('/survey/update/{id}', 'SurveyController@update')->name('admin.survey.update');
    Route::post('/survey/destroy/{id}', 'SurveyController@destroy')->name('admin.survey.destroy');
    Route::get('/survey/list', 'SurveyController@listSurvey')->name('admin.survey.list_survey');

    Route::get('/survey-section', 'SurveySectionController@index')->name('admin.survey_section.index');
    Route::post('/survey-section/store', 'SurveySectionController@store')->name('admin.survey_section.store');
    Route::post('/survey-section/update', 'SurveySectionController@update')->name('admin.survey_section.update');
    Route::post('/survey-section/destroy', 'SurveySectionController@destroy')->name('admin.survey_section.destroy');

    Route::get('/question', 'QuestionController@index')->name('admin.question.index');
    Route::post('/question/store', 'QuestionController@store')->name('admin.question.store');
    Route::post('/question/update', 'QuestionController@update')->name('admin.question.update');
    Route::post('/question/destroy', 'QuestionController@destroy')->name('admin.question.destroy');

    Route::get('/question-option', 'QuestionOptionController@index')->name('admin.question_option.index');
    Route::post('/question-option/store', 'QuestionOptionController@store')->name('admin.question_option.store');
    Route::post('/question-option/update', 'QuestionOptionController@update')->name('admin.question_option.update');
    Route::post('/question-option/destroy', 'QuestionOptionController@destroy')->name('admin.question_option.destroy');

});