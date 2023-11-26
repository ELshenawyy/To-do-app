<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::all();
        return view('tasks', compact('tasks'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
        ]);

        Task::create([
            'title' => $request->title,
            'completed' => false,
        ]);

        return redirect()->route('tasks.index');
    }

    public function update(Task $task)
    {
        $task->update([
            'completed' => !$task->completed,
        ]);

        return redirect()->route('tasks.index');
    }

    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->route('tasks.index');
    }
}