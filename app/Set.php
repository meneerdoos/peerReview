<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Set extends Model
{
    protected $table = "set";

    public function setCriteria()
    {
        return $this->hasMany('App\Setcriteria','set_id','id');

    }

    public function getCriteriaAsArray()
    {
        return json_encode( $this->setCriteria()->get()->toArray());

    }

}
