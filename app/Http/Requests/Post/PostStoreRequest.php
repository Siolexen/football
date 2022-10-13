<?php

namespace App\Http\Requests\Post;
use Illuminate\Foundation\Http\FormRequest;

class PostStoreRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|string',
            'body' => 'required|string',
            'cover' => 'nullable|file|mimes:jpg,jpeg,bmp,png',
        ];
    }
}
