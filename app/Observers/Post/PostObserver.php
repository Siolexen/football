<?php

namespace App\Observers\Post;

use App\Helpers\UuidGenerator;
use App\Models\Post;

class PostObserver
{
    /**
     * Handle the Post "creating" event.
     *
     * @param  Post  $post
     * @return void
     */
    public function creating(Post $post)
    {
        $post->uuid = UuidGenerator::generate(Post::class);
    }

    /**
     * Handle the Post "saving" event.
     *
     * @param  Post  $post
     * @return void
     */
    public function saving(Post $post)
    {
        //
    }

    /**
     * Handle the Post "deleted" event.
     *
     * @param  Post  $post
     * @return void
     */
    public function saved(Post $post)
    {
        //
    }

    /**
     * Handle the Post "restored" event.
     *
     * @param  Post  $post
     * @return void
     */
    public function restored(Post $post)
    {
        //
    }

    /**
     * Handle the Post "force deleted" event.
     *
     * @param  Post  $post
     * @return void
     */
    public function forceDeleted(Post $post)
    {
        //
    }
}
