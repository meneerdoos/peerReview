<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setcriteria extends Model
{
    protected $table = "set_criteria";

    public function set()
    {
        return $this->belongsTo('App\Set','set_id','id');

    }

}
