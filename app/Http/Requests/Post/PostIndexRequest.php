<?php

namespace App\Http\Requests\Post;
use Illuminate\Foundation\Http\FormRequest;

class PostIndexRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'page'    => 'integer|min:1',
            'perPage' => 'integer|min:1',
        ];
    }
}
