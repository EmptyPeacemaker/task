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
Route::get('test/{id?}', function ($id=1) {
    \Illuminate\Support\Facades\Auth::loginUsingId($id);
    return back();
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
        Route::get('/',[\App\Http\Controllers\ApplicationController::class, 'index'])->name('application');
        Route::post('add',[\App\Http\Controllers\ApplicationController::class, 'addApplication'])->name('application.add');
        Route::get('delete/{application}',[\App\Http\Controllers\ApplicationController::class, 'delete'])->name('application.delete');
        Route::prefix('send/{application}')->group(function (){
            Route::get('accept',[\App\Http\Controllers\ApplicationController::class, 'accept'])->name('application.send.accept');
            Route::get('refuse',[\App\Http\Controllers\ApplicationController::class, 'refuse'])->name('application.send.refuse');
            Route::get('select/{user}',[\App\Http\Controllers\ApplicationController::class, 'select'])->name('application.select');
        });
    });
    Route::prefix('deal')->group(function () {
        Route::get('ready/{deal}',[\App\Http\Controllers\DealController::class, 'ready'])->name('deal.ready');
        Route::get('delete/{deal}',[\App\Http\Controllers\DealController::class, 'delete'])->name('deal.delete');
        Route::post('create',[\App\Http\Controllers\DealController::class, 'create'])->name('deal.create');
        Route::get('new-deal',[\App\Http\Controllers\DealController::class, 'newDeal'])->name('deal.add');
        Route::post('deal-save', [\App\Http\Controllers\DealController::class, 'save'])->name('deal.save');
        Route::get('/', [\App\Http\Controllers\DealController::class, 'index'])->name('deal');
        Route::get('/{deal}', [\App\Http\Controllers\DealController::class, 'show'])->name('deal.show');
    });
//    Route::get('deal')->name('deal');


});



//Route::get('/', function () {
//    return view('welcome');
//})->name('profile');
