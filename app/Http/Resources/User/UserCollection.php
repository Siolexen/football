<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Resources\Json\ResourceCollection;

class UserCollection extends ResourceCollection
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
                'email' => $data->email,
                'name' => $data->name,
            ];
        });
    }
}
