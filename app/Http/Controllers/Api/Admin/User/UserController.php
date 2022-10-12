<?php

namespace App\Http\Controllers\Api\Admin\User;

use App\Http\Controllers\Api\BaseController;
use App\Http\Requests\User\UserIndexRequest;
use App\Http\Requests\User\UserStoreRequest;
use App\Http\Requests\User\UserUpdateRequest;
use App\Http\Resources\User\UserCollection;
use App\Http\Resources\User\UserResource;
use App\Models\User;
use App\Services\User\UserResourceService;
use App\Services\User\UserService;
use Exception;

class UserController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @param UserIndexRequest $request
     * @param UserResourceService $userResourceService
     *
     * @return Response
     *
     */
    public function index(UserIndexRequest $request, UserResourceService $userResourceService)
    {
        $this->authorize('viewAny', [User::class]);

        $users = $userResourceService->getAllByOptions($request->validated());

        $response = [
            'data' => new UserCollection($users),
            'page' => $users->currentPage(),
            'lastPage' => $users->lastPage(),
            'total' => $users->total(),
            'perPage' => $users->perPage(),
        ];

        return $this->sendResponse($response);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param UserStoreRequest $request
     * @param UserService $userService
     *
     * @return Response
     *
     */
    public function store(UserStoreRequest $request, UserService $userService)
    {
        $this->authorize('create', [User::class]);

        // try {
            $user = $userService->create($request->validated());
        // } catch (Exception $e) {
        //     return $this->sendError(__('error.400'), 400);
        // }

        return $this->sendResponse(new UserResource($user));
    }

    /**
     * Display the specified resource.
     *
     * @param string $userUuid
     * @param UserResourceService $userResourceService
     *
     * @return Response
     *
     */
    public function show(string $userUuid, UserResourceService $userResourceService)
    {
        $user = $userResourceService->getUserByUuid($userUuid);

        if (!$user)
            return $this->sendError(__('error.404'), 404);

        $this->authorize('view', $user);

        return $this->sendResponse(new UserResource($user));
    }

     /**
     * Update the specified resource in storage.
     *
     * @param UserUpdateRequest $request
     * @param string $userUuid
     * @param UserService $userService
     * @param UserResourceService $userResourceService
     *
     * @return Response
     *
     */
    public function update(UserUpdateRequest $request, string $userUuid, UserService $userService, UserResourceService $userResourceService)
    {
        $user = $userResourceService->getUserByUuid($userUuid);

        if (!$user)
            return $this->sendError(__('error.404'), 404);

        $this->authorize('update', $user);

        try {
            $user = $userService->update($request->validated(), $user);
        } catch (Exception $e) {
            return $this->sendError(__('error.400'), 400);
        }

        return $this->sendResponse(new UserResource($user));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param string $userUuid
     * @param UserService $userService
     * @param UserResourceService $userResourceService
     *
     * @return Response
     *
     */
    public function destroy(string $userUuid, UserService $userService, UserResourceService $userResourceService)
    {
        $user = $userResourceService->getUserByUuid($userUuid);

        if (!$user)
            return $this->sendError(__('error.404'), 404);

        $this->authorize('delete', $user);

        try {
            $userService->delete($user);
        } catch (Exception $e) {
            return $this->sendError(__('error.400'), 400);
        }

        return $this->sendResponseCode();
    }
}
