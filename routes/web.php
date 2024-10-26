<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SettingController;
use Illuminate\Support\Facades\Route;

Route::get('/', function() {
    return view('index');
});

Route::get('/manage_projects', function() {
    return view('Manage.manage-buildings');
});

Route::get('/mail', function() {
    return view('mail');
});
