<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ErrorTrackingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login'); // Redirect to the login page
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';


Route::get('test', [DashboardController::class, 'test'])->middleware('auth', 'role:admin');
Route::get('user-test', [DashboardController::class, 'test'])->middleware('auth', 'role:user');



Route::middleware('auth', 'verified')->group(function () {
    Route::resource('projects', ProjectController::class);
    Route::resource('users', UserController::class)->middleware('role:admin');
    Route::resource('error_trackings', ErrorTrackingController::class);


    Route::get('/dashboard', [DashboardController::class, 'dashboard'])
        ->middleware(['auth', 'verified'])
        ->name('dashboard');


    // Route::get('/dashboard', function () {
    //     return view('dashboard');
    // })->middleware(['auth', 'verified'])->name('dashboard');


});