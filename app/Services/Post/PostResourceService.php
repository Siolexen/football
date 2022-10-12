<?php

namespace App\Services\Post;

use App\Repositories\Post\PostRepository;

class PostResourceService
{
    private $postRepository;

    public function __construct()
    {
        $this->postRepository = new PostRepository;
    }

    /**
     * Get post by postSlug.
     *
     * @param string $postSlug
     * 
     * @return mixed
     * 
     */
    public function getByPostSlug($postSlug): mixed
    {
        return $this->postRepository->getByPostSlug($postSlug);
    }

    /**
     * Get post by postUuid.
     *
     * @param string $postUuid
     * 
     * @return mixed
     * 
     */
    public function getByUuid($postUuid): mixed
    {
        return $this->postRepository->getByUuid($postUuid);
    }

    /**
     * Get Posts by specific options.
     *
     * @param array $options
     *
     * @return mixed
     *
     */
    public function getAllByOptions(array $options = [])
    {
        return $this->postRepository->getAllByOptions($options);
    }
}
