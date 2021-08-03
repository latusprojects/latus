<?php


namespace Latus\Latus\Http\Controllers;


use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;
use Latus\UI\Components\Contracts\ModuleComponent;
use Latus\Latus\Modules\Contracts\AdminModule;
use Latus\UI\Services\ComponentService;

class AdminController extends Controller
{
    public function showPage(Request $request, ComponentService $componentService, View $viewTarget): Response|View
    {
        try {
            /**
             * @var ModuleComponent $module
             */
            $module = $componentService->getActiveModule(AdminModule::class);
        } catch (BindingResolutionException $e) {
            return response('Service Unavailable', 503);
        }

        try {
            return $module->resolvesView()->with(['admin-nav' => app()->make('admin-nav'), 'content' => $viewTarget->render()]);
        } catch (\Throwable $e) {
            return response('Service Unavailable', 503);
        }

    }
}