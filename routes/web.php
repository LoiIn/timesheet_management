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

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/', 'PageController@home_page')->name('home');

//home page
Route::get('home', 'PageController@home')->name('home.index');

//user
Route::get('profiles', 'PageController@getUserProfiles')->name('user_profiles');
Route::get('edit_profiles', 'PageController@getFormEditUserProfiles')->name('user_edit_profiles');
Route::post('edit_profiles', 'Auth\UpdateController@postUserProfiles')->name('update_user_profiles');

//time sheet
Route::get('timesheet_list', 'PageController@getTimeSheetList')->name('timesheet_list');

//sign in
Route::get('sign_in', 'Auth\LoginController@login')->name('login.index');
Route::post('sign_in', 'Auth\LoginController@postLogin')->name('login');

//sign up
Route::get('sign_up', 'Auth\RegisterController@register')->name('register.index');
Route::post('sign_up', 'Auth\RegisterController@postRegister')->name('register');

//sign out
Route::get('sign_out', 'Auth\LoginController@logout')->name('logout');