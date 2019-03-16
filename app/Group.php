<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $table = "group";

    public function peerReview()
    {
        return $this->belongsTo('App\Peer_review','id','peer_review_id');
    }

    public function people()
    {
        return $this->hasMany('App\Person','group_id','id');

    }
}
