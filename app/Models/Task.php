<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    /**
     * The tags that belong to the task.
     */
    public function tags()
    {
        return $this->belongsToMany(Task::class, TaskTag::class);
    }
}
