<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $fillable=['title'];

    /**
     * The tasks that belong to the tag.
     */
    public function tasks()
    {
        return $this->belongsToMany(Task::class, TaskTag::class);
    }
}
