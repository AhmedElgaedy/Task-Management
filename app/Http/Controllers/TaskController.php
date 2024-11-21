<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        // Filter tasks by status, due_date range, or both
        $tasks = Task::query();

        if ($request->filled('status')) {
            $tasks->where('status', $request->status);
        }

        if ($request->filled('start_date') && $request->filled('end_date')) {
            $tasks->whereBetween('due_date', [$request->start_date, $request->end_date]);
        }

        return TaskResource::collection($tasks->get());
    }

    public function store(TaskRequest $request)
    {
        $task = Task::create($request->validated());
        return new TaskResource($task);
    }

    public function show(Task $task)
    {
        return new TaskResource($task);
    }

    public function update(TaskRequest $request, Task $task)
    {
        $task->update($request->validated());
        return new TaskResource($task);
    }

    public function destroy(Task $task)
    {
        $task->delete();
        return response()->noContent();
    }

    public function userTasks($email)
    {
        $user = User::where('email', $email)->firstOrFail();
        return TaskResource::collection($user->tasks);
    }
}
