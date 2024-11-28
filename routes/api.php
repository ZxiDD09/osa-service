<?php

use App\Http\Controllers\AdmissionController;
use App\Http\Controllers\AnalyticsController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CandidateController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\InformationController;
use App\Http\Controllers\SchoolYearController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\UserController;
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
    'prefix' => 'students',
    'middleware' => 'auth:api',
], function () {
    Route::post('information', [InformationController::class, 'store'])->withoutMiddleware('auth:api');
    Route::post('candidates', [CandidateController::class, 'store'])->withoutMiddleware('auth:api');
    Route::post('admissions', [AdmissionController::class, 'store']);
    Route::put('admissions/{admission}', [AdmissionController::class, 'update']);
    Route::get('admissions', [AdmissionController::class, 'admissionList']);
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
    Route::resource('admissions', AdmissionController::class);
    Route::resource('staffs', StaffController::class);
    Route::resource('users', UserController::class);

    Route::group(['prefix' => 'analytics'], function () {
        Route::get('courses-overview', [AnalyticsController::class, 'coursesOverview']);
        Route::get('annual-incomes', [AnalyticsController::class, 'annualIncomes']);
        Route::get('passed-vs-failed', [AnalyticsController::class, 'passedVsFailed']);
        Route::get('tuition-financial-sources', [AnalyticsController::class, 'tuitionFinancialSources']);
        Route::get('highschool-strands', [AnalyticsController::class, 'highschoolStrands']);
        Route::get('candidate-gadgets', [AnalyticsController::class, 'candidateGadgets']);
        Route::get('candidate-groups', [AnalyticsController::class, 'candidateGroups']);
        Route::get('sources-of-incomes', [AnalyticsController::class, 'sourcesOfIncomes']);
        Route::get('admission-vs-candidates', [AnalyticsController::class, 'admissionVsCandidates']);
        Route::get('summary', [AnalyticsController::class, 'summary']);
    });
});
