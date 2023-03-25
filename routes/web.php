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
    CourseHeaderApprovalController,
    CourseDetailController,
    CourseDetailApprovalController,
    CourseDetailDocumentController,
    CourseDetailDocumentApprovalController,
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
Route::get('/registration', [PageController::class, 'registration']);
Route::post('/registration', [PageController::class, 'store_registration']);
Route::resource('/login', LoginController::class);
Route::get('/logout', [LoginController::class, 'logout']);

// Patient Menu
Route::resource('/list-courses', ListCoursesController::class);
Route::get('/download', [PageController::class, 'download']);

// Storage Link for Production
Route::get('/storage-link', function () {
    Artisan::call('storage:link');
});
Route::get('/migrate-seed', function () { 
    Artisan::call('migrate:fresh --seed');
 });

// Menu must be login first
Route::middleware('authcheck')->group(function() {
    // Learning
    Route::get('/view-course/{id}/{ids}', [ViewCourseController::class, 'index']);

    // Management
    Route::resource('/admin/course-header', CourseHeaderController::class);
    Route::resource('/admin/course-header-approval', CourseHeaderApprovalController::class);
    Route::get('/admin/course-detail/{id}/create', [CourseDetailController::class, 'create']);
    Route::resource('/admin/course-detail', CourseDetailController::class);
    Route::resource('/admin/course-detail-approval', CourseDetailApprovalController::class);
    Route::get('/admin/course-detail-document/{id}/create', [CourseDetailDocumentController::class, 'create']);
    Route::resource('/admin/course-detail-document-approval', CourseDetailDocumentApprovalController::class);
    Route::resource('/admin/course-detail-document', CourseDetailDocumentController::class);

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