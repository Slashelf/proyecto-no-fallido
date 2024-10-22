<?php

use App\Http\Controllers\FacultadController;
use App\Http\Controllers\CarreraController;
use App\Http\Controllers\UniversidadController;
use App\Http\Controllers\UserProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['register' => false]);

Route::middleware(['auth'])->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::resource('/universidad',UniversidadController::class);
    Route::resource('/facultad',FacultadController::class);
    Route::resource('/carrera',CarreraController::class);
    Route::resource('/usuarios',UniversidadController::class);
    Route::resource('/profile/usuario', UserProfileController::class);
    
});