<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class Peer_review extends Model
{
    protected $table = "peer_reviews";

    public function criteria()
    {
        return $this->hasMany('App\Criteria','peer_review_id','id');
    }

    public function group()
    {
        return $this->hasOne('App\Group','peer_review_id','id');
    }


}
