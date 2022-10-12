<?php

namespace App\Http\Controllers\Api\User\Auth;

use App\Http\Controllers\Api\BaseController;
use App\Http\Requests\User\Auth\ForgetPasswordRequest;
use App\Http\Requests\User\Auth\ResetPasswordRequest;
use App\Services\User\UserResetPasswordService;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;

class UserResetPasswordController extends BaseController
{
    public function forgotPassword(ForgetPasswordRequest $request, UserResetPasswordService $userResetPasswordService)
    {
        $status = $userResetPasswordService->forgotPassword($request);

        if ($status == Password::RESET_LINK_SENT) {
            return $this->sendResponse([
                'status' => __($status)
            ]);
        }

        throw ValidationException::withMessages([
            'email' => [__($status)],
        ]);
    }

    public function reset(ResetPasswordRequest $request, UserResetPasswordService $userResetPasswordService)
    {
        $status = $userResetPasswordService->resetPassword($request);

        if ($status == Password::PASSWORD_RESET) {
            return $this->sendResponse([
                'message' => __('password.reset'),
            ]);
        }

        return $this->sendError(__($status), 422);
    }


}