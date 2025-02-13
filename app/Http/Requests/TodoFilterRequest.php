<?php

namespace App\Http\Requests;

use App\Enums\Status;

use Illuminate\Foundation\Http\FormRequest;

class TodoFilterRequest extends FormRequest
{
    public function rules()
    {
        return [
            'search' => 'nullable|string|max:255',
            'status' => 'nullable|in:' . implode(',', array_map(fn($case) => $case->value, Status::cases())),
        ];
    }
    public function authorize()
    {
        return true; 
    }
}