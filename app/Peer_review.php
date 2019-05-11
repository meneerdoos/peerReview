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

    public function deletePeerReview()
    {
        $criteria = $this->criteria();
        $groups = $this->groups();

        foreach ($groups as $group)
        {
            $group->deleteGroup();
        }
        foreach($criteria as $crit)
        {
            $crit->delete();
        }
        $this->delete();
    }

    public function answers()
    {
        $criteria = $this->criteria()->get();
        $answers = null ;
        foreach ( $criteria as $crit )
        {
            if ( $answers == null )
            {
                $answers = $crit->answers()->get();
            }
            else
            {
                $answers = $answers->merge($crit->answers()->get());
            }
        }
        return $answers ;

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


    public function getProgress()
    {
        $people = $this->people();
        if($people == null )
        {
            return 0;
        }
        else
        {
            $progress = 0;
            $total = $people->count();
            foreach ($people as $person)
            {
                if($person->completed == 1)
                {
                    $progress++;
                }
            }
            return round((($progress * 100) /( $total) ),2);
        }

    }
}
