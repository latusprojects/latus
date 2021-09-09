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
    public function __construct(
        protected ComponentService $componentService
    )
    {
    }

    protected function returnView(View $viewTarget): Response|View
    {
        try {
            /**
             * @var ModuleComponent $module
             */
            $module = $this->componentService->getActiveModule(AdminModule::class);
        } catch (BindingResolutionException $e) {
            abort(503);
        }


        $pageView = null;
        try {
            $pageView = $module->getPage('page')->resolvesView()->with(['admin-nav' => app()->make('admin-nav'), 'content' => $viewTarget->render()]);
        } catch (\Throwable $e) {
            abort(503);
        }

        return $pageView;

    }
}