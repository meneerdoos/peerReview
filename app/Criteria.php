<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Criteria extends Model
{
    protected $table = "criteria";

    public function peer_review(){
        $this->belongsTo('App\Peer_review','id','peer_review_id');
    }
}
