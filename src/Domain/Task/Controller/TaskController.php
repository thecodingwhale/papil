<?php

namespace Papil\Domain\Task\Controller;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class TaskController extends Controller
{
    public function all()
    {
        return response()->json([]);
    }

}