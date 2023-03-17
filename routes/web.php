<?php

use App\Http\Controllers\PageController;
use App\Http\Controllers\Masters\{
    CategoryController,
    CityController,
    CountryController,
    DistrictController,
    LevelController,
    ProvinceController,
    ReligionController,
    RoleController,
    WardController,
};
use App\Http\Controllers\Management\{
    CourseHeaderController,
    CourseDetailController,
    CourseDetailDocumentController,
};
use App\Http\Controllers\Patient\{
    ListCoursesController,
    ViewCourseController,
};
use App\Http\Controllers\Settings\{
    LoginController,
    ProviderController,
    UserController,
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

// Menu must be login first
Route::middleware('authcheck')->group(function() {
    // Learning
    Route::get('/view-course/{id}/{ids}', [ViewCourseController::class, 'index']);

    // Management
    Route::resource('/admin/course_header', CourseHeaderController::class);
    Route::get('/admin/course_detail/{id}/create', [CourseDetailController::class, 'create']);
    Route::resource('/admin/course_detail', CourseDetailController::class);
    Route::get('/admin/course_detail_document/{id}/create', [CourseDetailDocumentController::class, 'create']);
    Route::resource('/admin/course_detail_document', CourseDetailDocumentController::class);

    // Master
    Route::resource('/master/category', CategoryController::class);
    Route::resource('/master/city', CityController::class);
    Route::resource('/master/country', CountryController::class);
    Route::resource('/master/district', DistrictController::class);
    Route::resource('/master/level', LevelController::class);
    Route::resource('/master/province', ProvinceController::class);
    Route::resource('/master/religion', ReligionController::class);
    Route::resource('/master/role', RoleController::class);
    Route::resource('/master/ward', WardController::class);

    // Setting
    Route::resource('/setting/provider', ProviderController::class);
    Route::resource('/setting/user', UserController::class);
});