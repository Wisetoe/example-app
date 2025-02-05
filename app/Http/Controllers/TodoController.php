<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTodoRequest;
use App\Models\Todo;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class TodoController extends Controller
{
    public function index()
    {
        $todos = Auth::user()->todos;

        return view('todo',compact('todos'));
    }
    public function store(StoreTodoRequest $request, Todo $todo)
    {
        $todo = Auth::user()->todos()->create($request->validated());

        return redirect()->route('todos.index')->with('success', 'Inserted');
    }
    public function edit(Todo $todo)
    {
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