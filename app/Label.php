<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Label extends Model
{
    protected $fillable = ['name'];
    public function tasks()
    {
        $this->hasMany('App\Task', 'task_status_id');
    }
}
