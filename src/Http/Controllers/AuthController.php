<?php

namespace Latus\Latus\Http\Controllers;

use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\View\View;
use Latus\Latus\Http\Requests\StoreUserRequest;
use Latus\Latus\Modules\Contracts\AuthModule;
use Latus\Permissions\Services\UserService;
use Latus\UI\Components\Contracts\ModuleComponent;
use Latus\UI\Services\ComponentService;

class AuthController extends Controller
{

    protected ModuleComponent $authModule;

    public function __construct(
        protected ComponentService $componentService
    )
    {
    }

    /**
     * Returns the auth-module or null if no binding for it exists in the app-container
     *
     * @return ModuleComponent|null
     */
    protected function getAuthModule(): ModuleComponent|null
    {
        if (!isset($this->{'authModule'})) {
            try {
                $this->authModule = $this->componentService->getActiveModule(AuthModule::class);
            } catch (BindingResolutionException $e) {
                return null;
            }
        }

        return $this->authModule;
    }

    /**
     * Returns the page-view or an error-response
     *
     * @param string $page
     * @return Response|View
     */
    protected function returnPageViewOrErrorResponse(string $page): Response|View
    {
        if (!$this->getAuthModule()) {
            return response('Service Unavailable', 503);
        }

        try {
            return $this->getAuthModule()->getPage($page)->resolvesView();
        } catch (\Throwable $e) {
            return response('Service Unavailable', 503);
        }
    }

    /**
     * Returns the login-view or an error-response
     *
     * @Route("/auth/login", methods={"GET"})
     * @return Response|View
     */
    public function showLogin(): Response|View
    {
        return $this->returnPageViewOrErrorResponse('login');
    }

    /**
     * Returns the login-view with support for multi-factor-authentication or an error-response
     *
     * @Route("/auth/mfa-login", methods={"GET"})
     * @return Response|View
     */
    public function showMultiFactorLogin(): Response|View
    {
        return $this->returnPageViewOrErrorResponse('multiFactorLogin');
    }

    /**
     * Attempts to authenticate a user and returns a json-response containing the status and additional messages
     * This route also handles multi-factor login-submit requests
     *
     * @Route("/auth/submit", methods={"POST"})
     * @return Response
     */
    public function authenticate(): Response
    {

    }

    /**
     * Returns the login-view or an error-response
     *
     * @Route("/auth/register", methods={"GET"})
     * @return Response|View
     */
    public function showRegister(): Response|View
    {
        return $this->returnPageViewOrErrorResponse('register');
    }

    /**
     * Attempts to store a new user and returns a json-response containing the status and additional messages
     *
     * @Route("/auth/store", methods={"PUT"})
     * @param StoreUserRequest $request
     * @param UserService $userService
     * @return Response|JsonResponse
     */
    public function store(StoreUserRequest $request, UserService $userService): Response|JsonResponse
    {
        $validatedInput = $request->validated();

        try {
            $user = $userService->createUser($validatedInput);
        } catch (\InvalidArgumentException $e) {
            return \response('Bad Request', 400);
        }

        return \response()->json([
            'message' => 'user created',
            'data' => [
                'created_at' => $user->getCreatedAtColumn()
            ]
        ]);

    }
}