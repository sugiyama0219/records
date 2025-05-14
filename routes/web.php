<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RecordsController;
//use App\Http\Controllers\Admin\AdminController;

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

//実績記録表のルート設定
Route::get('/records', 'App\Http\Controllers\RecordsController@show_current_month')->name('record.show_current')->middleware('auth');
Route::get('/records/{year_month}', 'App\Http\Controllers\RecordsController@show_other_month')->name('record.show_other')->middleware('auth');
Route::get('/records/edit/{year_month}/{day}', 'App\Http\Controllers\RecordsController@edit')->name('record.edit')->middleware('auth');
Route::post('/records/update/{year_month}', 'App\Http\Controllers\RecordsController@update')->name('record.update')->middleware('auth');

Route::get('/', function () {
    return redirect('/records');
});

//ユーザ認証のルート設定
Auth::routes();
Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home');
Route::post('/login', 'App\Http\Controllers\Auth\LoginController@login')->name('login');

//管理者画面のルート設定

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('login', 'App\Http\Controllers\Admin\Auth\LoginController@showLoginForm')->name('login');
    Route::post('login', 'App\Http\Controllers\Admin\Auth\LoginController@login')->name('login');
    Route::post('logout', 'App\Http\Controllers\Admin\Auth\LoginController@logout')->name('logout');

    Route::middleware('auth:admin')->group(function () {
        Route::get('dashboard', function () {
            return view('admin.dashboard');
        })->name('dashboard');
        
        Route::get('users/register', function () {
            return view('admin.register_users');
        })->name('users.register');
        
        Route::get('users/register/complete', function () {
            return view('admin.register_comp');
        })->name('users.register.comp');
        
        Route::post('users/register', 'App\Http\Controllers\AdminController@store')->name('users.store');
    });
});


//新規登録のルート設定
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('register', '\App\Http\Controllers\Admin\Auth\RegisterController@showRegistrationForm')->name('register');
    Route::post('register', '\App\Http\Controllers\Admin\Auth\RegisterController@register')->name('register');
});
