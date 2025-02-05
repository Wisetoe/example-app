<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class StoreTodoRequest extends FormRequest
{    
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:150',
            'is_completed'=> 'bool',
        ];
    }
    
    public function authorize(): bool
    {
        return true;
    }
}