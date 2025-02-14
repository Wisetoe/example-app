<?php

namespace App\Http\Requests;

use App\Enums\Status;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreTodoRequest extends FormRequest
{    
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:150',
            'status' => [Rule::enum(Status::class)],
        ];
    }
    
    public function authorize(): bool
    {
        return true;
    }
}