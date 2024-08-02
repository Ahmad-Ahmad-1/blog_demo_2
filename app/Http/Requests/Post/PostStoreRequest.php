<?php

namespace App\Http\Requests\Post;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\File;

class PostStoreRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => ['required', 'min:3', 'max:50'],
            'caption' => ['required', 'string'],
            'img' => ['nullable', 'image']
        ];
    }
}
