<?php

namespace Latus\Latus\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\View\View;
use Latus\Latus\Http\Requests\WebPageRequest;
use Latus\Latus\Modules\Contracts\WebModule;

class WebController extends Controller
{

    public function __construct(
        protected WebModule $webModule
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

        return $page->resolvesView() ?? \response('Not Found', 404);
    }
}