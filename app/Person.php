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

    public function calculatePAfactor()
    {
        // som waarderingen - hoogste - laagste / (aantal beoordelaars - 2 )

        $peerReview = $this->peerReview();
        $aantalPersonen = $peerReview->people()->count();
        $somWaarderingen = $peerReview->answers()->where('about_id', $this->id )->sum('score');
        $aantal = $peerReview->answers()->where('about_id', $this->id )->count() ;
        $max = $peerReview->answers()->where('about_id', $this->id )->max('score');
        $min = $peerReview->answers()->where('about_id', $this->id )->min('score') ;
        $PAfactor = (($somWaarderingen - $max - $min)/($aantalPersonen-2)) ;
        return $PAfactor ;
    }

    public function calculatePAfactorscore()
    {
        // Pa factorscore / ( aantal criteria * score gem prest )

        $peerReview = $this->peerReview();
        $PAfactor = $this->calculatePAfactor();
        $aantalCriteria = $peerReview->criteria()->count();
        $average = $peerReview->answers()->average('score');

        $PAfactorscore = (($PAfactor)/($aantalCriteria*$average));

        return $PAfactorscore ;
    }
}
