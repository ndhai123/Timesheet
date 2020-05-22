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

Route::get('/', 'LoginController@index') -> name('index');
Route::get('/login', 'LoginController@login') -> name('login');
Route::post('/login/checkLogin', 'LoginController@checkLogin') -> name('checkLogin');
Route::get('/home', 'HomeController@index') -> name('index');
Route::get('/calendar', 'CalendarController@index') -> name('index');
Route::get('/monthlyTimesheet', 'TimesheetController@index') -> name('index');
Route::get('/monthlyList{year}/{month}', 'TimesheetController@monthlyList') -> name('monthlyList');
Route::get('/dateDetailEdit{date}', 'TimesheetController@dateDetailEdit') -> name('dateDetailEdit');
Route::get('/newLeave', 'DayOffController@getNewLeave') -> name('newLeave');

Route::post('/getshowLeave', 'DayOffController@postCountLeave')->name('postCountLeave');
Route::post('/getCountDay', 'DayOffController@postCountDay')->name('postCountDay');
Route::post('/newLeave', 'DayOffController@postLeave')->name('post-leave');
Route::post('/dateDetailEditSave', 'TimesheetController@dateDetailEditSave') -> name('dateDetailEditSave');

Route::prefix('admin')->middleware('auth')->group(function () {

    Route::get('/', 'AdminController@index')->name('index');
    Route::post('/checkLogin', 'AdminController@checkLogin')->name('checkLogin');
    Route::get('/modifyRequest', 'AdminController@modifyRequest')->name('modifyRequest');
    Route::get('/detailApprove/{date}/{userMail}', 'AdminController@detailApprove')->name('detailApprove');
    Route::get('/approveRequest/{date}/{userMail}', 'AdminController@approve')->name('approve');
    Route::get('/rejectRequest/{date}/{userMail}', 'AdminController@reject')->name('reject');
    Route::get('/payslipMonth', 'AdminController@payslipMonth')->name('payslipMonth');
    Route::get('/checkinCheckout', 'CheckinCheckoutController@getcheckinCheckout');
    Route::get('/dayOff', 'DayOffController@getDayOff')->name('dayOff');
    Route::get('/dayOff-edit/{id}', 'DayOffController@getEdit')->name('dayOff-edit');
    Route::get('/dayOff-delete/{id}', 'DayOffController@getDelete')->name('dayOff-delete');
    Route::post('/outputTimesheet', 'AdminController@outputExel')->name('outputExel');


    Route::post('/getListMonthPayslip', 'AdminController@getListMonthPayslip')->name('getListMonthPayslip');
    Route::post('/dayOff-edit/{id}', 'DayOffController@postEdit')->name('post-edit');

    Route::post('/checkin', 'CheckinCheckoutController@postcheckin' )->name('checkin');
    Route::post('/checkout', 'CheckinCheckoutController@postcheckout')->name('checkout');

    Route::get('/listUser', 'AdminController@getListUser')->name('getListUser');
    Route::get('/deleteUser{user}', 'AdminController@deleteUser')->name('deleteUser');
    Route::get('/toAddUser', 'AdminController@AddUser')->name('AddUser');
    Route::get('/toAddUser', function () { return view('admin/addUser'); })->name('addUser');
    Route::post('/addUser', 'AdminController@AddUser')->name('AddUser');




});


