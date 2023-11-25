<?php

use App\Http\Api\v1\Controllers\CompanyControllers\CompanyCommandController;
use App\Http\Api\v1\Controllers\CompanyControllers\CompanyQueryController;
use App\Http\Api\v1\Controllers\EmployeeControllers\EmployeeCommandController;
use App\Http\Api\v1\Controllers\EmployeeControllers\EmployeeQueryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::get('v1/company', [CompanyQueryController::class, 'indexCompany']);
Route::get('v1/company/{id}', [CompanyQueryController::class, 'viewCompany']);
Route::post('v1/company', [CompanyCommandController::class, 'createCompany']);
Route::put('v1/company/{id}', [CompanyCommandController::class, 'updateCompany'])->name('company.update');
Route::delete('v1/company/{id}', [CompanyCommandController::class, 'deleteCompany']);


Route::get('v1/employee', [EmployeeQueryController::class, 'indexEmployee']);
Route::get('v1/employee/{id}', [EmployeeQueryController::class, 'viewEmployee']);
Route::post('v1/employee', [EmployeeCommandController::class, 'createEmployee']);
Route::put('v1/employee/{id}', [EmployeeCommandController::class, 'updateEmployee']);
Route::delete('v1/employee/{id}', [EmployeeCommandController::class, 'deleteEmployee']);
