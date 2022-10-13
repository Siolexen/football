<?php

namespace App\Http\Controllers\Api\Admin\Post;

use App\Http\Controllers\Api\BaseController;
use App\Http\Requests\Post\PostIndexRequest;
use App\Http\Requests\Post\PostStoreRequest;
use App\Http\Requests\Post\PostUpdateRequest;
use App\Http\Resources\Post\PostCollection;
use App\Http\Resources\Post\PostResource;
use App\Models\Post;
use App\Services\Post\PostResourceService;
use App\Services\Post\PostService;
use Illuminate\Http\Request;
use Exception;

class PostController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @param PostResourceService $postResourceService
     *
     * @return Response
     *
     */
    public function index(PostIndexRequest $request, PostResourceService $postResourceService)
    {
        $this->authorize('viewAny', [Post::class]);

        $posts = $postResourceService->getAllByOptions($request->validated());

        $response = [
            'data' => new PostCollection($posts),
            'page' => $posts->currentPage(),
            'lastPage' => $posts->lastPage(),
            'total' => $posts->total(),
            'perPage' => $posts->perPage(),
        ];

        return $this->sendResponse($response);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param PostStoreRequest $request
     * @param PostService $postService
     *
     * @return Response
     *
     */
    public function store(PostStoreRequest $request, PostService $postService)
    {
        $this->authorize('create', [Post::class]);

        try {
            $post = $postService->create($request->validated(), $request->file('cover'));
        } catch (Exception $e) {
            return $this->sendError(__('error.400'), 400);
        }

        return $this->sendResponse(new PostResource($post));
    }

    /**
     * Display the specified resource.
     *
     * @param string $postUuid
     * @param PostResourceService $postResourceService
     *
     * @return Response
     *
     */
    public function show(string $postUuid, PostResourceService $postResourceService)
    {
        $post = $postResourceService->getByUuid($postUuid);

        if (!$post)
            return $this->sendError(__('error.404'), 404);

        $this->authorize('view', $post);

        return $this->sendResponse(new PostResource($post));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param PostUpdateRequest $request
     * @param string $postUuid
     * @param PostService $postService
     * @param PostResourceService $postResourceService
     *
     * @return Response
     *
     */
    public function update(PostUpdateRequest $request, string $postUuid, PostService $postService, PostResourceService $postResourceService)
    {
        $post = $postResourceService->getByUuid($postUuid);

        if (!$post)
            return $this->sendError(__('error.404'), 404);

        $this->authorize('update', $post);

        try {
            $post = $postService->update($request->validated(), $post, $request->file('cover'));
        } catch (Exception $e) {
            return $this->sendError(__('error.400'), 400);
        }

        return $this->sendResponse(new PostResource($post));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param string $postUuid
     * @param PostService $postService
     * @param PostResourceService $postResourceService
     *
     * @return Response
     *
     */
    public function destroy(string $postUuid, PostService $postService, PostResourceService $postResourceService)
    {
        $post = $postResourceService->getByUuid($postUuid);

        if (!$post)
            return $this->sendError(__('error.404'), 404);

        $this->authorize('delete', $post);

        try {
            $postService->delete($post);
        } catch (Exception $e) {
            return $this->sendError(__('error.400'), 400);
        }

        return $this->sendResponseCode();
    }
}
