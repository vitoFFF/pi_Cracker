<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/profile', 'App\Http\Controllers\ProfileController@show')->middleware('auth');


// Route::get('/', function () {
//     return view('index');
// });

Route::get('/crack', function () {
    return view('crack');
});
Route::get('/hush', function () {
    return view('md5');
});
Route::get('/wordlist', function () {
    return view('wordlist');
});
Route::get('/search', function () {
    return view('searching');
});