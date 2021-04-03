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

//Route::get('/', function () {
//    return view('welcome');
//});
Route::group([
    'namespace' => 'App\Http\Controllers'
], function($router){
    Route::get('/','AuthController@login');
    Route::get('/login','AuthController@login')->name('login');
    Route::post('/login','AuthController@checkLogin')->name('check_login');
    Route::get('/register','AuthController@create')->name('register');
    Route::post('/register','AuthController@store')->name('register_store');
    Route::get('/logout','AuthController@logout')->name('logout');
    Route::get('/home','AuthController@home')->name('home');
    Route::post('/user-details','LicenseController@userDetails')->name('user_details');
    Route::post('/create-license-key','LicenseController@createLicenseKey')->name('license_key');
    Route::get('/active-key','LicenseController@activeKey')->name('active_key');
    Route::post('/active-key','LicenseController@activeKeyStore');
});
