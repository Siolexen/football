<?php

namespace App\Services\Post;

use App\Models\Post;
use App\Repositories\Post\PostRepository;
use Illuminate\Support\Str;

class PostService
{
    private $postRepository;

    public function __construct()
    {
        $this->postRepository = new PostRepository;
        // $this->postResourceService = new PostResourceService;
    }

    public function create(array $data)
    {
        $data = $this->parseData($data);
        $post = $this->postRepository->create($data);

        // $this->storeFiles($post, $data);

        return $post;
    }

    public function update(array $data, Post $post)
    {
        $data = $this->parseData($data);

        // $this->storeFiles($post, $data);

        return $this->postRepository->update($data, $post);
    }

    public function delete(Post $post)
    {
        return $this->postRepository->delete($post);
    }

    private function parseData($data)
    {    
        $data['user_id'] = auth()->user()->id;
        $data['slug'] = Str::slug($data['title'], '-');

        return $data;
    }
}
