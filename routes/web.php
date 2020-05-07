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
Route::post('/dateDetailEditSave', 'TimesheetController@dateDetailEditSave') -> name('dateDetailEditSave');

Route::prefix('admin')->middleware('auth')->group(function () {

    Route::get('/', 'AdminController@index')->name('index');
    Route::post('/checkLogin', 'AdminController@checkLogin')->name('checkLogin');
    Route::get('/modifyRequest', 'AdminController@modifyRequest')->name('modifyRequest');
    Route::get('/detailApprove/{date}/{userMail}', 'AdminController@detailApprove')->name('detailApprove');
    Route::get('/approveRequest/{date}/{userMail}', 'AdminController@approve')->name('approve');
    Route::get('/rejectRequest/{date}/{userMail}', 'AdminController@reject')->name('reject');

    // Route::name('admin.')->group(function () {

    //     // Route::resource('about', 'AboutController');

    //     Route::resource('tab', 'AboutTabController');

    //     Route::resource('services', 'ServiceController');

    //     Route::resource('team', 'TeamController');

    //     Route::resource('slider', 'SliderController');

    //     Route::resource('setting', 'SettingController');

    //     Route::resource('onsite_offshore', 'OnsiteOffshoreController');

    // });
});


