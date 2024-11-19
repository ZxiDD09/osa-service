<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\SchoolYearController;
use App\Http\Controllers\SectionController;
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'auth',
    'controller' => AuthController::class,
], function () {
    Route::post('login', 'login');
    Route::get('check', 'check')->middleware('auth:api');
    Route::get('logout', 'logout')->middleware('auth:api');
});

Route::group([
    'middleware' => 'auth:api',
], function () {
    Route::resource('school-years', SchoolYearController::class);
    Route::resource('departments', DepartmentController::class);
    Route::resource('courses', CourseController::class);
    Route::resource('sections', SectionController::class);
});
