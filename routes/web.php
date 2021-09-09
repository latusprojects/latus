<?php

use Illuminate\Support\Facades\Route;
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
Route::middleware(['web', VerifyUserCanViewAdminModule::class])->group(function () {

    $adminRoutesPrefix = config('latus-routes.admin_routes_prefix');

    Route::prefix($adminRoutesPrefix)->group(function () {
        Route::get('/dashboard/overview', [DashboardController::class, 'showOverview']);
    });
});