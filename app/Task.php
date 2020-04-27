<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = ['name', 'description', 'task_status_id', 'assigned_to_id', 'created_by_id'];

    public function status()
    {
        return $this->belongsTo('App\TaskStatus', 'task_status_id');
    }

    public function creator()
    {
        return $this->belongsTo('App\User', 'created_by_id');
    }

    public function assigner()
    {
        return $this->belongsTo('App\User', 'assigned_to_id');
    }

    public function labels()
    {
        return $this->belongsToMany('App\Label');
    }


}
