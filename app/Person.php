<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Person extends Model
{

    protected $table = "person";

    public function group()
    {
        return $this->belongsTo('App\Group','id','group_id');

    }
}
