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
Route::get('/monthlyTimesheet', 'MonthlyTimesheetController@index') -> name('index');
Route::get('/monthlyList{year}/{month}', 'MonthlyTimesheetController@monthlyList') -> name('monthlyList');
Route::get('/dateDetailEdit{date}', 'MonthlyTimesheetController@dateDetailEdit') -> name('dateDetailEdit');
Route::post('/dateDetailEditSave', 'MonthlyTimesheetController@dateDetailEditSave') -> name('dateDetailEditSave');

