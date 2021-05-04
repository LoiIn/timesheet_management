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

//timesheet & task
Route::prefix('timesheets')->group(function () {
    //timesheet
    Route::get('/', 'TimesheetController@index')->name('timesheets.index');
    Route::get('/create', 'TimesheetController@create')->name('timesheets.create');
    Route::post('/create', 'TimesheetController@store')->name('timesheets.store');
    Route::get('/{id}/edit', 'TimesheetController@edit')->name('timesheets.edit');
    Route::post('/{id}/edit', 'TimesheetController@update')->name('timesheets.update');
    Route::delete('/{id}/delete', 'TimesheetController@destroy')->name('timesheets.destroy');

    // task
    Route::get('/{ts_id}/tasks/create', 'TaskController@create')->name('tasks.create');
    Route::post('/{ts_id}/tasks/create', 'TaskController@store')->name('tasks.store');
    Route::get('/{ts_id}/tasks/{id}/edit', 'TaskController@edit')->name('tasks.edit');
    Route::post('/{ts_id}/tasks/{id}/edit', 'TaskController@update')->name('tasks.update');
    Route::delete('/{ts_id}/tasks/{id}/delete', 'TaskController@destroy')->name('tasks.destroy');
});