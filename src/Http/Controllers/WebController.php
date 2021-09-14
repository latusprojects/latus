<?php

namespace Latus\Latus\Http\Controllers;

use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\View\View;
use Latus\Latus\Http\Requests\WebPageRequest;
use Latus\Latus\Modules\Contracts\WebModule;
use Latus\UI\Components\Contracts\ModuleComponent;
use Latus\UI\Services\ComponentService;

class WebController extends Controller
{

    public function __construct(
        protected ComponentService $componentService
    )
    {
    }

    public function showPage(WebPageRequest $request): Response|View
    {
        if (!($content = $request->getPageContent())) {
            return response('Not Found', 404);
        }

        $page = $this->webModule->getPage('page');
        $page->setContent($content);

        if (!($view = $page->resolvesView())) {
            abort(404);
        }

        return $view;
    }
}