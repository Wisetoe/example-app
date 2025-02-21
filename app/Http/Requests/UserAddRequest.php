<?php

namespace App\Http\Requests;

use App\Enums\Roles;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserAddRequest extends FormRequest
{
    public function authorize()
    {
        return true; 
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'role' => [Rule::enum(Roles::class)],
        ];
    }
}