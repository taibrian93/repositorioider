<?php
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\NodeController;
use App\Http\Controllers\Admin\LanguageController;
use App\Http\Controllers\Admin\TypeDocumentController;
use App\Http\Controllers\Admin\DepartmentController;
use App\Http\Controllers\Admin\ProvinceController;
use App\Http\Controllers\Admin\DistrictController;
use App\Http\Controllers\Admin\FileController;
use App\Http\Controllers\Admin\PopulationCenterController;
use App\Http\Controllers\Admin\TypeExtensionController;
use App\Http\Controllers\Admin\TypeFormatController;

Route::get('', [HomeController::class, 'index'])->name('home');

Route::resource('roles', RoleController::class)->names('roles');

Route::resource('users', UserController::class)->names('users');

Route::resource('nodes', NodeController::class)->names('nodes');

Route::resource('languages', LanguageController::class)->names('languages');

Route::resource('typeDocuments', TypeDocumentController::class)->names('typeDocuments');

Route::resource('departments', DepartmentController::class)->names('departments');
Route::post('departments/getDepartment', [DepartmentController::class, 'getDepartment'])->name('getDepartment');
Route::post('departments/allDepartment', [DepartmentController::class, 'allDepartment'])->name('allDepartment');

Route::resource('provinces', ProvinceController::class)->names('provinces');
Route::post('provinces/getProvince', [ProvinceController::class, 'getProvince'])->name('getProvince');
Route::post('provinces/getProvinces', [ProvinceController::class, 'getListProvinces'])->name('getListProvinces');
Route::post('provinces/allProvince', [ProvinceController::class, 'allProvince'])->name('allProvince');

Route::resource('districts', DistrictController::class)->names('districts');
Route::post('districts/getDistrict', [DistrictController::class, 'getDistrict'])->name('getDistrict');
Route::post('districts/getDistricts', [DistrictController::class, 'getListDistricts'])->name('getListDistricts');

Route::resource('populationCenters', PopulationCenterController::class)->names('populationCenters');
Route::post('populationCenters/getPopulationCenters', [PopulationCenterController::class, 'getListPopulationCenters'])->name('getListPopulationCenters');

Route::resource('typeFormats', TypeFormatController::class)->names('typeFormats');

Route::resource('typeExtensions', TypeExtensionController::class)->names('typeExtensions');
Route::post('typeExtensions/getTypeExtensions', [TypeExtensionController::class, 'getListTypeExtensions'])->name('getListTypeExtensions');

Route::resource('files', FileController::class)->names('files');

// Route::get('/private/files/{year}/{month}/{file}', function ($year, $month, $file) {
//     $path = storage_path();
//     return $month;
// });

Route::get('/private/files/{year}/{month}/{file}', [FileController::class, 'privateFile'])->name('privateFile');


