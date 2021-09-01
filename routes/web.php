<?php

use Illuminate\Support\Facades\Route;
use Latus\Latus\Http\Controllers\WebController;

/*
 * Module: Web
 * Routes for basic functionality
 */

Route::middleware(['web'])->group(function () {
    Route::get('/page/{page_id}', [WebController::class, 'showPage']);
});