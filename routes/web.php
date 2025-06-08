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

// Route::get('/', function () {
//     return view('home');
// });

Route::post('/logout', 'AuthController@logout')->name('logout');
Route::post('/login', 'AuthController@login')->name('login');
Route::post('/login', 'AuthController@login')->name('login');
Route::get('/login', function () {
    return view('auth.login');
});

// Auth::routes();
Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index')->name('home');

Route::post('/vehicle/create', 'VehicleController@create')->name('vehicleCreate');
Route::post('/vehicle/edit', 'VehicleController@edit')->name('vehicleEdit');
Route::post('/vehicle/renew/tax', 'VehicleController@editTax')->name('vehicleRenewTax');
Route::post('/vehicle/renew/stnk', 'VehicleController@editSTNK')->name('vehicleRenewSTNK');
Route::post('/vehicle/delete', 'VehicleController@destroy')->name('vehicleDelete');
Route::get('/vehicle', 'VehicleController@index')->name('vehicle');


Route::group(['middleware' => ['auth','check.admin']], function () {
    Route::post('/user/create', 'UserController@create')->name('userCreate');
    Route::post('/user/edit', 'UserController@edit')->name('userEdit');
    Route::post('/user/edit/password', 'UserController@editPassword')->name('userEditPassword');
    Route::post('/user/delete', 'UserController@destroy')->name('userDelete');
    Route::get('/user', 'UserController@index')->name('user');

    Route::post('/reminder/create', 'ReminderController@create')->name('reminderCreate');
    Route::post('/reminder/edit', 'ReminderController@edit')->name('reminderEdit');
    Route::post('/reminder/delete', 'ReminderController@destroy')->name('reminderDelete');
    Route::get('/reminder', 'ReminderController@index')->name('reminder');

    Route::post('/reminder/receiver_role/create', 'ReminderReceiverRoleController@create')->name('reminderReceiverRoleCreate');
    Route::post('/reminder/receiver_role/edit', 'ReminderReceiverRoleController@edit')->name('reminderReceiverRoleyEdit');
    Route::post('/reminder/receiver_role/delete', 'ReminderReceiverRoleController@destroy')->name('reminderReceiverRoleDelete');
    Route::get('/reminder/receiver_role', 'ReminderReceiverRoleController@index')->name('reminderReceiverRole');

    Route::post('/reminder/history/create', 'ReminderHistoryController@create')->name('reminderHistoryCreate');
    Route::post('/reminder/history/edit', 'ReminderHistory@edit')->name('reminderHistoryEdit');
    Route::post('/reminder/history/delete', 'ReminderHistoryController@destroy')->name('reminderHistoryDelete');
    Route::get('/reminder/history', 'ReminderHistoryController@index')->name('reminderHistory');

    Route::get('/sms', 'BulkSmsController@index')->name('sms');
    Route::post('/sms/manual', 'BulkSmsController@smsManual')->name('smsManual');
   
    Route::get('/sms/history', 'SmsHistoryController@index')->name('smsHistory');

});


Route::get('/sms/tax', 'BulkSmsController@tax')->name('smsTax');
Route::get('/sms/stnk', 'BulkSmsController@stnk')->name('smsSTNK');