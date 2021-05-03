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

//home page
Route::get('/', 'PageController@home')->name('home.index');
Route::get('home', 'PageController@home')->name('home.index');

//sign in - sign out - sign-up
Route::prefix('')->group(function () {
    Route::get('sign-in', 'Auth\LoginController@login')->name('login.index');
    Route::post('sign-in', 'Auth\LoginController@postLogin')->name('login');
    Route::get('sign-out', 'Auth\LoginController@logout')->name('logout');
    Route::get('sign-up', 'Auth\RegisterController@register')->name('register.index');
    Route::post('sign-up', 'Auth\RegisterController@postRegister')->name('register');   
});

//user
Route::prefix('user-profiles')->group(function () {
    Route::get('/', 'UserController@index')->name('user.index');
    Route::get('/edit', 'UserController@edit')->name('user.edit');
    Route::post('/edit', 'UserController@update')->name('user.update');
});

//timesheet
Route::prefix('timesheets')->group(function () {
    Route::get('/', 'TimesheetController@index')->name('timesheets.index');
    Route::get('/create', 'TimesheetController@create')->name('timesheets.create');
    Route::post('/create', 'TimesheetController@store')->name('timesheets.store');
    Route::get('/edit/{id}', 'TimesheetController@edit')->name('timesheets.edit');
    Route::post('/edit/{id}', 'TimesheetController@update')->name('timesheets.update');
    Route::delete('/delete/{id}', 'TimesheetController@destroy')->name('timesheets.destroy');
});

//time sheet
// Route::get('timesheet_list', 'PageController@getTimeSheetList')->name('timesheet_list');
Route::post('task/create', 'TaskController@postTask')->name('add_task');
