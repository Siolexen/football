<?php

namespace App\Http\Controllers\Api\User\Register;

use App\Http\Controllers\Api\BaseController;
use App\Http\Requests\User\RegisterPostRequest;
use App\Services\User\UserLoginService;
use App\Services\User\UserRegisterService;
use App\Services\User\UserResourceService;

class UserRegisterController extends BaseController
{
    /**
     * UserRegisterController constructor.
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Register User.
     *
     * @param RegisterPostRequest $request
     * @param UserRegisterService $userRegisterService
     * @param UserResourceService $userResourceService
     * @param UserLoginService $userLoginService
     *
     * @return Response
     *
     */
    protected function register(RegisterPostRequest $request, UserRegisterService $userRegisterService, UserResourceService $userResourceService, UserLoginService $userLoginService)
    {
        $user = $userResourceService->getUserByEmail($request->email);

        if ($user) {
            return $this->sendResponse([
                'email' => $request->email
            ]);
        }

        if ($user = $userRegisterService->register($request->validated())) {
            return $this->sendResponse([
                'email' => $request->email,
                'access_token' => $userLoginService->createToken($user),
                'token_type' => 'Bearer',
                'messages' => __('login.verification-link-has-been-sent-to-your-email-address')
            ]);
        }

        return $this->sendError(__('error.400'), 400);
    }
}
