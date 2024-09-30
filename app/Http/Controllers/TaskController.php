<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::all();

        return response()->json([
            'tasks' => $tasks
        ]);
    }

    public function show($id)
    {
        $task = Task::find($id);

        return response()->json([
            'task' => $task
        ]);
    }

    public function store(Request $request)
    {
        $task = new Task;

        $task->name = $request->input('name');
        $task->description = $request->input('description');
        $task->completed = $request->input('completed');

        $task->save();

        return response()->json([
            'message' => 'Task created successfully',
            'task' => $task
        ]);
    }

    public function update(Request $request, $id)
    {
        $task = Task::find($id);

        $task->name = $request->input('name');
        $task->description = $request->input('description');
        $task->completed = $request->input('completed');

        $task->save();

        return response()->json([
            'message' => 'Task updated successfully',
            'task' => $task
        ]);
    }

    public function destroy($id)
    {
        $task = Task::find($id);

        $task->delete();

        return response()->json([
            'message' => 'Task deleted successfully'
        ]);
    }
}
