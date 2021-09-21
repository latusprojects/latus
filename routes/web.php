<?php

use Illuminate\Support\Facades\Route;
use Latus\Latus\Http\Controllers\AuthController;
use Latus\Latus\Http\Controllers\DashboardController;
use Latus\Latus\Http\Controllers\WebController;
use Latus\Latus\Http\Middleware\VerifyUserCanViewAdminModule;

/*
 * Module: Web
 * Routes for basic functionality
 */
Route::middleware(['web'])->group(function () {

    $webRoutes = function () {
        Route::get('/page/{page_id}', [WebController::class, 'showPage']);
    };

    $webRoutesPrefix = config('latus-routes.web_routes_prefix');
    if ($webRoutesPrefix && $webRoutesPrefix !== '') {
        Route::prefix($webRoutesPrefix)->group($webRoutes);
    } else {
        $webRoutes();
    }
});

/*
 * Module: Admin
 * Routes for basic functionality
 */
Route::middleware(['web', 'auth', VerifyUserCanViewAdminModule::class])->group(function () {

    $adminRoutesPrefix = config('latus-routes.admin_routes_prefix');

    Route::prefix($adminRoutesPrefix)->group(function () {
        Route::get('/dashboard/overview', [DashboardController::class, 'showOverview'])->name('dashboard/overview');
        Route::get('/dashboard/statistics', [DashboardController::class, 'showStatistics'])->name('dashboard/statistics');
        Route::get('', [DashboardController::class, 'showOverview'])->name('admin');
    });
});

/*
 * Module: Auth
 * Routes for basic functionality
 */
Route::middleware(['web'])->group(function () {

    $authRoutesPrefix = config('latus-routes.auth_routes_prefix');

    Route::prefix($authRoutesPrefix)->group(function () {
        Route::get('/login', [AuthController::class, 'showLogin'])->name('auth/login');
        Route::post('/submit', [AuthController::class, 'authenticate'])->name('auth/submit');
        Route::get('/register', [AuthController::class, 'showRegister'])->name('auth/register');
        Route::get('/multiFactorLogin', [AuthController::class, 'showMultiFactorLogin'])->name('auth/factor-login');
    });
});