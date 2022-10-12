<?php

namespace App\Repositories\Post;

use App\Models\Post;

class PostRepository
{
    /**
     * Create Post model.
     *
     * @param array $data
     *
     * @return Post
     *
     */
    public function create(array $data): Post
    {
        $post           = new Post;
        $post->title    = $data['title'];
        $post->body     = $data['body'];
        $post->slug     = $data['slug'];
        $post->user_id  = $data['user_id'];
        $post->save();

        return $post;
    }

    /**
     * Update Post model.
     *
     * @param array $data
     * @param Post $post
     *
     * @return Post
     *
     */
    public function update(array $data, Post $post): Post
    {
        if (array_key_exists('title', $data)) {
            $post->title = $data['title'];
        }

        if (array_key_exists('body', $data)) {
            $post->body = $data['body'];
        }
        
        if (array_key_exists('slug', $data)) {
            $post->slug = $data['slug'];
        }

        if (array_key_exists('user_id', $data)) {
            $post->user_id = $data['user_id'];
        } 

        if ($post->isDirty())
            $post->save();

        return $post;
    }

    /**
     * Delete Post model.
     *
     * @param Post $post
     *
     * @return bool
     *
     */
    public function delete(Post $post): bool
    {
        $post->delete();
        return true;
    }

    /**
     * Get post by postSlug.
     *
     * @param string $postSlug
     * 
     * @return mixed
     * 
     */
    public function getByPostSlug(string $postSlug): mixed
    {
        return Post::where('slug', $postSlug)->first();
    }

    /**
     * Get post by postSlug.
     *
     * @param string $postSlug
     * 
     * @return mixed
     * 
     */
    public function getByUuid(string $postUuid): mixed
    {
        return Post::where('uuid', $postUuid)->first();
    }

    /**
     * Get Posts by specific options.
     *
     * @param array $options
     *
     * @return mixed
     *
     */
    public function getAllByOptions(array $options = []): mixed
    {
        $query = Post::query();

        //PAGINATION
        return $query->paginate($options['perPage'] ?? 10);
    }
}
