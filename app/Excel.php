<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Excel extends Model
{
    public function people()
    {
        return $this->belongsToMany('App\People', 'excel_people');
    }
}
