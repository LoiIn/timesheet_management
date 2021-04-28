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
Route::get('home', 'PageController@home_page')->name('home.index');

//user
Route::get('profiles', 'PageController@get_user_profiles')->name('user_profiles');
Route::get('edit_profiles', 'PageController@get_user_edit_profiles')->name('user_edit_profiles');
Route::post('edit_profiles', 'Auth\UpdateController@postUserProfiles')->name('update_user_profiles');

//sign in
Route::get('sign_in', 'Auth\LoginController@show_login')->name('login.index');
Route::post('sign_in', 'Auth\LoginController@do_login')->name('login');

//sign up
Route::get('sign_up', 'Auth\RegisterController@show_register')->name('register.index');
Route::post('sign_up', 'Auth\RegisterController@do_register')->name('register');

//sign out
Route::get('sign_out', 'Auth\LoginController@logout')->name('logout');