<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class People extends Model
{
    protected $fillable = ['name', 'group_people_id'];

    public function group()
    {
        return $this->belongsTo('App\GroupPeople', 'group_people_id');
    }

    public function excel()
    {
        return $this->belongsToMany('App\GroupPeople', 'excel_people');
    }
}
