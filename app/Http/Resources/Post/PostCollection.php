<?php

namespace App\Http\Resources\Post;

use Illuminate\Http\Resources\Json\ResourceCollection;

class PostCollection extends ResourceCollection
{
    /**
     * Transform the resource into an array.
     *
     * @param mixed $request
     * 
     * @return array
     * 
     */
    public function toArray($request)
    {
        return $this->collection->map(function ($data) {
            return  [
                'id' => $data->uuid,
                'slug' => $data->slug,
                'title' => $data->title,
                'body' => $data->body,
            ];
        });
    }
}
