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


Route::view('/','home')->name('home');

Route::middleware(\App\Http\Middleware\LoginRoute::class)->group(function (){
    Route::prefix('register')->group(function (){
        Route::view('/','auth.register')->name('register');
        Route::post('/',[\App\Http\Controllers\AuthController::class,'register']);
    });
    Route::prefix('login')->group(function (){
        Route::view('/','auth.login')->name('login');
        Route::post('/',[\App\Http\Controllers\AuthController::class,'login']);
    });
    Route::get('logout',[\App\Http\Controllers\AuthController::class,'logout'])->name('logout');

    Route::view('profile','user.profile')->name('profile');
    Route::post('profile-edit',function (\App\Http\Requests\EditProfile $editProfile){
        $data=$editProfile->only(['name','email','role']);
        if ($editProfile->password)$data['password']=$editProfile->password;
        \Illuminate\Support\Facades\Auth::user()->update($data);
        return back();
    })->name('profile-edit');

    Route::prefix('deal')->group(function (){
        Route::get('/',[\App\Http\Controllers\DealController::class,'index'])->name('deal.index');
        Route::get('/{deal}',[\App\Http\Controllers\DealController::class,'show'])->name('deal.show');
    });
//    Route::get('deal')->name('deal');


});



//Route::get('/', function () {
//    return view('welcome');
//})->name('profile');
