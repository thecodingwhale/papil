<?php

namespace Papil\Infrastructure\Repositories;

use Papil\Core\BaseRepository;
use Papil\Domain\Task\Models\Task;

class TaskRepository extends BaseRepository
{
    protected $model;

    public function __construct(
        Task $model
    )
    {
        $this->model = $model;
    }

    public function find($id)
    {
        return $this->model->find($id);
    }

    public function all()
    {
        return $this->model->get();
    }

    public function create($task)
    {
        $task = new Task($task);
        foreach ($task->getAttributes() as $attribute => $value) {
            $this->model->$attribute = $value;
        }
        $this->model->save();
    }

    public function update($taskId, $userId, $task)
    {
        $this->model->where('id', $taskId)
              ->where('user_id', $userId)
              ->update($task);

    }

    public function delete($taskId)
    {
        $this->model->where('id', $taskId)->delete();
    }

}