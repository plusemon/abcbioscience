<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;

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

Route::get('clear', function () {
    $exitCode = Artisan::call('config:clear');
    $exitCode = Artisan::call('cache:clear');
    $exitCode = Artisan::call('config:cache');
    $exitCode = Artisan::call('storage:link');
    return 'DONE'; //Return anything
});




/*================================
        Home page routes
==================================*/


Route::get('/', 'FrontendController@index')->name('frontend');
Route::get('about', 'FrontendController@about')->name('about');


Route::get('board/questiones', 'FrontendController@boardquestiones')->name('board.questiones');
Route::get('school/questiones', 'FrontendController@schoolquestiones')->name('school.questiones');
Route::get('college/questiones', 'FrontendController@collegequestiones')->name('college.questiones');

Route::get('lecture/sheet', 'FrontendController@lecturesheet')->name('lecture.sheet');
Route::get('lecture/sheet/detail/{id}', 'FrontendController@lecturesheetdetail')->name('lecture.sheet.detail');

Route::get('ebooks', 'FrontendController@ebook')->name('ebook');


Route::get('mcqexam', 'FrontendController@mcqexam')->name('mcqexam');
Route::get('writtenexam', 'FrontendController@writtenexam')->name('writtenexam');


Route::get('mcqexam/detail/', 'FrontendController@mcqexam_detail')->name('mcqexam.detail');

Route::get('mcqexam/start', 'FrontendController@mcqexam_start')->name('mcqexam.start');
Route::get('mcqexam/question', 'FrontendController@mcqexam_question')->name('mcqexam.question');




Route::get('allbatch', 'FrontendController@allbatch')->name('allbatch');
Route::get('batch/enroll/{id}', 'FrontendController@batchenroll')->name('batch.enroll');

Route::post('student/batch/admission', 'FrontendController@batch_admission')->name('student.batch.admission');



Route::get('blogs', 'FrontendController@blogs')->name('blogs');
Route::get('blog/detail/{id}', 'FrontendController@blogdetail')->name('blog.detail');

Route::get('notices', 'FrontendController@notices')->name('notices');
Route::get('notice/detail/{slug}', 'FrontendController@noticedetail')->name('notice.detail');


Route::get('contact', 'FrontendController@contact')->name('contact');
Route::post('contactstore', 'FrontendController@contactstore')->name('contactstore');






/* =====================================================
                student login and Register routes
   =====================================================*/

Route::group(['namespace' => 'Students'], function () {

    Route::get('student/login', 'LoginController@studentlogin')->name('student.login');
    Route::post('student/login', 'LoginController@studentauthlogin')->name('student.login');
    Route::get('student/register', 'LoginController@studentregister')->name('student.register');
    Route::post('student/register/store', 'LoginController@studentregisterstore')->name('student.register.store');

    Route::get('student/to/admin/dashboard', 'DashboardController@admindasboard')->name('admin.user.dashboard');


    Route::get('student/password/forgot', 'LoginController@studentpasswordforgot')->name('student.password.forgot');
    Route::post('student/password/forgot/send', 'LoginController@studentpasswordforgotsend')->name('student.password.forgot.send');




    Route::get('student/register/otp/{secretkey}', 'LoginController@studenotpverify')->name('student.register.otp');
    Route::post('student/otp/verify', 'LoginController@studentpasswordotpverify')->name('student.otp.verify');



    Route::get('student/password/reset', 'LoginController@studentpasswordreset')->name('student.password.reset');
    Route::post('student/password/reset/update', 'LoginController@studentpasswordupdate')->name('student.password.update');

    Route::get('student/logout', 'LoginController@studentlogout')->name('student.logout');
});

/* =====================================================
                student dashboard routes
   =====================================================*/

Route::group(['namespace' => 'Students', 'middleware' => ['auth', 'student']], function () {
    Route::get('student/dashboard', 'DashboardController@index')->name('student.dashboard');


    /**student exam */
    Route::group(['prefix' => 'student/exam', 'as' => 'student.exam.', 'middleware' => ['auth', 'student']], function () {

        Route::get('mcq/history', 'Exam\McqExamController@history')->name('mcq.history');
        Route::resource('mcq', 'Exam\McqExamController');
        Route::get('ajax/mcq', 'Exam\McqExamController@indexajax')->name('mcq.ajax');

        Route::get('written/history', 'Exam\WrittenExamController@history')->name('written.history');
        Route::resource('written', 'Exam\WrittenExamController');


        Route::get('diagram/history', 'Exam\WrittenExamController@diagramhistory')->name('diagram.history');
    });



    /**student exam */

    Route::get('student/batch/enroll', 'StudentController@batchlist')->name('student.batch.enroll');
    Route::get('student/batch/enroll/detail/{id}', 'StudentController@batch_detail')->name('student.batch.enroll.detail');

    Route::get('student/sheet/available', 'StudentController@studentsheetavailable')->name('student.sheet.available');
    Route::post('student/make/payment/{id}', 'StudentController@makepayment')->name('student.make.payment');
    Route::get('student/payment/history', 'StudentController@paymenthistory')->name('student.payment.history');



    /*    Home work   */


    Route::get('student/homework/pending', 'StudentController@homework_pending')->name('student.homework.pending');
    Route::get('student/homework/history', 'StudentController@homework_history')->name('student.homework.history');
    Route::post('student/homework/submitted', 'StudentController@homework_submitted')->name('student.homework.submitted');




    /*    Attendance */

    Route::get('student/attendance/pending', 'StudentController@attendance_pending')->name('student.attendance.pending');
    Route::get('student/attendance/pending/ajax', 'StudentController@attendance_pending_ajax')->name('student.attendance.pending.ajax');



    Route::get('student/attendance/history', 'StudentController@attendance_history')->name('student.attendance.history');
    Route::post('student/attendance/present', 'StudentController@attendance_present')->name('student.attendance.present');




    Route::get('student/profile', 'ProfileController@index')->name('student.profile');
    Route::get('student/profile/edit', 'ProfileController@edit')->name('student.profile.edit');
    Route::post('student/profile/update', 'ProfileController@update')->name('student.profile.update');



    Route::get('student/setting', 'ProfileController@setting')->name('student.setting');
    Route::post('student/setting/update', 'ProfileController@settingupdate')->name('student.setting.update');


    Route::get('student/personal/information', 'ProfileController@personalinformation')->name('student.personal.information');
    Route::get('student/personal/information/create', 'ProfileController@personalinformationcreate')->name('student.personal.information.create');
    Route::post('student/personal/information/store', 'ProfileController@personalinformationstore')->name('student.personal.information.store');
    Route::get('student/personal/information/edit', 'ProfileController@personalinformationedit')->name('student.personal.information.edit');
    Route::post('student/personal/information/update', 'ProfileController@personalinformationupdate')->name('student.personal.information.update');
});










/* ===================================================
        Backend routes
    ====================================================*/



Auth::routes();


Route::group(['middleware' => ['auth', 'admin']], function () {

    Route::get('/home', 'HomeController@index')->name('home');
    Route::resource('extraexamgroup', 'ExtraExamGroupController');
    Route::resource('extraexam', 'ExtraExamController');
    Route::resource('extraexamdetail', 'ExtraExamDetailController');

    Route::post('extraexamgroupstore', 'ExtraExamGroupController@extraexamgroupstore')->name('extraexamgroupstore');
    Route::post('extraexamgroupupdate/{id}', 'ExtraExamGroupController@extraexamgroupupdate')->name('extraexamgroupupdate');
    Route::get('extraexamgroupdelete/{id}', 'ExtraExamGroupController@extraexamgroupdelete')->name('extraexamgroupdelete');
    Route::post('extra/exam/csv/upload', 'ExtraExamDetailController@importextraexam')->name('extra.exam.csv.upload');
});



Route::group(['namespace' => 'Backend\StudentSetting', 'middleware' => ['auth', 'admin']], function () {

    Route::get('classes/index', 'ClassesController@index')->name('classes.index');
    Route::post('classes/store', 'ClassesController@store')->name('classes.store');
    Route::get('classes/edit/{id}', 'ClassesController@edit')->name('classes.edit');
    Route::get('classes/destroy/{id}', 'ClassesController@destroy')->name('classes.destroy');


    Route::get('sessiones/index', 'SessionesController@index')->name('sessiones.index');
    Route::post('sessiones/store', 'SessionesController@store')->name('sessiones.store');
    Route::get('sessiones/edit/{id}', 'SessionesController@edit')->name('sessiones.edit');
    Route::get('sessiones/destroy/{id}', 'SessionesController@destroy')->name('sessiones.destroy');


    Route::get('batch/index', 'BatchController@index')->name('batch.index');
    Route::post('batch/store', 'BatchController@store')->name('batch.store');
    Route::get('batch/edit/{id}', 'BatchController@edit')->name('batch.edit');
    Route::get('batch/destroy/{id}', 'BatchController@destroy')->name('batch.destroy');


    Route::get('section/index', 'SectionController@index')->name('section.index');
    Route::post('section/store', 'SectionController@store')->name('section.store');
    Route::get('section/edit/{id}', 'SectionController@edit')->name('section.edit');
    Route::get('section/destroy/{id}', 'SectionController@destroy')->name('section.destroy');


    Route::get('batch/schedule/index', 'BatchSettingController@index')->name('batch.schedule.index');
    Route::get('batch/schedule/create', 'BatchSettingController@create')->name('batch.schedule.create');
    Route::post('batch/schedule/store', 'BatchSettingController@store')->name('batch.schedule.store');
    Route::get('batch/schedule/edit/{id}', 'BatchSettingController@edit')->name('batch.schedule.edit');
    Route::post('batch/schedule/update/{id}', 'BatchSettingController@update')->name('batch.schedule.update');
    Route::get('batch/schedule/destroy/{id}', 'BatchSettingController@destroy')->name('batch.schedule.destroy');


    Route::get('batch/setting/schedule/datetime/{id}', 'BatchSettingController@datetimedestroy')->name('batch.setting.schedule.datetime');
});



Route::group(['namespace' => 'Backend\Student', 'middleware' => ['auth', 'admin']], function () {

    Route::get('student/index', 'StudentController@index')->name('student.index');
    Route::get('student/index/ajax', 'StudentController@indexajax')->name('student.index.ajax');


    //for student dashboard

    Route::get('student/user/login/dashboard/{id}', 'StudentController@studentuserdashboard')->name('student.user.login.dashboard');

    Route::get('student/create', 'StudentController@create')->name('student.create');
    Route::post('student/store', 'StudentController@store')->name('student.store');
    Route::get('student/show/{user}', 'StudentController@show')->name('student.show');
    Route::get('student/edit/{user}', 'StudentController@edit')->name('student.edit');
    Route::post('student/update/{user}', 'StudentController@update')->name('student.update');
    Route::get('student/destroy/{user}', 'StudentController@destroy')->name('student.destroy');


    Route::get('student/user/index', 'StudentController@studentuser')->name('student.user.index');
    Route::get('student/user/indexListByAjax', 'StudentController@studentuserajax')->name('student.user.indexListByAjax');



    Route::get('student/user/show/{user}', 'StudentController@user_show')->name('student.user.show');

    Route::get('student/pending', 'StudentController@pendingstudent')->name('student.pending.index');
    Route::get('student/non/enroll/users', 'StudentController@nonenrolleruser')->name('student.non.errol.users');

    Route::get('student/status/active/{id}', 'StudentController@activestudent')->name('student.status.active');


    Route::post('student/data/export', 'StudentController@exportstudents')->name('student.data.export');



    //ajax call
    Route::get('get/batch/setting', 'StudentController@getbatchsetting')->name('get.batch.setting');
    Route::get('get/class/type/by/batch/setting', 'StudentController@getClassTypeByBatchSetting')->name('get_class_type_by_batch_setting');


    Route::get('get/batch/student/sms', 'StudentController@getbatchstudentforsms')->name('getbatchstudentforsms');


    /**Promotion class */
    Route::group(['prefix' => 'student', 'as' => 'admin.'], function () {
        Route::resource('promotion-class', 'PromotionClassController');
        Route::get('promotion/form/page/by/ajax', 'PromotionClassController@promotionFromByAjax')->name('promotionFromByAjax');
        Route::get('promotion-class/create', 'PromotionClassController@create')->name('promotion-class.create');
    });
    /**Absent Student */
    Route::group(['prefix' => 'student', 'as' => 'admin.'], function () {
        Route::resource('absent', 'AbsentController');
        Route::get('absent/destory/{id}', 'AbsentController@destroy')->name('studentAbsentDestory');
    });


    /**Student Add New Batch */
    Route::group(['prefix' => 'student/add', 'as' => 'admin.'], function () {
        Route::resource('new-batch', 'AddNewBatchController');
        //ajax call
        Route::get('get/batch/setting', 'AddNewBatchController@getbatchsetting')->name('get_batch_setting');
    });






    //  for student for

    Route::get('student/folder/session', 'StudentController@studentsession')->name('student.folder.session');
    Route::get('student/folder/class/{session_id}', 'StudentController@studentclass')->name('student.folder.class');

    Route::get('student/folder/batch/{session_id}/{id}', 'StudentController@studentbatch')->name('student.folder.batch');
    Route::get('student/folder/batch/student/list/by/{id}', 'StudentController@studentbatchstudent')->name('student.folder.batch.student');

    //  for student folder






















});


/** get student by keyup method */
Route::group(['as' => 'admin.', 'prefix' => 'admin/get/student', 'namespace' => 'Backend\Student', 'middleware' => ['auth', 'admin']], function () {
    Route::get('by/key/up', 'GetStudentController@getStudentByKeyup')->name('get_student_by_key_up');
    Route::get('get/student/batch/by/student/id', 'GetStudentController@getStudentBatch')->name('getStudentBatch');
    Route::get('get/batch/type/by/student/batch', 'GetStudentController@getStudentBatchType')->name('getStudentBatchType');
});
/** get student by keyup method */


/** Module */
Route::group(['as' => 'admin.', 'prefix' => 'admin/module', 'namespace' => 'Backend\Module', 'middleware' => ['auth', 'admin']], function () {
    Route::resource('module', 'ModuleController');
    Route::get('module/delete/{module}', 'ModuleController@destroy')->name('moduleDestory');
});


/** Fee  */
Route::group(['as' => 'admin.', 'prefix' => 'admin', 'namespace' => 'Backend\Fee', 'middleware' => ['auth', 'admin']], function () {
    Route::resource('fee-category', 'FeeCategoryController');


    Route::get('fee/category/delete/{feeCategory}', 'FeeCategoryController@destroy')->name('feeCategoryDestory');



    /**fee setting amount*/
    Route::resource('fee-amount-setting', 'FeeAmountSettingController');
    Route::get('fee-amount-setting/ajax/index', 'FeeAmountSettingController@ajaxindex')->name('feecat.ajax.index');

    Route::get('fee/amount/setting/delete/{feeAmountSetting}', 'FeeAmountSettingController@destroy')->name('feeAmountSettingDestory');

    /**fee setting */
    Route::resource('fee-setting', 'FeeSettingController');
    Route::get('fee/setting/delete/{feeSetting}', 'FeeSettingController@destroy')->name('feeSettingDestory');

    /**fee Collection */
    Route::resource('fee-collection', 'FeeCollectionController');
    Route::get('student/fee-collection/ajax', 'FeeCollectionController@ajaxindex')->name('student.fee-collection.index.ajax');

    /** Due Student Fee Collection */
    Route::get('student/due/invoice/list', 'FeeCollectionController@dueinvoicelist')->name('student.due.invoice.list');
    Route::post('student/due/invoice/store', 'FeeCollectionController@dueinvoicestore')->name('student.due.invoice.store');

    Route::get('student/payment/pending/list', 'FeeCollectionController@verify_pending')->name('student.payment.pending.list');

    Route::get('student/payment/approved/{id}', 'FeeCollectionController@paymentverify')->name('student.payment.verify');
    Route::get('student/payment/unpaid/{id}', 'FeeCollectionController@paymentunpaid')->name('student.payment.unpaid');


    Route::post('student/fee/collection/export', 'FeeCollectionController@collectionexport')->name('student.collection.export');





    Route::get('get/fee/category/amount/and/others', 'FeeCollectionController@getFeeCategoryAmount')->name('fee_collection_getFeeCategoryAmount');

    Route::get('fee/collection/show/{id}', 'FeeCollectionController@show')->name('feeCollectionShow');
    Route::get('fee/collection/edit/{id}', 'FeeCollectionController@edit')->name('feeCollectionEdit');
    Route::post('fee/collection/update/{id}', 'FeeCollectionController@update')->name('feeCollectionUpdate');
    Route::get('fee/collection/delete/{id}', 'FeeCollectionController@destroy')->name('feeCollectionDestory');

    /**get batch setting id by class, student/user id and session id */
    Route::get('get/batch-id/by/user/class/session/id', 'FeeCollectionController@getBatchSettingIdByClassSessionUserId')->name('getBatchSettingIdByClassSessionUserId');

    /**Monthly Fee due list */
    Route::get('monthly/fee/due/list', 'FeeCollectionController@monthlyFeeDueList')->name('monthlyFeeDueList');
    Route::get('monthly/fee/due/list/search/result', 'FeeCollectionController@monthlyFeeDueListSearchResult')->name('monthlyFeeDueListSearchResult');


    Route::get('others/fee/collection', 'OthersFeeCollectionController@othersFeeCollection')->name('othersFeeCollection');
    Route::get('search/fee/amount/setting/by/some/data', 'OthersFeeCollectionController@searchFeeAmountSettingByOthersData')->name('searchFeeAmountSettingByOthersData');
    Route::get('others/fee/collection/by/student', 'OthersFeeCollectionController@othersFeeCollectionByStudent')->name('othersFeeCollectionByStudent');
    Route::post('store/others/fee/collection/by/student', 'OthersFeeCollectionController@storeOthersFeeCollectionByStudent')->name('storeOthersFeeCollectionByStudent');

    Route::get('others/fee/due/list', 'OthersFeeCollectionController@othersFeeDueList')->name('othersFeeDueList');
    Route::match(['get', 'post'], 'others/payment/fee/due/list', 'OthersFeeCollectionController@othersPaymentFeeDueList')->name('othersPaymentFeeDueList');
});

/** Waiver */
Route::group(['as' => 'admin.', 'prefix' => 'admin', 'namespace' => 'Backend\Waiver', 'middleware' => ['auth', 'admin']], function () {
    Route::resource('waiver-type', 'WaiverTypeController');
    Route::get('waiver-type/delete/{waiverType}', 'WaiverTypeController@destroy')->name('waiverTypeDestory');

    Route::resource('waiver', 'WaiverController');
    Route::get('waiver/delete/{waiver}', 'WaiverController@destroy')->name('waiverDestory');

    /**student Waiver */
    Route::resource('student-waiver', 'StudentWaiverController');
    Route::get('student/waiver/index/ajax', 'StudentWaiverController@ajaxindex')->name('student.waiver.index.ajax');


    Route::get('student-waiver/all/data/by/ajax', 'StudentWaiverController@getWaiverStudentDataByStudentId')->name('getWaiverStudentDataByStudentId');
    Route::get('student/waiver/delete/{studentWaiver}', 'StudentWaiverController@destroy')->name('studentWaiverDestory');
});


Route::group(['prefix' => 'admin/user', 'namespace' => 'Backend\Student', 'middleware' => ['auth', 'admin']], function () {

    Route::get('permission/{user}/edit', 'UserController@change_permission')->name('user.permission.edit'); // idemonbd
    Route::post('permission/{user}/edit', 'UserController@update_permission')->name('user.permission.update'); // idemonbd

    Route::get('index', 'UserController@index')->name('user.index');
    Route::get('create', 'UserController@create')->name('user.create');
    Route::post('store', 'UserController@store')->name('user.store');
    Route::get('show/{id}', 'UserController@show')->name('user.show');
    Route::get('edit/{id}', 'UserController@edit')->name('user.edit');
    Route::post('update/{id}', 'UserController@update')->name('user.update');
    Route::get('destroy/{id}', 'UserController@destroy')->name('user.destroy');

    Route::get('profile', 'ProfileController@index')->name('user.profile');
    Route::get('profile/edit', 'ProfileController@edit')->name('user.profile.edit');
    Route::post('profile/update', 'ProfileController@update')->name('user.profile.update');
    Route::get('setting', 'ProfileController@setting')->name('user.setting');
    Route::post('setting/update', 'ProfileController@changepassword')->name('user.setting.update');
});

Route::group(['prefix' => 'student/user', 'namespace' => 'Backend\Student', 'middleware' => ['auth', 'admin']], function () {
    Route::get('edit/{id}', 'UserController@studentedit')->name('student.user.edit');
    Route::post('update/{id}', 'UserController@studentupdate')->name('student.user.update');
    Route::get('destroy/{id}', 'UserController@studentdestroy')->name('student.user.destory');
});

//about page
Route::group(['prefix' => 'admin/about', 'namespace' => 'Backend\About', 'middleware' => ['auth', 'admin']], function () {
    Route::get("/index", "AboutController@index")->name("admin.about.index");
    Route::get("/show/{id}", "AboutController@show")->name("admin.about.show");
    Route::get("/create", "AboutController@create")->name("admin.about.create");
    Route::get("/edit/{id}", "AboutController@edit")->name("admin.about.edit");
    Route::post("/update/{id}", "AboutController@update")->name("admin.about.update");
    Route::post("/create/post", "AboutController@store")->name("admin.about.store");
    Route::get("/destroy/{id}", "AboutController@destroy")->name("admin.about.destroy");
});


/* Payment Method */
Route::group(['as' => 'admin.', 'prefix' => 'admin/payment', 'namespace' => 'Backend\Payment'], function () {
    Route::resource('paymentMethod', 'PaymentMethodController');
});
/* Account */
Route::group(['as' => 'admin.', 'prefix' => 'admin/payment', 'namespace' => 'Backend\Payment'], function () {
    Route::resource('account', 'AccountController');
    //by ajax
    Route::get('get/account/by/payment/method', 'AccountController@getAccountByPaymentMethod')->name('getAccountByPaymentMethod');
});

/* Bank */ //           //"payment_method_id" => "required|exists:payment_methods,id",
Route::group(['as' => 'admin.', 'prefix' => 'admin', 'namespace' => 'Backend\Payment'], function () {
    Route::resource('bank', 'BankController');
});



Route::group(['prefix' => 'accounts/payment/reports', 'namespace' => 'Backend\Payment'], function () {
    Route::get('paid', 'PaymentReportController@paidreports')->name('payment.reports.paid');
    Route::get('unpaid', 'PaymentReportController@unpaidreports')->name('payment.reports.unpaid');
    Route::get('allreports', 'PaymentReportController@allreports')->name('payment.reports.allreports');
});


/*   ========================
        MCQ question and ans routes
    ==============================*/

/**Mcq Question  */
Route::group(['as' => 'admin.mcq.', 'prefix' => 'mcq', 'namespace' => 'Backend\Question\McqQuestion', 'middleware' => ['auth', 'admin']], function () {
    Route::get('question/list', 'McqQuestionController@index')->name('index');

    Route::get('question/create/new', 'McqQuestionController@createnew')->name('create.new');

    Route::get('question/list/ajax', 'McqQuestionController@ajax_index')->name('ajax.index');

    Route::get('question/create', 'McqQuestionController@create')->name('create');
    Route::post('question/store', 'McqQuestionController@store')->name('store');
    Route::get('question/show/{mcqQuestionSubject}', 'McqQuestionController@show')->name('show');
    Route::get('question/edit/{mcqQuestionSubject}', 'McqQuestionController@edit')->name('edit');
    Route::get('question/edit_new/{mcqQuestionSubject}', 'McqQuestionController@edit_new')->name('edit_new');

    Route::put('question/edit/{mcqQuestion}', 'McqQuestionController@update')->name('update');
    Route::get('question/delete/{mcqQuestion}', 'McqQuestionController@destroy')->name('delete');
    Route::post('question/{McqQuestionSubject}/option/create', 'McqQuestionController@addOption')->name('option.create');

    Route::get('question/destroy/{McqQuestionSubject}', 'McqQuestionController@destroy')->name('destroy');

    Route::get('question/single/delete/{id}', 'McqQuestionController@mcqQuestionDelete')->name('question.delete');

    Route::get('question/image/{mcqQuestion}', 'McqQuestionController@imageDelete')->name('question.image.destroy');

    Route::get('question/exam/{mcqQuestionSubject}', 'McqQuestionController@exam')->name('exam');


    Route::post('question/update/{id}', 'McqQuestionController@updatenew')->name('question.update');
});



// exam/mcq/question
Route::group(['as' => 'admin.exam.question.', 'prefix' => 'exam/mcq/question', 'namespace' => 'Backend\ExamQuestion', 'middleware' => ['auth', 'admin']], function () {
    Route::get('start', 'McqQuestionController@create')->name('create');
    Route::post('store/answer', 'McqQuestionController@store')->name('store');
});

/** Mcq Question Setting */


/** Written Question Setting */
Route::group(['as' => 'admin.', 'prefix' => 'exam/question', 'namespace' => 'Backend\ExamQuestion', 'middleware' => ['auth', 'admin']], function () {
    Route::resource('mcq-setting', 'McqQuestionSettingController');
    Route::get('mcq-setting/delete/{id}', 'McqQuestionSettingController@destroy')->name('mcq-setting.delete');

    Route::resource('written-setting', 'WrittenExamSettingController');
    Route::get('written-setting/destroy/{id}', 'WrittenExamSettingController@destroy')->name('written-setting.destroy');

    Route::resource('mcqoffline-setting', 'McqOfflineExamSettingController');
    Route::get('mcqoffline-setting/destroy/{id}', 'McqOfflineExamSettingController@destroy')->name('mcqoffline-setting.destroy');

    Route::resource('diagramquestion', 'DiagramQuestionController');
    Route::resource('diagram-setting', 'DiagramExamSettingController');
});



/**Student Mcq and Written Question Setting */
Route::group(['as' => 'admin.', 'prefix' => 'exam/question', 'namespace' => 'Backend\ExamQuestion', 'middleware' => ['auth', 'admin']], function () {
    /**MCQ Question student setting */
    Route::get('mcq/student/setting', 'StudentQuestionSettingController@mcqIndex')->name('mcq.question.student.setting.index');
    Route::get('mcq/student/setting/create', 'StudentQuestionSettingController@mcqCreate')->name('mcq.question.student.setting.create');
    Route::get('mcq/student/setting/create/student/list', 'StudentQuestionSettingController@mcqCreateStudentList')->name('mcq.question.student.setting.create.student.list');
    Route::post('mcq/student/setting/store', 'StudentQuestionSettingController@mcqStoreStudent')->name('mcq.question.student.setting.store');
    Route::post('mcq/question/student/permission/store', 'StudentQuestionSettingController@mcqStoreStudentbulk')->name('mcq.question.student.permission.store');
    /**MCQ Question student setting */

    /**Written Question student setting */
    Route::get('written/student/setting', 'StudentQuestionSettingController@writtenIndex')->name('written.question.student.setting.index');
    Route::get('written/student/setting/create', 'StudentQuestionSettingController@writtenCreate')->name('written.question.student.setting.create');
    Route::get('written/student/setting/create/student/list', 'StudentQuestionSettingController@writtenCreateStudentList')->name('written.question.student.setting.create.student.list');
    Route::post('written/student/setting/store', 'StudentQuestionSettingController@writtenStoreStudent')->name('written.question.student.setting.store');

    /**Diagram Question student setting */
    Route::get('diagram/student/setting', 'StudentQuestionSettingController@diagramIndex')->name('diagram.question.student.setting.index');
    Route::get('diagram/student/setting/create', 'StudentQuestionSettingController@diagramCreate')->name('diagram.question.student.setting.create');
    Route::get('diagram/student/setting/create/student/list', 'StudentQuestionSettingController@diagramCreateStudentList')->name('diagram.question.student.setting.create.student.list');
    Route::post('diagram/student/setting/store', 'StudentQuestionSettingController@diagramStoreStudent')->name('diagram.question.student.setting.store');
});
/**Student Mcq and Written Question Setting */




// Exam result Handler routes

/**Student Mcq and Written Question Setting */
Route::group(['as' => 'admin.mcq.exam.', 'prefix' => 'mcq/exam', 'middleware' => ['auth', 'admin']], function () {
    Route::resource('results', 'Backend\ExamResult\McqExamResultController');

    Route::get('results/delete/{id}', 'Backend\ExamResult\McqExamResultController@destroy')->name('result.delete');
});

Route::group(['as' => 'admin.written.exam.', 'prefix' => 'written/exam', 'middleware' => ['auth', 'admin']], function () {
    Route::resource('results', 'Backend\ExamResult\WrittenExamResultController');

    Route::post('mark/entry', 'Backend\ExamResult\WrittenExamResultController@writtenmarkentry')->name('mark.entry');
});


Route::group(['as' => 'admin.diagram.exam.', 'prefix' => 'diagram/exam', 'middleware' => ['auth', 'admin']], function () {
    Route::resource('results', 'Backend\ExamResult\DiagramExamResultController');

    Route::post('mark/entry', 'Backend\ExamResult\DiagramExamResultController@diagrammarkentry')->name('mark.entry');
});


Route::group(['as' => 'admin.offlinemcq.exam.', 'prefix' => 'offlinemcq/exam', 'middleware' => ['auth', 'admin']], function () {
    Route::resource('results', 'Backend\ExamResult\OfflineMcqExamResultController');

    Route::post('mark/entry', 'Backend\ExamResult\OfflineMcqExamResultController@writtenmarkentry')->name('mark.entry');
});





Route::group(['as' => 'admin.result.', 'prefix' => 'result', 'middleware' => ['auth', 'admin']], function () {
    Route::resource('group', 'Backend\ExamResult\ResultGroupController');


    Route::get('get/exam/setting/mcq', 'Backend\ExamResult\ResultGroupController@getmcqexamlist')->name('get.exam.setting.mcq');
    Route::get('get/exam/setting/written', 'Backend\ExamResult\ResultGroupController@getwrittenexamlist')->name('get.exam.setting.written');
    Route::get('get/exam/setting/offlinemcq', 'Backend\ExamResult\ResultGroupController@getofflinemcqexamlist')->name('get.exam.setting.offlinemcq');
});



/* ======== Atendance controller  ===================*/

Route::group(['prefix' => 'student/attendance', 'namespace' => 'Backend\Attendance', 'middleware' => ['auth', 'admin']], function () {

    Route::get('index', 'AttendanceController@index')->name('student.attendance.index');

    Route::get('index/ajax', 'AttendanceController@ajaxindex')->name('student.attendance.index.ajax');



    Route::get('create', 'AttendanceController@create')->name('student.attendance.create');
    Route::post('store', 'AttendanceController@store')->name('student.attendance.store');
    Route::get('show', 'AttendanceController@show')->name('student.attendance.show');
    Route::get('edit/{id}', 'AttendanceController@edit')->name('student.attendance.edit');
    Route::post('update/{id}', 'AttendanceController@update')->name('student.attendance.update');
    Route::get('destroy/{id}', 'AttendanceController@destroy')->name('student.attendance.destroy');

    Route::get('export/{id}', 'AttendanceController@attendanceexport')->name('student.attendance.attendanceexport');
    Route::get('export/present/{id}', 'AttendanceController@attendancepresentexport')->name('student.attendance.attendancepresentexport');
    Route::get('export/absent/{id}', 'AttendanceController@attendanceabsentexport')->name('student.attendance.attendanceabsentexport');




    Route::get('get/attendance/present/student/', 'AttendanceController@getstudentlist')->name('get.attendance.present.student');
    Route::get('get/attendance/absent/student/', 'AttendanceController@getabsentstudentlist')->name('get.attendance.absent.student');
});







/*Home work */

Route::group(['prefix' => 'student/homework', 'namespace' => 'Backend\Homework', 'middleware' => ['auth', 'admin']], function () {


    Route::get('index', 'HomeWorkController@index')->name('student.homework.index');
    Route::get('index/ajax', 'HomeWorkController@ajaxindex')->name('student.homework.index.ajax');
    Route::get('create', 'HomeWorkController@create')->name('student.homework.create');
    Route::post('store', 'HomeWorkController@store')->name('student.homework.store');


    Route::get('edit/{id}', 'HomeWorkController@edit')->name('student.homework.edit');
    Route::post('update/{id}', 'HomeWorkController@update')->name('student.homework.update');
    Route::get('destroy/{id}', 'HomeWorkController@destroy')->name('student.homework.destroy');


    Route::get('get/student/ajax', 'HomeWorkController@studentajax')->name('homework.get.student.ajax');



    Route::get('get/homework/submitted/student/', 'HomeWorkController@getsubmittedstudentlist')->name('get.homework.submitted.student');
    Route::get('get/homework/pending/student/', 'HomeWorkController@getpendingstudentlist')->name('get.homework.pending.student');
});





















Route::group(['namespace' => 'Backend\Website', 'middleware' => ['auth', 'admin']], function () {

    Route::group(['prefix' => 'blog'], function () {
        Route::get('index', 'BlogController@index')->name('blog.index');
        Route::get('create', 'BlogController@create')->name('blog.create');
        Route::post('store', 'BlogController@store')->name('blog.store');
        Route::get('edit/{id}', 'BlogController@edit')->name('blog.edit');
        Route::get('show/{id}', 'BlogController@show')->name('blog.show');
        Route::post('update/{id}', 'BlogController@update')->name('blog.update');
        Route::get('destroy/{id}', 'BlogController@destroy')->name('blog.destroy');
    });


    Route::group(['prefix' => 'slider'], function () {
        Route::get('index', 'SliderController@index')->name('slider.index');
        Route::get('create', 'SliderController@create')->name('slider.create');
        Route::post('store', 'SliderController@store')->name('slider.store');
        Route::get('edit/{id}', 'SliderController@edit')->name('slider.edit');
        Route::get('show/{id}', 'SliderController@show')->name('slider.show');
        Route::post('update/{id}', 'SliderController@update')->name('slider.update');
        Route::get('destroy/{id}', 'SliderController@destroy')->name('slider.destroy');
    });

    Route::group(['prefix' => 'contact'], function () {
        Route::get('index', 'ContactController@index')->name('contact.index');
        Route::get('create', 'ContactController@create')->name('contact.create');
        Route::post('store', 'ContactController@store')->name('contact.store');
        Route::get('edit/{id}', 'ContactController@edit')->name('contact.edit');
        Route::get('show/{id}', 'ContactController@show')->name('contact.show');
        Route::post('update/{id}', 'ContactController@update')->name('contact.update');
        Route::get('destroy/{id}', 'ContactController@destroy')->name('contact.destroy');
    });

    Route::group(['prefix' => 'notice'], function () {
        Route::get('index', 'NoticeController@index')->name('notice.index');
        Route::get('create', 'NoticeController@create')->name('notice.create');
        Route::post('store', 'NoticeController@store')->name('notice.store');
        Route::get('edit/{id}', 'NoticeController@edit')->name('notice.edit');
        Route::get('show/{id}', 'NoticeController@show')->name('notice.show');
        Route::post('update/{id}', 'NoticeController@update')->name('notice.update');
        Route::get('destroy/{id}', 'NoticeController@destroy')->name('notice.destroy');
    });
});


Route::group(['namespace' => 'Backend\Question', 'middleware' => ['auth', 'admin']], function () {

    Route::group(['prefix' => 'admin'], function () {
        Route::resource('ebooks', EbookController::class);
    });

    Route::group(['prefix' => 'old_question'], function () {

        Route::resource('old_question', OldQuestionController::class);

        // Route::get('index', 'OldQuestionController@index')->name('old_question.index');
        // Route::get('create', 'OldQuestionController@create')->name('old_question.create');
        // Route::post('store', 'OldQuestionController@store')->name('old_question.store');
        // Route::get('edit/{id}', 'OldQuestionController@edit')->name('old_question.edit');
        // Route::get('show/{id}', 'OldQuestionController@show')->name('old_question.show');
        // Route::post('update/{id}', 'OldQuestionController@update')->name('old_question.update');
        // Route::get('destroy/{id}', 'OldQuestionController@destroy')->name('old_question.destroy');


        // college question
        Route::get('college/index', 'OldQuestionController@collegeindex')->name('old_question.college.index');
        Route::get('college/create', 'OldQuestionController@collegecreate')->name('old_question.college.create');
        Route::post('college/store', 'OldQuestionController@collegestore')->name('old_question.college.store');
        Route::get('college/edit/{id}', 'OldQuestionController@collegeedit')->name('old_question.college.edit');
        Route::get('college/show/{id}', 'OldQuestionController@collegeshow')->name('old_question.college.show');
        Route::post('college/update/{id}', 'OldQuestionController@collegeupdate')->name('old_question.college.update');
        Route::get('college/destroy/{id}', 'OldQuestionController@collegedestroy')->name('old_question.college.destroy');


        Route::get('boardquestion/index', 'OldQuestionController@boardquestionindex')->name('boardquestion.index');
        Route::get('boardquestion/create', 'OldQuestionController@boardquestioncreate')->name('boardquestion.create');
        Route::post('boardquestion/store', 'OldQuestionController@boardquestionstore')->name('boardquestion.store');
        Route::get('boardquestion/edit/{id}', 'OldQuestionController@boardquestionedit')->name('boardquestion.edit');
        Route::post('boardquestion/update/{id}', 'OldQuestionController@boardquestionupdate')->name('boardquestion.update');
        Route::get('boardquestion/destroy/{id}', 'OldQuestionController@boardquestiondestroy')->name('boardquestion.destroy');
    });



    Route::group(['prefix' => 'year'], function () {
        Route::get('index', 'YearController@index')->name('year.index');
        Route::get('create', 'YearController@create')->name('year.create');
        Route::post('store', 'YearController@store')->name('year.store');
        Route::get('edit/{id}', 'YearController@edit')->name('year.edit');
        Route::get('show/{id}', 'YearController@show')->name('year.show');
        Route::post('update/{id}', 'YearController@update')->name('year.update');
        Route::get('destroy/{id}', 'YearController@destroy')->name('year.destroy');
    });

    Route::group(['prefix' => 'subject'], function () {
        Route::get('index', 'SubjectController@index')->name('subject.index');
        Route::get('create', 'SubjectController@create')->name('subject.create');
        Route::post('store', 'SubjectController@store')->name('subject.store');
        Route::get('edit/{id}', 'SubjectController@edit')->name('subject.edit');
        Route::get('show/{id}', 'SubjectController@show')->name('subject.show');
        Route::post('update/{id}', 'SubjectController@update')->name('subject.update');
        Route::get('destroy/{id}', 'SubjectController@destroy')->name('subject.destroy');
    });


    Route::group(['prefix' => 'old/subject'], function () {
        Route::get('index', 'OldSubjectController@index')->name('old.subject.index');
        Route::get('create', 'OldSubjectController@create')->name('old.subject.create');
        Route::post('store', 'OldSubjectController@store')->name('old.subject.store');
        Route::get('edit/{id}', 'OldSubjectController@edit')->name('old.subject.edit');
        Route::get('show/{id}', 'OldSubjectController@show')->name('old.subject.show');
        Route::post('update/{id}', 'OldSubjectController@update')->name('old.subject.update');
        Route::get('destroy/{id}', 'OldSubjectController@destroy')->name('old.subject.destroy');
    });


    Route::prefix('old_school')->as('old_school.')->group(function () {
        Route::resource('schools', 'OldSchoolController');
        Route::resource('sessions', 'OldSchoolSessionController');
        Route::resource('classes', 'OldSchoolClassController');
        Route::resource('subjects', 'OldSchoolSubjectController');
        Route::resource('questions', 'OldSchoolQuestionController');

        // board questions
        Route::resource('boards', 'OldQuestionBoardController');
        Route::resource('years', 'OldQuestionYearController');
        Route::resource('board_subjects', 'OldQuestionSubjectController');
        Route::resource('board_questions', 'OldBoardQuestionController');
    });


    Route::group(['prefix' => 'chapter'], function () {
        Route::get('index', 'ChapterController@index')->name('chapter.index');
        Route::get('create', 'ChapterController@create')->name('chapter.create');
        Route::post('store', 'ChapterController@store')->name('chapter.store');
        Route::get('edit/{id}', 'ChapterController@edit')->name('chapter.edit');
        Route::get('show/{id}', 'ChapterController@show')->name('chapter.show');
        Route::post('update/{id}', 'ChapterController@update')->name('chapter.update');
        Route::get('destroy/{id}', 'ChapterController@destroy')->name('chapter.destroy');
        Route::get('getchapter', 'ChapterController@getchapter')->name('getchapter');
    });



    Route::group(['prefix' => 'written/question'], function () {
        Route::get('index', 'WrittenQuestionController@index')->name('written.question.index');
        Route::get('create', 'WrittenQuestionController@create')->name('written.question.create');
        Route::post('store', 'WrittenQuestionController@store')->name('written.question.store');
        Route::get('edit/{id}', 'WrittenQuestionController@edit')->name('written.question.edit');
        Route::get('show/{id}', 'WrittenQuestionController@show')->name('written.question.show');
        Route::post('update/{id}', 'WrittenQuestionController@update')->name('written.question.update');
        Route::get('destroy/{id}', 'WrittenQuestionController@destroy')->name('written.question.destroy');
    });


    Route::resource('mcqoffline', McqOfflineQuestionController::class);
});



Route::group(['prefix' => 'website', 'namespace' => 'Backend\Website', 'middleware' => ['auth', 'admin']], function () {
    Route::get('index', 'WebSettingController@index')->name('website.setting.index');
    Route::get('create', 'WebSettingController@create')->name('website.setting.create');
    Route::post('store', 'WebSettingController@store')->name('website.setting.store');
    Route::get('show/{id}', 'WebSettingController@show')->name('website.setting.show');
    Route::get('edit/', 'WebSettingController@edit')->name('website.setting.edit');
    Route::post('update', 'WebSettingController@update')->name('website.setting.update');
    Route::get('destroy/{id}', 'WebSettingController@destroy')->name('website.setting.destroy');
});



Route::group(['prefix' => 'social-media', 'namespace' => 'Backend\Website', 'middleware' => ['auth', 'admin']], function () {
    Route::get('index', 'SocialMediaController@index')->name('social.index');
    Route::get('create', 'SocialMediaController@create')->name('social.create');
    Route::post('store', 'SocialMediaController@store')->name('social.store');
    Route::get('show/{id}', 'SocialMediaController@show')->name('social.show');
    Route::get('edit/{id}', 'SocialMediaController@edit')->name('social.edit');
    Route::post('update/{id}', 'SocialMediaController@update')->name('social.update');
    Route::get('destroy/{id}', 'SocialMediaController@destroy')->name('social.destroy');
});



/*  ================ Sheet Controller ================================= */

Route::group(['prefix' => 'admin/sheet', 'namespace' => 'Backend\Sheet', 'middleware' => ['auth', 'admin']], function () {
    Route::get('index', 'SheetController@index')->name('sheet.index');
    Route::get('index/ajax', 'SheetController@ajax_index')->name('sheet.index.ajax');

    Route::get('create', 'SheetController@create')->name('sheet.create');
    Route::post('store', 'SheetController@store')->name('sheet.store');
    Route::get('edit/{id}', 'SheetController@edit')->name('sheet.edit');
    Route::get('show/{id}', 'SheetController@show')->name('sheet.show');
    Route::post('update/{id}', 'SheetController@update')->name('sheet.update');
    Route::get('destroy/{id}', 'SheetController@destroy')->name('sheet.destroy');
});
Route::group(['as' => 'admin.', 'namespace' => 'Backend\Sheet', 'prefix' => 'sheet', 'middleware' => ['auth', 'admin']], function () {
    Route::get('setting', 'SheetSettingController@index')->name('sheet.setting.index');

    Route::get('setting/ajax', 'SheetSettingController@ajax_index')->name('sheet.setting.index.ajax');


    Route::get('setting/create', 'SheetSettingController@create')->name('sheet.setting.create');
    Route::post('setting/store', 'SheetSettingController@store')->name('sheet.setting.store');
    Route::get('setting/edit/{sheetSetting}', 'SheetSettingController@edit')->name('sheet.setting.edit');
    Route::put('setting/update/{sheetSetting}', 'SheetSettingController@update')->name('sheet.setting.update');
    Route::get('setting/destroy/{sheetSetting}', 'SheetSettingController@destroy')->name('sheet.setting.destroy');
});





Route::group(['as' => 'admin.', 'namespace' => 'Backend\Sheet', 'prefix' => 'sheet', 'middleware' => ['auth', 'admin']], function () {
    Route::get('student/setting', 'StudentSheetSettingController@index')->name('sheet.student.setting.index');
    Route::get('student/setting/create', 'StudentSheetSettingController@create')->name('sheet.student.setting.create');
    Route::get('student/setting/create/student/list', 'StudentSheetSettingController@sheetStudentSettingCreateStudentList')->name('sheetStudentSettingCreateStudentList');
    Route::post('student/setting/store', 'StudentSheetSettingController@store')->name('sheet.student.setting.store');

    Route::post('student/setting/bulk/store', 'StudentSheetSettingController@bulkstore')->name('sheet.student.setting.bulk.store');
});



/* ========================= sms controller  =================================*/

Route::group(['namespace' => 'Backend\SMS', 'middleware' => ['auth', 'admin']], function () {
    Route::get('all/student/sms', 'SmsController@allstudentsms')->name('all.student.sms');
    Route::post('all/student/sms/send', 'SmsController@allstudentsmssend')->name('allstudent.sms.send');

    Route::get('batch/sms', 'SmsController@batchsms')->name('batch.sms');
    Route::post('batch/sms/send', 'SmsController@batchsmssend')->name('batch.sms.send');

    Route::get('single/sms', 'SmsController@singlesms')->name('single.sms');
    Route::post('single/sms/send', 'SmsController@singlesmssend')->name('single.sms.send');

    Route::get('custom/batch/sms', 'SmsController@custombatchsms')->name('custom.batch.sms');
    Route::post('custom/batch/sms/send', 'SmsController@custombatchsmssend')->name('custom.batch.sms.send');

    // Absend students sms
    Route::post('mcq/result/sms', 'SmsController@mcqAllStudentSMS')->name('mcq.result.sms');
    Route::post('written/result/sms', 'SmsController@writtenAllStudentSMS')->name('written.result.sms');
    Route::post('diagram/result/sms', 'SmsController@diagramAllStudentSMS')->name('diagram.result.sms');
    Route::post('offlinemcq/result/sms', 'SmsController@offlinemcqAllStudentSMS')->name('offlinemcq.result.sms');

    // for payment sms

    Route::post('student/due/monthly/payment', 'SmsController@monthly_due_sms')->name('student.due.sms');
});

Route::group(['namespace' => 'Backend\SMS', 'middleware' => ['auth', 'admin']], function () {

    Route::group(['prefix' => 'sms_history'], function () {
        Route::get('index', 'SmsHistoryController@index')->name('sms_history.index');

        Route::get('index/ajax', 'SmsHistoryController@ajaxindex')->name('sms_history.index.ajax');
    });

    Route::group(['prefix' => 'sms_templete'], function () {
        Route::get('index', 'SmsTempleteController@index')->name('sms_templete.index');
        Route::get('create', 'SmsTempleteController@create')->name('sms_templete.create');
        Route::post('store', 'SmsTempleteController@store')->name('sms_templete.store');
        Route::get('edit/{id}', 'SmsTempleteController@edit')->name('sms_templete.edit');
        Route::get('show/{id}', 'SmsTempleteController@show')->name('sms_templete.show');
        Route::post('update/{id}', 'SmsTempleteController@update')->name('sms_templete.update');
        Route::get('destroy/{id}', 'SmsTempleteController@destroy')->name('sms_templete.destroy');
    });
});



Route::get('old-questions', 'FrontendController@old_questions')->name('old.questions');



// bkash api routes
Route::post('token', 'PaymentController@grand_token')->name('token');
Route::post('createpayment', 'PaymentController@createpayment')->name('createpayment');
Route::post('executepayment', 'PaymentController@executepayment')->name('executepayment');