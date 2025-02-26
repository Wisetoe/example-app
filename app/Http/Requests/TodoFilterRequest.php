<?php

namespace App\Http\Requests;

use App\Enums\Status;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TodoFilterRequest extends FormRequest
{
    public function rules()
    {
        return [
            'search' => 'nullable|string|max:255',
            'status' => [Rule::enum(Status::class)],
        ];
    }
    public function authorize()
    {
        return true; 
    }
}