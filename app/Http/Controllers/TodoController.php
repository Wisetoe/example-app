<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use App\Models\User;
use App\Http\Requests\StoreTodoRequest;
use App\Http\Requests\TodoFilterRequest;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Gate;
use SebastianBergmann\Type\FalseType;

class TodoController extends Controller
{
    public function index(TodoFilterRequest $request)
    {
        if (Gate::allows('isAdmin', auth()->user())) {
            $todos = Todo::all(); 
            $users = User::all(); 

            return view('todo', compact('todos', 'users'));
        }

        $todos = Auth::user()->todos()->filter($request->validated())->get();

        return view('todo', compact('todos'));
    }

    public function store(StoreTodoRequest $request, Todo $todo)
    {
        if (Gate::allows('isAdmin', auth()->user())) {
            $userId = $request->validated()['user_id'];
            $todo = Todo::create(array_merge($request->validated(), ['user_id' => $userId]));

            return redirect()->route('todos.index')->with('success', 'Inserted');;
        }
        $todo = Auth::user()->todos()->create($request->validated());

        return redirect()->route('todos.index')->with('success', 'Inserted');
    }
    public function edit(Todo $todo)
    {
        if (Gate::allows('isAdmin', auth()->user())) {
            $users = User::all();

            return view('edit-todo',compact('todo', 'users'));
        }
        return view('edit-todo',compact('todo'));
    }
    public function update(StoreTodoRequest $request, Todo $todo)
    {
        $todo->update($request->validated());

        return redirect()->route('todos.index')->with('success', 'Updated Todo');
    }

    public function destroy(Todo $todo)
    {
        $todo->delete();

        return redirect()->route('todos.index')
                         ->with('success', 'Deleted successfully');
    }
}