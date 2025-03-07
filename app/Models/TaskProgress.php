<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskProgress extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table   = "task_progress";

    public function task()
    {
        return $this->belongsTo(Task::class);
    }
}
