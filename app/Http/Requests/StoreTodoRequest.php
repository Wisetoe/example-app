<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTodoRequest extends FormRequest
{    
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:150',
            'status'=> 'nullable|in:pending,completed,deferred',
        ];
    }
    
    public function authorize(): bool
    {
        return true;
    }
}