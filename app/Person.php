<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Person extends Model
{

    protected $table = "person";

    public function group()
    {
        return $this->belongsTo('App\Group','group_id','id');

    }

    public function peerReview()
    {
        $group = $this->group()->first();
        $peerReview = $group->peerReview()->first();
        return $peerReview ;

    }

    public function getGraphData()
    {
        $peerReview = $this->peerReview();
        $answers = $peerReview ->answers()->where('about_id', $this->id );
        $data = [] ;
        $amount = 0 ;

        foreach( $answers as $answer ) {
            $amount = 0;
            $count = 0;
            $criteria = Criteria::findorfail($answer->criteria_id);
            $criteriaName = $criteria->title;
            if (!array_key_exists($criteriaName, $data)) {
                $criterias = $answers->where('criteria_id', $criteria->id);
                foreach ($criterias as $criteria) {
                    $count++;
                    $amount += $criteria->score;
                }
                $data[$criteriaName] = round((($amount) / $count ), 2);
            }

        }

        return json_encode($data) ;
    }

    public function calculatePAfactor()
    {
        // som waarderingen - hoogste - laagste / (aantal beoordelaars - 2 )

        $peerReview = $this->peerReview();
        $aantalPersonen = $peerReview->people()->count();
        if($aantalPersonen == null ){
            return 0;
        }else{
            $answers = $peerReview->answers()->where('about_id', $this->id );
            if($answers == null )
            {
                return 0;
            }
            else{
                $somWaarderingen = $peerReview->answers()->where('about_id', $this->id )->sum('score');
//              $aantal = $peerReview->answers()->where('about_id', $this->id )->count() ;
                $max = $peerReview->answers()->where('about_id', $this->id )->max('score');
                $min = $peerReview->answers()->where('about_id', $this->id )->min('score') ;
                $PAfactor = (($somWaarderingen - $max - $min)/($aantalPersonen-2)) ;
                return round($PAfactor,2) ;
            }

        }


    }

    public function calculatePAfactorscore()
    {
        // Pa factorscore / ( aantal criteria * score gem prest )

        $peerReview = $this->peerReview();
        $PAfactor = $this->calculatePAfactor();

        $Criteria = $peerReview->criteria();
        if($Criteria->count() == 0 )
        {
            return 0;
        }
        else{
            $aantalCriteria = $Criteria->count();
            if($peerReview->answers()->count()==0){
                return 0;
            }else{
                $average = $peerReview->answers()->average('score');
                $PAfactorscore = (($PAfactor)/($aantalCriteria*$average));
                return round($PAfactorscore,2) ;
            }

        }


    }

    public function hasCompleted()
    {
        if($this->completed )
        {
            return 1;
        }else
            {
                return 0;
            }
    }

    public function getAvgScore()
    {
        //return 4 ;
        $answers = $this->peerReview()->answers()->where('about_id', $this->id) ;
        if ($answers->count() == 0)
        {
            return 0;
        }else{
            $totaal = 0 ;
            foreach ($answers as $answer)
            {
                $totaal += $answer->score ;
            }
            $aantal = $answers->count();
            $avg = ($totaal)/($aantal);

            return round($avg,2) ;
        }

    }

    public function getTotalScore()
    {
        //return 2 ;
        $answers = $this->peerReview()->answers()->where('about_id', $this->id) ;
        if($answers == null )
        {
            return 0;
        }else{
            $totaal = 0 ;
            foreach ($answers as $answer)
            {
                $totaal += $answer->score ;
            }

            return round($totaal,2) ;
        }
    }
}
