<?php

use App\Http\Controllers\BuildingController;
use App\Http\Controllers\GeneratePdfController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\ViewBuilding;
use App\Http\Middleware\CheckUserSession;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if(session('user_id')) {
        return view('dashboard');
    }

    return view('index');
})->name('index');

Route::middleware(CheckUserSession::class)->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/manage_projects', [BuildingController::class, 'index'])->name('manage_projects');

    Route::get('/users', function () {
        return view('user');
    })->name('users');

    Route::get('/tasks', function () {
        return view('Manage.manage-tasks');
    })->name('manage_tasks');

    Route::get('/view_building/{id}', [ViewBuilding::class, 'loadBuilding'])->name('view_building');

    Route::get('/generate-report/{id}', [GeneratePdfController::class, 'generatePdf'])->name('generate_report');

    Route::get('/logout', [LogoutController::class, 'index'])->name('logout');
});
