<?php

namespace App\Http\Requests;

use App\Enums\Status;

use Illuminate\Foundation\Http\FormRequest;

class StoreTodoRequest extends FormRequest
{    
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:150',
            'status' => 'nullable|in:' . implode(',', array_map(fn($case) => $case->value, Status::cases())),
        ];
    }
    
    public function authorize(): bool
    {
        return true;
    }
}