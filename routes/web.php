<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ModeController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\ResultController;
use App\Http\Controllers\SchoolCourseController;
use App\Http\Controllers\SessionController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
//=================================Mode Routes==================================

Route::middleware(['admin'])->group(function () {
    Route::get('modes/', [ModeController::class, 'index'])->name('mode.index');
    Route::get('add-modes/', [ModeController::class, 'create'])->name('mode.create');
    Route::post('store-modes/', [ModeController::class, 'store'])->name('mode.store');
    Route::delete('destroy-modes/{id}', [ModeController::class, 'destroy'])->name('mode.destroy');
});

//===================================Session Routes==============================
Route::middleware(['admin'])->group(function () {
    Route::get('sessions/', [SessionController::class, 'home'])->name('sessions.home');
    Route::get('add-sessions/', [SessionController::class, 'add'])->name('sessions.add');
    Route::post('store-sessions/', [SessionController::class, 'store'])->name('sessions.store');
    Route::get('student-list/{id}', [SessionController::class, 'StudentList'])->name('sessions.list');
    Route::get('student-profile/{id}', [SessionController::class, 'StudentDetails'])->name('sessions.details');
});
//---------------------------------SchoolRoutes-------------------------------
Route::middleware(['admin'])->group(function () {
Route::get('schools/',[SchoolCourseController::class,'SchoolHome'])->name('schools');
Route::get('add-schools/',[SchoolCourseController::class,'AddSchool'])->name('add.schools');
Route::post('store-schools/',[SchoolCourseController::class,'Schoolstore'])->name('store.schools');
Route::get('schools/{id}',[SchoolCourseController::class,'schoolDestroy'])->name('school.destroy');
});
//---------------------------------Course ROUTE -------------------------------

Route::middleware(['admin'])->group(function () {
    Route::get('courses/',[SchoolCourseController::class,'CourseHome'])->name('courses');
    Route::get('courses/{id}',[SchoolCourseController::class,'courseDestroy'])->name('courses.destroy');
    Route::get('add-course/',[SchoolCourseController::class,'AddCourse'])->name('add.courses');Route::post('store-courses/',[SchoolCourseController::class,'Coursestore'])->name('store.courses');
});
//--------------------------------------PUBLIC ROUTES-----------------------------------
Route::get('qrcode/{id}', [PublicController::class, 'qrcode'])->name('public.qrcode');
Route::get('/', [PublicController::class, 'Home'])->name('enrollment');
Route::post('/verify-enrollment', [PublicController::class, 'CheckEnrollment'])->name('enrollment-verify');

//-------------------------------------HOME ROUTES---------------------------

Route::get('/enroll-list', [HomeController::class, 'EnrollmentList'])->name('enroll')->middleware('admin');
Route::get('/result-show/{id}', [HomeController::class, 'ShowResult'])->name('result.list.show')->middleware('admin');
Route::get('/result-list', [HomeController::class, 'ResultList'])->name('result.list')->middleware('admin');
Route::get('/login', [HomeController::class, 'Login'])->name('login');
Route::get('/enroll', [HomeController::class, 'AddEnrollment'])->name('add-enroll')->middleware('admin');
Route::get('/del-student/{id}', [HomeController::class, 'DelStudent'])->name('delStudent')->middleware('admin');
Route::get('/edit-student/{id}', [HomeController::class, 'EditStudent'])->name('editStudent')->middleware('admin');
Route::post('/update-student/{id}', [HomeController::class, 'UpdateStudent'])->name('updateStudent')->middleware('admin');
Route::post('/enrollment', [HomeController::class, 'AddStudent'])->name('enrollDone')->middleware('admin');
Route::post('filter/',[HomeController::class, 'filter'])->name('home.filter')->middleware('admin');;

//---------------------- ADMIN ROUTES --------------------------------------------

Route::middleware(['admin'])->group(function(){
    Route::get('/system', [AdminController::class, 'Home'])->name('system');
    Route::post('/add-admin',[AdminController::class,'AddData'])->name('adminAdd');

    Route::get('/logout', [AdminController::class, 'logout'])->name('logout');
    Route::get('/security/{id}', [AdminController::class, 'DelAdmin'])->name('deladmin');
});
Route::post('/verify', [AdminController::class, 'LoginVerify'])->name('adminVerify');
