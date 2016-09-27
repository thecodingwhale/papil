<?php

namespace Papil\Domain\Task\Controller;

use Papil\Core\BaseController;
use Papil\Domain\Task\Services\TaskService;

use Illuminate\Http\Request;

class TaskController extends BaseController
{

    protected $taskService;

    public function __construct(
        TaskService $taskService
    )
    {
        $this->taskService = $taskService;
    }

    public function show($taskId)
    {
        $task = $this->taskService->getSingleTask($taskId);
        $task = !is_null($task) ? $task : collect([]);
        return response()->json($task->toArray());
    }

    public function all()
    {
        $tasks = $this->taskService->getAllTasks();
        $tasks = !is_null($tasks) ? $tasks : collect([]);
        return response()->json($tasks->toArray());
    }

    public function store(Request $request)
    {
        $this->taskService->addNewTask($request->all());
    }

    public function update($taskId, Request $request)
    {
        $userId = $request->input('user_id');
        $this->taskService->updateTask($taskId, $userId, $request->all());
    }

    public function destroy($taskId)
    {
        $this->taskService->deleteTask($taskId);
    }

}