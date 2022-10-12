<?php

namespace App\Http\Controllers\Api\v2\User\Auth;

use App\Http\Controllers\Api\BaseController;
use App\Http\Requests\User\Auth\ResendVerifyEmailRequest;
use App\Http\Requests\User\Auth\VerifyEmailRequest;
use App\Services\User\UserResourceService;
use App\Services\User\UserVerifyEmailService;
use Exception;

class VerifyEmailController extends BaseController
{
    /**
     * @param ResendVerifyEmailRequest $request
     * @return \Illuminate\Http\Response
     */
    public function resendVerifyEmail(ResendVerifyEmailRequest $request)
    {
        $user = $request->user();

        if($user->hasVerifiedEmail()){
            return $this->sendError(__('mail.your-email-address-is-verified'), 400);
        }

        if(!$user){
            return $this->sendError(__('error.404'), 404);
        }

        try {
            $user->sendEmailVerificationNotification();
        } catch (Exception $e) {
            return $this->sendError(__('error.general'), 400);
        }

        return $this->sendResponseCode(200);
    }

    public function verifyEmail(VerifyEmailRequest $request, UserVerifyEmailService $userVerifyEmailService, UserResourceService $userRepositoryService)
    {
        $user = $userRepositoryService->getNotVerifiedUserByUuid($request->input('userUuid'));

        if(!$user){
            return $this->sendError(__('error.404'), 404);
        }

        try {
            if(!$userVerifyEmailService->verifyEmail($request->validated(), $user)){
                return $this->sendError(__('error.general'), 400);
            }
        } catch (Exception $e) {
            return $this->sendError(__('error.general'), 400);
        }

        return $this->sendResponseCode();
    }
}