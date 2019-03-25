<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use mysql_xdevapi\Collection;

class Peer_review extends Model
{
    protected $table = "peer_reviews";

    public function criteria()
    {
        return $this->hasMany('App\Criteria','peer_review_id','id');
    }

    public function groups()
    {
        return $this->hasMany('App\Group','peer_review_id','id');
    }

    public function people()
    {
        $groups = $this->groups()->get();
        $people = null ;
        foreach ($groups as $group )
        {
            if ( $people == null )
            {
                $people = $group->people()->get();
            }
            else
            {
                $people = $people->merge($group->people()->get());
            }
        }

        return $people ;

    }

    public function getStatus()
    {

    }


}
