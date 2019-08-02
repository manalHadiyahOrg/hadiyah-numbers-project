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
Route::group(['middleware' => 'disablepreventback'],function()
{   Auth::routes();
 // هند
    Route::get('/GUISupervisor','GUISupervisorController@index')->name('superviser.dashboard');
    Route::get('/GUIObserver','GUIObserverController@index')->name('observer.dashboard');
    Route::get('/GUIAdmin','GUIAdminController@index')->name('admin.dashboard');
    Route::get('/GUIit', 'itController@index')->name('it.dashboard');
    Route::post('/signin', 'Auth\EmployeeLoginController@login')->name('employee.login.submit');
    Route::get('/logout', 'Auth\EmployeeLoginController@logout')->name('employee.logout');
    Route::get('/', 'homeController@index');
    // طيف
    Route::post('/edit','EditController@show')->middleware('edit');
    Route::post('update','EditController@update')->middleware('edit');
    Route::post('superviserprogram','EditController@program_sup')->middleware('edit');
    Route::post('getsup','EditController@program_sup')->middleware('edit');
    Route::post('/search','GUIObserverInfoController@searchid')->middleware('edit');
    Route::post('/observerlocation','GUIObserverInfoController@observerlocation');
    Route::post('/searchsup','GUIAdminController@searchid' );
    Route::post('/Observersaction','GUIObserverInfoController@editObserver');
    Route::get('views/GUIObserverInfo','GUIObserverInfoController@index');
    Route::get('/observers','GUIObserverInfoController@index')->middleware('edit');
    Route::resource('/GUIObserverInfo', 'GUIObserverInfoController')->middleware('edit');
    //BASMA forms

   Route::post('/GUIObserverFormsEdit','GUIObserverController@indexform')->middleware('forms');
   Route::post('/updateF','GUIObserverController@updateF')->middleware('forms');
   Route::post('/GUIObserverForm','GUIObserverFormsController@index')->middleware('forms');
   Route::post('/indexlocation','GUIObserverFormsController@indexlocation')->middleware('forms');
   Route::post('/sevedata','GUIObserverFormsController@store')->middleware('forms');
   // basma admin page
   Route::get('/SupervisersInfo', 'GUIAdminController@get_superviser');
   //end
   //Asayel it form to creatacount 13-11-1440
   //Asayel it form to creatacount 13-11-1440
   Route::PATCH('/newAccount','itController@signup');/// انشاء حساب
   Route::post('/show','itController@showInfo'); //عرض بيانات الموظف
   Route::PATCH('/update/{id}','itController@update');/// تحديث
   Route::PATCH('/delete/{id}','itController@deleteUser'); // حذف
   //----Supervisor
   Route::PATCH('/addMaterials','GUISupervisorController@addMaterials'); // اضافة مواد
   Route::PATCH('/add-service-materials','GUISupervisorController@storMaterials'); //  ربط الماده مع الخدمات
   //end Asayel
   //end Asayel

});
//basma  21/7
Route::get('/','homeController@index')->name('login');
Route::get('/GUIProgram/{id}','GUIProgramController@index');
// تعديل ال auth

// Password reset routes
// Route::post('/password/email', 'Auth\AdminForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
// Route::get('/password/reset', 'Auth\AdminForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
// Route::post('/password/reset', 'Auth\AdminResetPasswordController@reset');
 // Route::get('/password/reset/{token}', 'Auth\AdminResetPasswordController@showResetForm')->name('admin.password.reset');


Route::get('/statistics','statistics@index')->name('statistics.dashboard');
Route::get('/statistics/{id}','StatisticalController@create');
Route::get('/GUIStatistics/{id}','StatisticalController@create');
Route::get('/date','StatisticalController@update');



/*session 21/7/2019*/
Route::get('/hadiyah', function (){
    return view('hadiyah');
});

Route::get('/hhh', function () {
  return view('hadiyah');
});
Route::get('/hh', function () {
  return view('testTemplate');
});

Route::get('/GUIadminProgramInfo', function () {
    return view('GUIadminProgramInfo');
});


Route::resource('/Programs', 'ProgramController');
Route::get('/Programs/{programs}','ProgramController@show')->name('program.show');

/*delegation 8/7/2019
* '\insert' is action from gui
*/
// حذف
/*delegation 8/7/2019*/

Route::post('/insert', 'Cnteoller@insert');
/*delegation 8/7/2019*/

/*session 21/7/2019*/
Route::post('/hadiyah','SessionController@Session');
