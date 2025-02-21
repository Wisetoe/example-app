<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    public function isAdmin(User $user)
    {
        return $user->role === "admin";
    }
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }
}
