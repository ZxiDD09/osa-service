<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CandidateController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\InformationController;
use App\Http\Controllers\SchoolYearController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\StudentController;
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
    Route::get('information/search', [InformationController::class, 'search']);

    Route::resource('school-years', SchoolYearController::class);
    Route::resource('departments', DepartmentController::class);
    Route::resource('courses', CourseController::class);
    Route::resource('sections', SectionController::class);
    Route::resource('information', InformationController::class);
    Route::resource('candidates', CandidateController::class);
    Route::resource('students', StudentController::class);
});
