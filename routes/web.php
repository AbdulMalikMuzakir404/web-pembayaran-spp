<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\loginController;
use App\Http\Controllers\Auth\registerController;
use App\Http\Controllers\profile\profileController;

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
})->middleware('guest');

Route::get('login', [loginController::class, 'loginForm'])->name('login')->middleware('sudahlogin');
// Route::post('login/action', [loginController::class, 'loginAction'])->name('loginAction');

Route::get('register', [registerController::class, 'registerForm'])->name('register')->middleware('sudahlogin');
// Route::post('register/action', [registerController::class, 'registerAction'])->name('registerAction');

// Route::get('/logout', function() {
//     if(session()->has('user')){
//         session()->pull('user');
//     }

//     return redirect('/login');
// });


Route::get('/home', function () {
    return "home";
})->name('home')->middleware('login');


Auth::routes();

Route::middleware('auth')->group(function () {
    Route::group(['prefix' => 'home'], function () {
        Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
        Route::get('/home/show-profile', [profileController::class, 'showProfile'])->name('showProfile');
        Route::get('/home/change-profile', [profileController::class, 'changeProfile'])->name('changeProfile');
    });
});