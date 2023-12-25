<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

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

Route::get('login', 'AuthController@index')->name('login');
Route::post('login','AuthController@login')->name('login');

Route::get('register', 'AuthController@register_view')->name('register');
Route::post('register','AuthController@register')->name('register');

Route::get('home', 'AuthController@home')->name('home');
Route::get('logout', 'AuthController@logout')->name('logout');

Route::post('send-message', 'MessageController@sendMessage')->name('send.message');
Route::get('messages', 'MessageController@showMessages')->name('show.messages');
