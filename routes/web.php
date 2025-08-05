<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(array('auth', 'verified'))->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', array(ProfileController::class, 'edit'))->name('profile.edit');
    Route::patch('/profile', array(ProfileController::class, 'update'))->name('profile.update');
    Route::delete('/profile', array(ProfileController::class, 'destroy'))->name('profile.destroy');

    Route::get('/users', array(UserController::class, 'index'))->name('users.index');

    Route::get('/users/{user}', array(UserController::class, 'show'));
    Route::put('/users/{user}', array(UserController::class, 'update'));
    Route::delete('/users/{user}', array(UserController::class, 'destroy'));
    // Add user route

    Route::post('/users', array(UserController::class, 'store'))->name('users.store');

});

require __DIR__.'/auth.php';
