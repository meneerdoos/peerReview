<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $table = "group";

    public function peerReview()
    {
        return $this->belongsTo('App\Peer_review','peer_review_id','id');
    }

    public function people()
    {
        return $this->hasMany('App\Person','group_id','id');

    }

    public function getAvgScore()
    {
        $people = $this->people()->get();
        if($people == null )
        {
            return 0;
        }else{
            $count = $people->count();
            $total = 0 ;
            foreach ( $this->people()->get() as $person)
            {
                $total += $person->getAvgScore();
            }
            if($count==0)
            {
                $avg = 0 ;
            }
            else{
                $avg = ($total / $count ) ;

            }

            return $avg ;
        }


    }

    public function getAvg()
    {
        $people = $this->people()->get();
        if($people == null )
        {
            return 0;
        }else {
            $count = $people->count();
            $total = 0;
            foreach ($this->people()->get() as $person) {
                $total += $person->getTotalScore();
            }
            if($count==0)
            {
                $avg = 0 ;
            }
            else{
                $avg = ($total / $count);

            }

            return round($avg, 2);
        }
    }

    public function getTotalScore()
    {
        $total = 0 ;
        $people = $this->people()->get();
        if($people == null )
        {
            return 0;
        }
        else {
            foreach ($people as $person) {
                $total += $person->getTotalScore();
            }
            return round($total, 2);
        }
    }

    public function getProgress()
    {

        $people = $this->people()->get();
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
