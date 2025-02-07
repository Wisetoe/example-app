<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TodoFilterRequest extends FormRequest
{
    public function rules()
    {
        return [
            'search' => 'nullable|string|max:255',
            'status' => 'nullable|in:pending,completed,deferred', 
        ];
    }
    public function authorize()
    {
        return true; 
    }
}