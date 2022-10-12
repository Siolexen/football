<?php

namespace App\Http\Controllers\Api\Post;

use App\Http\Controllers\Api\BaseController;
use App\Http\Requests\Post\PostIndexRequest;
use App\Http\Resources\Post\PostCollection;
use App\Http\Resources\Post\PostResource;
use App\Models\Post;
use App\Services\Post\PostResourceService;
use Illuminate\Http\Request;

class PostController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @param PostIndexRequest $request
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
     * Display the specified resource.
     *
     * @param string $postSlug
     * @param PostResourceService $postResourceService
     *
     * @return Response
     *
     */
    public function show(string $postSlug, PostResourceService $postResourceService)
    {
        $post = $postResourceService->getByPostSlug($postSlug);

        if (!$post)
            return $this->sendError(__('error.404'), 404);

        $this->authorize('view', $post);

        return $this->sendResponse(new PostResource($post));
    }
}
