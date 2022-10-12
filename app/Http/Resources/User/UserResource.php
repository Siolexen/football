<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
        return [
            'id' => $this->uuid,
            'email' => $this->email,
            'name' => $this->name,
        ];
    }
}
