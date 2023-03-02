<?php

use App\Http\Controllers\PageController;
use App\Http\Controllers\Masters\{
    CategoryController,
    LevelController,
    ReligionController,
    RoleController,
};
use App\Http\Controllers\Patient\{
    ListCoursesController,
    ViewCourseController,
};
use App\Http\Controllers\Settings\{
    LoginController,
};
use Illuminate\Support\Facades\Route;

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

// Dashboard
Route::get('/', [PageController::class, 'index']);

// Login or Logout or Registration
Route::resource('/login', LoginController::class);
Route::get('/logout', [LoginController::class, 'logout']);

// Patient Menu
Route::resource('/list-courses', ListCoursesController::class);
Route::get('/view-course/{id}/{ids}', [ViewCourseController::class, 'index']);

// Menu must be login first
Route::middleware('authcheck')->group(function() {
    Route::resource('/master/category', CategoryController::class);
    Route::resource('/master/level', LevelController::class);
    Route::resource('/master/religion', ReligionController::class);
    Route::resource('/master/role', RoleController::class);
});