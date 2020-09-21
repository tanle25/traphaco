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

Route::get('admin', 'HomeController@adminHome')
    ->name('admin.home');
Auth::routes();

Route::get('', 'HomeController@index')
    ->name('home');

Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    Route::get('/department', 'DepartmentController@index')
        ->name('admin.department.index')
        ->middleware('permission:xem phòng ban');
    Route::post('/department/store', 'DepartmentController@store')
        ->name('admin.department.store')
        ->middleware('permission:thêm phòng ban');
    Route::get('/department/edit/{id}', 'DepartmentController@edit')
        ->name('admin.department.edit')
        ->middleware('permission:sửa phòng ban');
    Route::post('/department/update/{id}', 'DepartmentController@update')
        ->name('admin.department.update')
        ->middleware('permission:sửa phòng ban');
    Route::post('/department/destroy', 'DepartmentController@destroy')
        ->name('admin.department.destroy')
        ->middleware('permission:xóa phòng ban');
    Route::post('/department/savetree', 'DepartmentController@saveTree')
        ->name('admin.department.savetree');

    Route::post('/user-position/store', 'UserPositionController@store')
        ->name('admin.user_position.store');
    Route::post('/user-position/update', 'UserPositionController@update')
        ->name('admin.user_position.update');
    Route::post('/user-position/destroy', 'UserPositionController@destroy')
        ->name('admin.user_position.destroy');

    //user manager
    Route::get('/usermanage', 'UserManageController@index')
        ->name('admin.usermanage.index')
        ->middleware('permission:xem user');
    Route::get('/usermanage/create', 'UserManageController@create')
        ->name('admin.usermanage.create')
        ->middleware('permission:thêm user');
    Route::post('/usermanage/store', 'UserManageController@store')
        ->name('admin.usermanage.store')
        ->middleware('permission:thêm user');
    Route::get('/usermanage/edit/{id}', 'UserManageController@edit')
        ->name('admin.usermanage.edit')
        ->middleware('permission:sửa user');
    Route::post('/usermanage/update/{id}', 'UserManageController@update')
        ->name('admin.usermanage.update')
        ->middleware('permission:sửa user');
    Route::get('/usermanage/destroy/{id}', 'UserManageController@destroy')
        ->name('admin.usermanage.destroy')
        ->middleware('permission:xóa user');
    Route::get('/usermanage/list-user', 'UserManageController@listUser')
        ->name('admin.usermanage.list_user')
        ->middleware('permission:xem user');
    Route::get('/usermanage/import', 'UserManageController@importExcel')
        ->name('admin.usermanage.import')
        ->middleware('permission:thêm user');

    //permission
    Route::get('/permission', 'PermissionController@index')
        ->name('admin.permission.index')
        ->middleware('permission:quản_lý quyền');
    Route::post('/permission/srote', 'PermissionController@store')
        ->name('admin.permission.store')
        ->middleware('permission:quản_lý quyền');
    Route::get('/permission/edit/{id}', 'PermissionController@edit')
        ->name('admin.permission.edit')
        ->middleware('permission:quản_lý quyền');
    Route::post('/permission/update/{id}', 'PermissionController@update')
        ->name('admin.permission.update')
        ->middleware('permission:quản_lý quyền');
    Route::post('/permission/destroy/{id}', 'PermissionController@destroy')
        ->name('admin.permission.destroy')
        ->middleware('permission:quản_lý quyền');

    Route::get('/survey', 'SurveyController@index')
        ->name('admin.survey.index')
        ->middleware('permission:xem bộ đề');
    Route::get('/survey/create', 'SurveyController@create')
        ->name('admin.survey.create')
        ->middleware('permission:thêm bộ đề');
    Route::post('/survey/store', 'SurveyController@store')
        ->name('admin.survey.store')
        ->middleware('permission:thêm bộ đề');
    Route::get('/survey/edit/{id}', 'SurveyController@edit')
        ->name('admin.survey.edit')
        ->middleware('permission:xem bộ đề');
    Route::post('/survey/update/{id}', 'SurveyController@update')
        ->name('admin.survey.update')
        ->middleware('permission:sửa bộ đề');
    Route::post('/survey/destroy/{id}', 'SurveyController@destroy')
        ->name('admin.survey.destroy')
        ->middleware('permission:xóa bộ đề');
    Route::get('/survey/list', 'SurveyController@listSurvey')
        ->name('admin.survey.list_survey')
        ->middleware('permission:xem bộ đề');

    Route::get('/survey-section', 'SurveySectionController@index')
        ->name('admin.survey_section.index')
        ->middleware('permission:sửa bộ đề');
    Route::post('/survey-section/store', 'SurveySectionController@store')
        ->name('admin.survey_section.store')
        ->middleware('permission:sửa bộ đề');
    Route::post('/survey-section/update', 'SurveySectionController@update')
        ->name('admin.survey_section.update')
        ->middleware('permission:sửa bộ đề');
    Route::post('/survey-section/destroy', 'SurveySectionController@destroy')
        ->name('admin.survey_section.destroy')
        ->middleware('permission:sửa bộ đề');

    Route::get('/question', 'QuestionController@index')
        ->name('admin.question.index')
        ->middleware('permission:sửa bộ đề');
    Route::post('/question/store', 'QuestionController@store')
        ->name('admin.question.store')
        ->middleware('permission:sửa bộ đề');
    Route::post('/question/update', 'QuestionController@update')
        ->name('admin.question.update')
        ->middleware('permission:sửa bộ đề');
    Route::post('/question/destroy', 'QuestionController@destroy')
        ->name('admin.question.destroy')
        ->middleware('permission:sửa bộ đề');
    Route::post('/question/can-comment', 'QuestionController@canComment')
        ->name('admin.question.can_comment')
        ->middleware('permission:sửa bộ đề');
    Route::post('/question/duplicate', 'QuestionController@duplicateQuestion')
        ->name('admin.question.duplicate')
        ->middleware('permission:sửa bộ đề');
    Route::post('/question/update-order', 'QuestionController@updateQuestionOrder')
        ->name('admin.question.update_order')
        ->middleware('permission:sửa bộ đề');
    Route::post('/question/update-must-mask', 'QuestionController@chageQuestionMustMaskStatus')
        ->name('admin.question.save_question_must_mask')
        ->middleware('permission:sửa bộ đề');
    Route::get('/question-option', 'QuestionOptionController@index')
        ->name('admin.question_option.index')
        ->middleware('permission:sửa bộ đề');
    Route::post('/question-option/store', 'QuestionOptionController@store')
        ->name('admin.question_option.store')
        ->middleware('permission:sửa bộ đề');
    Route::post('/question-option/update', 'QuestionOptionController@update')
        ->name('admin.question_option.update')
        ->middleware('permission:sửa bộ đề');
    Route::post('/question-option/destroy', 'QuestionOptionController@destroy')
        ->name('admin.question_option.destroy')
        ->middleware('permission:sửa bộ đề');
    Route::post('/question-option/update-order', 'QuestionOptionController@updateOptionOrder')
        ->name('admin.question_option.update_order')
        ->middleware('permission:sửa bộ đề');

    Route::get('/test/index', 'TestController@index')
        ->name('admin.test.index');
    Route::get('/test/create', 'TestController@create')
        ->name('admin.test.create');
    Route::post('/test/store', 'TestController@storeTestType1')
        ->name('admin.test.store')
        ->middleware('permission:thêm bài đánh giá');
    Route::post('/test/store2', 'TestController@storeTestType2')
        ->name('admin.test.store2')
        ->middleware('permission:thêm bài đánh giá');

    Route::get('/test/show', 'TestController@show')
        ->name('admin.test.show');
    Route::post('/test/update/{id}', 'TestController@update')
        ->name('admin.test.update')
        ->middleware('permission:sửa bài đánh giá');
    Route::get('/test/get-list', 'TestController@getList')
        ->name('admin.test.get_list');
    Route::get('/test/send-all/{survey_round}', 'TestController@sendSurveyToAllUser')
        ->name('admin.test.send_all')
        ->middleware('permission:gửi bài đánh giá');
    Route::post('/test/send-survey/{id}', 'TestController@sendTest')
        ->name('admin.test.send_survey')
        ->middleware('permission:gửi bài đánh giá');
    Route::post('/test/destroy/{id}', 'TestController@destroy')
        ->name('admin.test.destroy')
        ->middleware('permission:xóa bài đánh giá');

    //survey round
    Route::get('/round-survey', 'RoundSurveyController@index')
        ->name('admin.survey_round.index')
        ->middleware('permission:xem đợt đánh giá');
    Route::get('/round-survey/create', 'RoundSurveyController@create')
        ->name('admin.survey_round.create')
        ->middleware('permission:thêm đợt đánh giá');
    Route::post('/round-survey/store', 'RoundSurveyController@store')
        ->name('admin.survey_round.store')
        ->middleware('permission:thêm đợt đánh giá');
    Route::get('/round-survey/edit/{id}', 'RoundSurveyController@edit')
        ->name('admin.survey_round.edit')
        ->middleware('permission:sửa đợt đánh giá');
    Route::post('/round-survey/update/{id}', 'RoundSurveyController@update')
        ->name('admin.survey_round.update')
        ->middleware('permission:sửa đợt đánh giá');
    Route::post('/round-survey/destroy/{id}', 'RoundSurveyController@destroy')
        ->name('admin.survey_round.destroy')
        ->middleware('permission:xóa đợt đánh giá');
    Route::get('/round-survey/list-survey-round', 'RoundSurveyController@getList')
        ->name('admin.survey_round.list')
        ->middleware('permission:xem đợt đánh giá');

    Route::get('/round-survey/details/{id}', 'RoundSurveyController@details')
        ->name('admin.survey_round.details')
        ->middleware('permission:xem báo cáo đợt đánh giá');
    Route::get('/round-survey/details/{id}/get-table', 'RoundSurveyController@getSurveyRoundResultTable')
        ->name('admin.survey_round.details_table');
    Route::get('/round-survey/details/{id}/candiate/{candiate_id}/survey/{survey_id}', 'RoundSurveyController@exportUserTestDetails')
        ->name('admin.survey_round.details.export');
    Route::post('/round-survey/time/update', 'RoundSurveyController@updateTime')
        ->name('admin.survey_round.update_time')
        ->middleware('permission:sửa đợt đánh giá');

    Route::get('/test/candiate/get-list', 'TestController@getCandiate')
        ->name('admin.test.get_candiate');
    Route::get('/test/examiner/get-list', 'TestController@getExaminer')
        ->name('admin.test.get_examiner');

    //export excel
    Route::get('user/export', 'UserManageController@export')
        ->name('admin.usermanage.export');
    Route::post('customer/create-survey', 'CustomerController@createTestAndSend')
        ->name('admin.customer.create_and_send_test')
        ->middleware('permission:thêm bài khảo sát khách hàng');
    Route::post('customer/store-answer', 'CustomerController@storeCustomerAnswer')
        ->name('admin.customer.store_customer_answer')
        ->middleware('permission:thêm bài khảo sát khách hàng');
    Route::get('customer-test/remove-all-empty', 'CustomerTestController@removeAllEmpty')
        ->name('admin.customer.remove_all_empty')
        ->middleware('permission:xóa bài khảo sát khách hàng');
    Route::post('/customer/destroy/{id}', 'CustomerController@destroy')
        ->name('admin.customer.destroy')
        ->middleware('permission:xóa khách hàng');
    Route::post('customer/import', 'CustomerController@importExcel')
        ->name('admin.customer.import')
        ->middleware('permission:thêm khách hàng');

    //excel
    Route::get('/customer/tests/details/{survey_id}/export', 'CustomerTestController@exportAll')
        ->name('admin.customer_test.details.export')
        ->middleware('permission:xuất_excel thống kê khách hàng');
    Route::get('/customer/result/{survey_round_id}/survey/{survey_id}/export', 'UserResultController@exportAll')
        ->name('admin.export.user_result')
        ->middleware('permission:xuất_excel báo cáo đợt đánh giá');

    //history
    Route::get('/history', 'HistoryLogController@index')
        ->name('history.index');
    // custonmer history
    Route::get('/history/customer-info/{customer_id}', 'HistoryLogController@customerInfoHistory')
        ->name('history.customer_info_history');
    // user test history
    Route::get('/history/user-test/{test_id}', 'HistoryLogController@getUserTestHistory')
        ->name('history.user_test');
    // user test history
    Route::get('/history/customer-test/{test_id}', 'HistoryLogController@getCustomerTestHistory')
        ->name('history.customer_test');

    // result for admin
    Route::get('/result/details/{survey_round_id}', 'UserResultController@show')
        ->name('admin.user_result.show');
    Route::get('/result/details/{survey_round_id}/survey/{survey_id}', 'UserResultController@showResultBySurvey')
        ->name('admin.user_result.show_result_by_survey');

});

Route::group(['prefix' => '/', 'middleware' => ['auth']], function () {

    Route::get('answer/mark/{test_id}', 'Admin\AnswerController@showTest')
        ->name('answer.mark');
    Route::post('answer/store', 'Admin\AnswerController@store')
        ->name('answer.store');
    Route::get('answer/list-test', 'Admin\AnswerController@listTest')
        ->name('answer.list_test');
    Route::get('answer/{id}/edit', 'Admin\AnswerController@edit')
        ->name('answer.re_ans');
    Route::post('answer/update', 'Admin\AnswerController@update')
        ->name('answer.update_ans')
        ->middleware('permission:sửa bài đánh giá đã làm');
    Route::get('answer/list', 'Admin\AnswerController@index')
        ->name('answer.index');

    Route::get('/result/index', 'ResultController@index')
        ->name('result.index');
    Route::get('/result/list-test', 'ResultController@listResult')
        ->name('result.list_test');

    Route::get('customer/index', 'Admin\CustomerController@index')
        ->name('admin.customer.index')
        ->middleware('permission:xem khách hàng');
    Route::post('customer/create-survey', 'Admin\CustomerController@createTestAndSend')
        ->name('admin.customer.create_and_send_test')
        ->middleware('permission:thêm bài khảo sát khách hàng');
    Route::post('customer/store-answer', 'Admin\CustomerController@storeCustomerAnswer')
        ->name('admin.customer.store_customer_answer');
    Route::get('customer/list', 'Admin\CustomerController@list')
        ->name('admin.customer.list')
        ->middleware('permission:xem khách hàng');
    Route::post('customer/store', 'Admin\CustomerController@store')
        ->name('admin.customer.store')
        ->middleware('permission:thêm khách hàng');
    Route::post('customer/update', 'Admin\CustomerController@update')
        ->name('admin.customer.update')
        ->middleware('permission:sửa khách hàng');

    Route::get('/customer/edit/{id}', 'Admin\CustomerController@edit')
        ->name('admin.customer.edit')
        ->middleware('permission:sửa khách hàng');
    Route::get('/customer/edit-field/{id}', 'Admin\CustomerController@editCustomerField')
        ->name('admin.customer.edit_field')
        ->middleware('permission:sửa khách hàng');

    //customer test
    Route::get('/customer/tests/{id}/details', 'Admin\CustomerTestController@getTestDetails')
        ->name('admin.customer_test.details')
        ->middleware('permission:xem bài khảo sát khách hàng');

    Route::post('/customer/tests/{id}/update', 'Admin\CustomerTestController@update')
        ->name('admin.customer_test.update')
        ->middleware('permission:sửa bài khảo sát khách hàng');

    Route::get('/customer/{customer_id}/tests', 'Admin\CustomerTestController@getTestsByCustomer')
        ->name('admin.customer_test.get_test_by_customer');
    Route::get('/customer/get-result-by-survey/{survey_id}', 'Admin\CustomerTestController@getTestsBySurvey')
        ->name('admin.customer_test.get_result_by_survey')
        ->middleware('permission:xem thống kê khách hàng');

    Route::get('/customer/tests/index', 'Admin\CustomerTestController@index')
        ->name('admin.customer_test.index')
        ->middleware('permission:xem thống kê khách hàng');
    Route::get('/customer/tests/list-test', 'Admin\CustomerTestController@listTest')
        ->name('admin.customer_test.list_test');

    Route::post('/customer/tests/delete/{id}', 'Admin\CustomerTestController@destroy')
        ->name('admin.customer_test.destroy');

    // normal user edit
    Route::get('/user/edit', 'Admin\UserManageController@editNormalUser')
        ->name('user.edit_normal_user');
    Route::post('/user/update/{id}', 'Admin\UserManageController@updateNormalUser')
        ->name('user.update_normal_user');

    // Result
    Route::get('/round-survey/details/{id}/candiate/{candiate_id}', 'Admin\RoundSurveyController@getUserDetails')
        ->name('admin.survey_round.candiate_details');

    Route::get('/statistic/index', 'Admin\StatisticController@showForm')->name('statistic.assessment.show_form')->middleware('permission:xem báo cáo đợt đánh giá');
    Route::get('/statistic/assessment-user/export', 'Admin\StatisticController@exportExcelAssessmentResult')->name('statistic.assessment.export')->middleware('permission:xuất_excel báo cáo đợt đánh giá');

});