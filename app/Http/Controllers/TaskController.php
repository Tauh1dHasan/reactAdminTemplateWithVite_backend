<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Http\Resources\TaskResource;
use App\Http\Resources\TaskCollection;

use App\Models\Task;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        return new TaskCollection(Task::all());
    }

    public function show(Request $request, Task $task)
    {
        return new TaskResource($task);
    }

    public function store(StoreTaskRequest $request)
    {
        $validated = $request->validated();

        $task = Task::create($validated);

        return new TaskResource($task);
    }

    public function update(UpdateTaskRequest $request, Task $task)
    {
        $validated = $request->validated();

        $task->update($validated);

        return new TaskResource($task);
    }

    public function destroy(Task $task)
    {
        $task->delete();

        return response()->noContent();
    }
    
}
