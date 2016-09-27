<?php

namespace Papil\Domain\Task\Models;

use Papil\Core\BaseModel;

class Task extends BaseModel
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'status', 'title'
    ];

}
