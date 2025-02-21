<?php

namespace App\Http\Requests;

use App\Enums\Roles;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
{
    public function authorize()
    {
        return true; 
    }

    public function rules()
    {
        $userId = $this->route('user');

        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $userId,
            'role' => [Rule::enum(Roles::class)],
        ];
    }
}