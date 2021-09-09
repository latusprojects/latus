<?php

namespace Latus\Latus\Http\Controllers;

use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Latus\Latus\Http\Requests\AuthenticateUserRequest;
use Latus\Latus\Http\Requests\StoreUserRequest;
use Latus\Latus\Modules\Contracts\AuthModule;
use Latus\Permissions\Services\UserService;
use Latus\UI\Components\Contracts\ModuleComponent;
use Latus\UI\Services\ComponentService;

class DashboardController extends AdminController
{
    public function showOverview()
    {
        
    }
}