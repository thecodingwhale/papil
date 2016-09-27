<?php

namespace Papil\Domain\Task\Services;

use Papil\Core\BaseService;
use Papil\Domain\Task\Models\Task;
use Papil\Infrastructure\Repositories\TaskRepository;

class TaskService extends BaseService
{

    protected $taskRepository;

    public function __construct(
        TaskRepository $taskRepository
    )
    {
        $this->taskRepository = $taskRepository;
    }

    public function getSingleTask($id)
    {
        return $this->taskRepository->find($id);
    }

    public function getAllTasks()
    {
        return $this->taskRepository->all();
    }

    public function addNewTask($task)
    {
        return $this->taskRepository->create($task);
    }

    public function updateTask($taskId, $userId, $task)
    {
        return $this->taskRepository->update($taskId, $userId, $task);
    }

    public function deleteTask($taskId)
    {
        return $this->taskRepository->delete($taskId);
    }

}
