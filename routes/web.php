<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SettingController;
use Illuminate\Support\Facades\Route;

Route::get('/', function() {
    return view('index');
})->name('index');

Route::get('/manage_projects', function() {
    return view('Manage.manage-buildings');
})->name('manage_projects');

Route::get('/mail', function() {
    return view('mail');
})->name('mail');

Route::get('/tasks', function() {
    return view('Manage.manage-tasks');
})->name('manage_tasks');

Route::get('/view_building', function() {
    return view('view-building');
})->name('view_building');
