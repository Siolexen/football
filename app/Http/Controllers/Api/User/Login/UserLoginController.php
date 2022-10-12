<?php

namespace App\Http\Controllers\Api\User\Login;

use App\Http\Controllers\Api\BaseController;
use App\Http\Requests\User\LoginRequest;
use App\Services\User\UserLoginService;
use App\Services\User\UserResourceService;
use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class UserLoginController extends BaseController
{
    /**
     * Try login user to admin.
     *
     * @param LoginRequest $request
     * @param UserLoginService $userLoginService
     * @param UserResourceService $userResourceService
     *
     * @return Response
     *
     */
    public function login(LoginRequest $request, UserLoginService $userLoginService, UserResourceService $userResourceService)
    {
        $user = $userResourceService->getUserByEmail($request->email);

        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        return $this->sendResponse([
            'access_token' => $userLoginService->createToken($user),
            'token_type' => 'Bearer',
        ]);
    }
}
