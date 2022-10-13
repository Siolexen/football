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
    }

    /**
     * Create post model.
     *
     * @param array $data
     * @param null $file
     * 
     * @return Post
     * 
     */
    public function create(array $data, $file = null): Post
    {
        $data = $this->parseData($data);
        $data = $this->storeFiles($data, $file);

        return $this->postRepository->create($data);
    }

    /**
     * Update post model.
     *
     * @param array $data
     * @param Post $post
     * @param null $file
     * 
     * @return Post
     * 
     */
    public function update(array $data, Post $post, $file = null): Post
    {
        $data = $this->parseData($data);
        $data = $this->storeFiles($data, $file);

        return $this->postRepository->update($data, $post);
    }

    /**
     * Delete post model.
     *
     * @param Post $post
     * 
     * 
     */
    public function delete(Post $post)
    {
        return $this->postRepository->delete($post);
    }

    /**
     * Parse data
     *
     * @param mixed $data
     * 
     * @return array
     * 
     */
    private function parseData($data)
    {    
        $data['slug'] = Str::slug($data['title'], '-');

        return $data;
    }

    /**
     * Store files
     *
     * @param mixed $data
     * @param mixed $file
     * 
     * @return array
     * 
     */
    public function storeFiles($data, $file)
    {    
        if (!$file) {
            return $data;
        }

        $fileName = time() . '.' . $file->extension();

        $file->move('images', $fileName); 

        $data['cover'] = $fileName;

        return $data;
    }
}
