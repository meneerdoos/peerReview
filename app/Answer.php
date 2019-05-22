<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $table = "answer";


    public function criteria()
    {
            return $this->belongsTo('App\Criteria','criteria_id','id');
    }

    public function from()
    {

    }

    public function about()
    {

    }



}
