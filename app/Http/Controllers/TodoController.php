<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    // Fetch all tasks
    public function index()
    {
        return Todo::all();
    }

    // Save a new task
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $todo = new Todo();
        $todo->name = $request->name;
        $todo->status = 'In progress';
        $todo->save();

        return response()->json(['message' => 'Task saved successfully!', 'task' => $todo]);
    }

    // Update task status to 'Finished'
    public function update($id)
    {
        $todo = Todo::find($id);
        $todo->status = 'Finished';
        $todo->save();

        return response()->json(['message' => 'Task updated successfully!']);
    }

    // Delete a task
    public function destroy($id)
    {
        $todo = Todo::find($id);
        $todo->delete();

        return response()->json(['message' => 'Task deleted successfully!']);
    }
}

