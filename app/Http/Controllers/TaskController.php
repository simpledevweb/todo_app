<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function addtask(Request $request)
    {
        $user = $request->user();
        Task::create([
            'user_id' => $user->id,
            'title' => $request->title,
            'description' => $request->description,
            'deadline' => $request->deadline
        ]);
        return [
            'successful_added' => true
        ];
    }

    public function updatetask(Request $request, $task)
    {
        $task_id = $task;
        $taskup = Task::find($task_id);
        if (!$taskup) {
            return response()->json([
            'error' => 'Task not found'
            ], 404);
            }
        $taskup->update([
            "title" => $request->title,
            "description" => $request->description,
            "active" => $request->active,
            "deadline" => $request->deadline
        ]);
        return [
            'successful_updated' => true
        ];
    }

    public function deletetask($task)
    {
        $task_del = Task::find($task);
        if (!$task_del) {
            return response()->json([
            'error' => 'Task not found'
            ], 404);
            }
        $task_del->delete();
        return [
            'successful_deleted' => true
        ];
    }

    public function gettask(Request $request)
    {
        return Task::where('user_id', $request->user()->id)->select('id', 'title', 'description', 'deadline', 'active')->get();
    }
}
