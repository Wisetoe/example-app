<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;

use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Http\Requests\UserAddRequest;

class UserController extends Controller
{
    public function index()
    {
        if (!auth()->check() || !auth()->user()->isAdmin()) {
            return redirect('/')->with('error', 'У вас нет доступа к этой странице.');
        }
        $users = User::with('role')->get();

        return view('users.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::all();

        return view('users.create', compact('roles'));
    }

    public function store(UserAddRequest $request, User $user)
    {
        $validatedData = $request->validated();
        $validatedData['password'] = bcrypt($validatedData['password']);
        $user->create($validatedData);

        return redirect()->route('users.index')->with('success', 'Пользователь успешно создан!');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::all(); 

        return view('users.edit', compact('user', 'roles')); // Передаем пользователя и роли в представление
    }

    public function update(UserRequest $request, $userId)
    {
    
        $user = User::findOrFail( $userId);
        $user->update($request->validated());
    
        return redirect()->route('users.index')->with('success', 'Пользователь обновлен успешно.');
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('users.index')->with('success', 'Пользователь успешно удален!');
    }
}
