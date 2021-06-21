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


Route::view('/', 'home')->name('home');
Route::get('test', function () {
    \Illuminate\Support\Facades\Auth::loginUsingId(1);
});
Route::middleware(\App\Http\Middleware\LoginRoute::class)->group(function () {
    Route::prefix('register')->group(function () {
        Route::view('/', 'auth.register')->name('register');
        Route::post('/', [\App\Http\Controllers\AuthController::class, 'register']);
    });
    Route::prefix('login')->group(function () {
        Route::view('/', 'auth.login')->name('login');
        Route::post('/', [\App\Http\Controllers\AuthController::class, 'login']);
    });
    Route::get('logout', [\App\Http\Controllers\AuthController::class, 'logout'])->name('logout');

    Route::view('profile', 'user.profile')->name('profile');
    Route::post('profile-edit', function (\App\Http\Requests\EditProfile $editProfile) {
        $data = $editProfile->only(['name', 'email', 'role']);
        if ($editProfile->password) $data['password'] = $editProfile->password;
        \Illuminate\Support\Facades\Auth::user()->update($data);
        return back();
    })->name('profile-edit');

    Route::prefix('application')->group(function (){
        Route::view('/','user.applications')->name('application');
        Route::post('add',[\App\Http\Controllers\ApplicationController::class, 'addApplication'])->name('application.add');
        Route::get('delete/{application}',[\App\Http\Controllers\ApplicationController::class, 'delete'])->name('application.delete');
    });
    Route::prefix('deal')->group(function () {
        Route::post('deal-save', [\App\Http\Controllers\DealController::class, 'save'])->name('deal.save');
        Route::get('/', [\App\Http\Controllers\DealController::class, 'index'])->name('deal');
        Route::get('/{deal}', [\App\Http\Controllers\DealController::class, 'show'])->name('deal.show');
    });
//    Route::get('deal')->name('deal');


});



//Route::get('/', function () {
//    return view('welcome');
//})->name('profile');
