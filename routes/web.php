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
    Route::get('/facultades/{universidad_id}', [UserProfileController::class, 'getFacultades']);
    Route::get('/carreras/{facultad_id}', [UserProfileController::class, 'getCarreras']);
    Route::put('/profile/usuario/{id}/academic', [UserProfileController::class, 'updateAcademic'])
    ->name('usuario.updateAcademic');
    Route::put('/profile/usuario/{id}/password', [UserProfileController::class, 'changePassword'])
    ->name('usuario.changePassword');
    Route::put('/profile/usuario/{id}/lab', [UserProfileController::class, 'updateLab'])
    ->name('usuario.updateLab');
});
