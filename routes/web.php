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

Auth::routes(['verify' => true]);

// Route::get('profile', function () {
//     // Only verified users may enter...
// })->middleware('verified');

Route::get('/home', 'HomeController@index')->name('home');

// users
Route::get('/users', 'UsersController@users')->name('users');

Route::get('/user_create', 'UsersController@user_create')->name('user_create');
Route::post('/add_user', 'UsersController@add_user')->name('add_user');

Route::get('/user_edit/{id}', 'UsersController@user_edit')->name('user_edit');
Route::put('/user_update', 'UsersController@user_update')->name('user_update');

Route::delete('/user_delete/{id}', 'UsersController@user_delete')->name('user_delete');
Route::put('/user_unverify/{id}', 'UsersController@user_unverify')->name('user_unverify');

Route::get('/user_search/{id}', 'UsersController@user_search')->name('user_search');

Route::get('/terms_of_service', 'StaticPagesController@terms_of_service')->name('terms_of_service');
