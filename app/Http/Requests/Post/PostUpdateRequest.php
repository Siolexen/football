<?php

namespace App\Http\Requests\Post;
use Illuminate\Foundation\Http\FormRequest;

class PostUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'nullable|string',
            'body' => 'nullable|string',
            'cover' => 'nullable|file|mimes:jpg,jpeg,bmp,png',
        ];
    }
}
