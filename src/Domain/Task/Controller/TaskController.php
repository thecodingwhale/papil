<?php

namespace Papil\Domain\Task\Controller;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Papil\Domain\Task\Models\Task;

class TaskController extends Controller
{
    public function all()
    {
        $tasks = new Task();
        return response()->json($tasks->get()->toArray());
    }

}