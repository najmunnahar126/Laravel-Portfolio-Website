<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\VisitorController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\CoursesController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PhotoController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class,'HomeIndex'])->middleware('loginCheck');
Route::get('/visitor', [VisitorController::class,'VisitorIndex'])->middleware('loginCheck');
//Admin Panel Service Management
Route::get('/service', [ServiceController::class,'ServiceIndex'])->middleware('loginCheck');
Route::get('/getServicesData', [ServiceController::class,'getServiceData'])->middleware('loginCheck');
Route::post('/ServiceDelete', [ServiceController::class,'ServiceDelete'])->middleware('loginCheck');
Route::post('/ServiceDetails', [ServiceController::class,'getServiceDetails'])->middleware('loginCheck');
Route::post('/ServiceUpdate', [ServiceController::class,'ServiceUpdate'])->middleware('loginCheck');
Route::post('/ServiceAdd', [ServiceController::class,'ServiceAdd'])->middleware('loginCheck');

//Admin Panel Courses Management
Route::get('/Courses', [CoursesController::class,'CoursesIndex'])->middleware('loginCheck');
Route::get('/getCoursesData', [CoursesController::class,'getCoursesData'])->middleware('loginCheck');
Route::post('/CoursesDelete', [CoursesController::class,'CoursesDelete'])->middleware('loginCheck');
Route::post('/CoursesDetails', [CoursesController::class,'getCoursesDetails'])->middleware('loginCheck');
Route::post('/EachCoursesDetails', [CoursesController::class,'eachCoursesDetails'])->middleware('loginCheck');
Route::post('/CoursesUpdate', [CoursesController::class,'CoursesUpdate'])->middleware('loginCheck');
Route::post('/CoursesAdd', [CoursesController::class,'CoursesAdd'])->middleware('loginCheck');


//Admin Panel Team Management
Route::get('/Team', [TeamController::class,'TeamIndex'])->middleware('loginCheck');
Route::get('/getTeamData', [TeamController::class,'getTeamData'])->middleware('loginCheck');
Route::post('/TeamDelete', [TeamController::class,'TeamDelete'])->middleware('loginCheck');
Route::post('/TeamDetails', [TeamController::class,'getTeamDetails'])->middleware('loginCheck');
Route::post('/TeamUpdate', [TeamController::class,'TeamUpdate'])->middleware('loginCheck');
Route::post('/TeamAdd', [TeamController::class,'TeamAdd'])->middleware('loginCheck');

//Admin Panel Contact Management
Route::get('/contact', [ContactController::class,'ContactIndex'])->middleware('loginCheck');
Route::get('/getContactData', [ContactController::class,'getContactData'])->middleware('loginCheck');
Route::post('/ContactDelete', [ContactController::class,'ContactDelete'])->middleware('loginCheck');

//Admin Panel Review Management
Route::get('/review', [ReviewController::class,'ReviewIndex'])->middleware('loginCheck');
Route::get('/getReviewData', [ReviewController::class,'getReviewData'])->middleware('loginCheck');
Route::post('/ReviewDelete', [ReviewController::class,'ReviewDelete'])->middleware('loginCheck');
Route::post('/ReviewDetails', [ReviewController::class,'getReviewDetails'])->middleware('loginCheck');
Route::post('/ReviewUpdate', [ReviewController::class,'ReviewUpdate'])->middleware('loginCheck');
Route::post('/ReviewAdd', [ReviewController::class,'ReviewAdd'])->middleware('loginCheck');


//Admin Panel Login Management
Route::get('/Login', [LoginController::class,'LoginIndex']);
Route::post('/onLogin', [LoginController::class,'onLogin']);
Route::get('/Logout', [LoginController::class,'onLogout']);


//Admin Panel Image Management
Route::get('/Photo', [PhotoController::class,'PhotoIndex'])->middleware('loginCheck');
Route::post('/PhotoUpload', [PhotoController::class,'PhotoUpload'])->middleware('loginCheck');
Route::get('/PhotoJSON', [PhotoController::class,'PhotoJSON'])->middleware('loginCheck');
Route::get('/PhotoJSONByID/{id}', [PhotoController::class,'PhotoJSONByID'])->middleware('loginCheck');
Route::post('/PhotoDelete', [PhotoController::class,'PhotoDelete'])->middleware('loginCheck');


