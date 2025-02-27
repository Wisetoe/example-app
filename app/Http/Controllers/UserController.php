<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;

use App\Enums\Roles;
use App\Http\Requests\UserRequest;
use App\Http\Requests\UserAddRequest;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{
    public function index(User $user)
    {
        if (Gate::allows('view', $user)) {
            $users = User::all();

            return view('users.index', compact('users'));
        }

        return redirect('/')->with('error', 'У вас нет доступа к этой странице.');
    }

    public function create(User $user)
    {
        if (Gate::allows('create', $user)) {
            $roles = Roles::cases();

            return view('users.create', compact( 'roles'));
        }

        return redirect('/')->with('error', 'У вас нет доступа к этой странице.');
    }

    public function store(UserAddRequest $request, User $user)
    {
        if (Gate::allows('create', $user)) {
            $validatedData = $request->validated();
            $validatedData['password'] = bcrypt($validatedData['password']);
            $user->create($validatedData);

            return redirect()->route('users.index')->with('success', 'Пользователь успешно создан!');
        }

        return redirect('/')->with('error', 'У вас нет доступа к этой странице.');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Roles::cases();

        return view('users.edit', compact('user', 'roles'));
    }

    public function update(UserRequest $request, $userId)
    {
    
        $user = User::findOrFail( $userId);
        $user->update($request->validated());
    
        return redirect()->route('users.index')->with('success', 'Пользователь обновлен успешно.');
    }

    public function destroy(User $user)
    {
        if (Gate::allows('delete', $user)) {
            $user->delete();

            return redirect()->route('users.index')->with('success', 'Пользователь успешно удален!');
        }
    }
}
