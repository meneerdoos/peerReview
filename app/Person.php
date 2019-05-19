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

    public function getGroupPeople()
    {
        return $this->group()->first()->people()->get();
    }

    public function getGroupPeopleF()
    {
        $personId = $this->id ;
        $peopleFiltered = $this->getGroupPeople()->filter(function($value) use ( $personId ){
            if ($value->id != $personId) {
                return true ;
            }
        })->values();
        return $peopleFiltered;
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
        //$amount = 0 ;

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

    public function calculatePAfactorscore()
    {
        // som waarderingen - hoogste - laagste / (aantal beoordelaars - 2 )

        $sums = $this->newCollection() ;
        $people = $this->getGroupPeopleF();
        $peerReview  = $this->peerReview()->first();

        $answers = $peerReview->answers();
        $answersF = $answers->where('about_id',$this->id);
        $aantal = $people->count();
        foreach( $people as $person)
        {
            $ans = $answersF->where('person_id',$person->id);
            $sum = $ans->sum('score');
            $sums->push($sum);
        }
        if($aantal == 0 )
        {
            return 'x' ;
        }

        //Als je met minder als 4 beoordelaars werkt ga je niet het minimum en maximum aftrekken
        if($aantal < 4)
        {
            $total = $sums->sum();
            $t = $total ;
            $n = $aantal ;
        }
        else
        {
            $min = $sums->min();
            $max = $sums->max();
            $total = $sums->sum();
            $t = $total -$min - $max ;
            $n = $aantal -2 ;
        }
            $results = ($t / $n );
            return round($results,2);
    }

    public function calculatePAfactor()
    {
        // Pa factorscore / ( aantal criteria * score gem prest )

        $peerReview = $this->peerReview();
        $PAfactor = $this->calculatePAfactorscore();
        if($PAfactor == 'x')
        {
            return 'x';
        }

        $Criteria = $peerReview->criteria();
        if($Criteria->count() == 0 )
        {
            return 'x';
        }
        else{
            $aantalCriteria = $Criteria->count();
            if($peerReview->answers()->count()==0){
                return 'x';
            }else{
                $average = 2;
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
