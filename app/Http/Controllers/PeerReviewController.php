<?php

namespace App\Http\Controllers;

use App\Answer;
use App\Group;
use App\Criteria;
use App\Mail\NotifyToComplete;
use App\Peer_review;
use App\Person;
use App\Set;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use PhpParser\Node\Expr\Array_;

class PeerReviewController extends Controller
{
    /**
     * Show the profile for the given user.
     *
     * @param  int $id
     * @return View
     */


    public function addPeerReview()
    {
        return view ('peerReview.add');
    }

    public function dashboard()
    {
        $peerReviews = Auth::user()->peerReview()->get();
        return view('peerReview.dashboard',['peerReviews'=> $peerReviews ]);


    }

    public function showEditPeerReview($id)
    {
        $peerReview = Peer_review::findorfail($id);

        //dd($peerReview);
        return view('peerReview.edit',['peerReview'=> $peerReview ]);
    }

    public function editPeerReview($id, Request $request){
        $peerReview = Peer_review::findorfail($id);
        $peerReview->title = $request->title ;
        $peerReview->description = $request->description;
        $peerReview->deadline = $request->deadline;
        $peerReview->save();
        $request->session()->flash('alert-success', 'Peer Review was successful edited!');
        return redirect()->route("peerReviewIndex");
    }
    public function index()
    {
        $peerReviews = Auth::user()->peerReview()->get();
        return view ('peerReview.index2', ['peerReviews' => $peerReviews ]);
    }

    public function deletePeerReview($id, Request $request)
    {
        Peer_review::destroy($id);

        $request->session()->flash('alert-success', 'Peer Review was successful deleted!');
        return redirect()->route("peerReviewIndex");
    }

    public function savePeerReview(Request $request)
    {
        $peerReview = new Peer_review();
        $peerReview->title = $request->title ;
        $peerReview->user_id =  Auth::user()->id;
        $peerReview->description = $request->description ;
        $peerReview->deadline = $request->deadline ;
        $peerReview->save();

        return $peerReview->id  ;
    }

    public function notify($id, Request $request)
    {
        $peer_review = Peer_review::findorfail($id);
        $people = $peer_review->people();
        $date = $peer_review->deadline;

        foreach ($people as $person )
        {
            $token = str_random(10);
            while (Person::where('token', $token)->first())
            {
                $token = str_random(10);
            }
            $person->token = $token ;
            $person->save();

            //Mail part is commented out because it sends error 505 too many per s
            //Has a hard limit of 3 mails per second , upgrade or get another

            //Mail::to($person)->send(new NotifyToComplete($token, $id));
        }
        Mail::to($person)->send(new NotifyToComplete($token, $id,$date));
        $request->session()->flash('alert-success', 'A Notify has been sent');
        return redirect()->route("peerReviewIndex");
    }

    public function show($id, $link)
    {
        $person = Person::where('token', $link)->first();
        $personId = $person->id;
        $peerReview = Peer_review::findorfail($id);
        $people = $peerReview->people();

        $peopleFiltered = $people->filter(function($value) use ( $personId ){
            if ($value->id != $personId) {
                return true ;
            }
        })->values();



        $criteria = $peerReview->criteria()->get();

//        $c = $c->filter(function($item) {
//            return $item->id != 2;
//        });

        return view ('peerReview.show', ['id'=> $id, 'from'=> $personId , 'criteria' => $criteria, 'people' => $peopleFiltered ]);

    }

    public function showStepOne()
    {
        return view ('peerReview.stepOne');
    }

    public function saveStepOne(Request $request)
    {
        $peerReviewId = $this->savePeerReview($request);
        return redirect()->route("showStepTwo",['id' => $peerReviewId ]);

    }


    public function showStepTwo($id)
    {
           return view ('peerReview.stepTwo ',['peerReviewId' => $id ]);
    }

    public function saveStepTwo(Request $request)
    {
        $count = 0 ;
        $sets = $request->set;
        if ($sets !== null )
        {
            foreach( $sets as $set)
            {
                $s = Set::findorfail($set);
                $criteria = $s->setCriteria()->get();
                foreach ($criteria as $crit )
                {
                    $c = new Criteria();
                    $c->title = $crit->title ;
                    $c->description = $crit->description ;
                    $c->peer_review_id = $request->peerReviewId;
                    $c->save();
                }
            }
        }

        if( !empty($request->title) )
        {
            foreach ($request->title as $name)
            {
                if (!empty($name))
                {
                    $criteria = new Criteria();
                    $criteria->title = $request->title[$count];
                    $criteria->description = $request->description[$count];
                    $criteria->peer_review_id = $request->peerReviewId ;
                    $criteria->save();
                    $count ++ ;
                }


            }
        }

        return redirect()->route("showStepThree", ['peerReviewId' => $request->peerReviewId ]);
    }

    public function showStepThree($id)
    {
        return view ( 'peerReview.stepThree', ['peerReviewId' => $id ]);
    }
    public function saveStepThree(Request $request)
    {
        $handle = fopen($request->file('csv'),'r') ;
        $header = true;
        $count = 0 ;
        $groups =[];
        while ($csvLine = fgetcsv($handle, 1000, ",")) {
            if ($header) {
                $header = false;
            } else {
                if(!array_key_exists($csvLine[3],$groups))
                {
                    $group = new Group();
                    $group-> name = "group".$csvLine[3] ;
                    $group-> description = "group description" ;
                    $group -> peer_review_id = $request->peerReviewId ;
                    $group->save();
                    $groups[$csvLine[3]]=$group->id;

                    $persoon = new Person();
                    $persoon -> firstName = $csvLine[0];
                    $persoon -> lastName = $csvLine[1];
                    $persoon -> email = $csvLine[2];
                    $persoon->group_id = $group->id ;
                    $persoon->uniqueLink = null;
                    $persoon->completed = 0 ;
                    $persoon->save();
                    $count ++;

                }
                else{
                    $persoon = new Person();
                    $persoon -> firstName = $csvLine[0];
                    $persoon -> lastName = $csvLine[1];
                    $persoon -> email = $csvLine[2];
                    $persoon->group_id = $groups[$csvLine[3]] ;
                    $persoon->uniqueLink = null;
                    $persoon->completed = 0 ;
                    $persoon->save();
                    $count ++;
                }
            }
        }

        return redirect()->route("showStepFour", ['peerReviewId' => $request->peerReviewId ]);
    }

    public function showStepFour($id)
    {
        return view ( 'peerReview.stepFour', ['peerReviewId' => $id ]);
    }

    public function saveStepFour($id)
    {
        $peer_review = Peer_review::findorfail($id);
        $people = $peer_review->people();
        $date = $peer_review->deadline;

        foreach ($people as $person )
        {
            $token = str_random(10);
            while (Person::where('token', $token)->first())
            {
                $token = str_random(10);
            }
            $person->token = $token ;
            $person->save();

            //Mail part is commented out because it sends error 505 too many per s
            //Has a hard limit of 3 mails per second , upgrade or get another

            //Mail::to($person)->send(new NotifyToComplete($token, $id));
        }
        Mail::to($person)->send(new NotifyToComplete($token, $id, $date));
        return redirect()->route("dashboard");
    }


    public function complete( $id, Request $request)
    {
        dd($request);
        //to iterate over all the person
        $i = 0;

        while( isset($request->score[ $i]))
        {
            $answer = new Answer();
            $answer-> person_id = $request->from;
            $answer->about_id = $request->about[$i];
            $answer->score = $request->score[$i];
            $answer->comment = $request->comment[$i];
            $answer->criteria_id = $request->criteria[$i];
            $answer->save();

            $i++;

        }

        //remove the token when the
        $persoon = Person::findorfail($request->from);
        $persoon->completed = 1 ;
        $persoon->token = null ;
        $persoon->save();

        return view('peerReview.complete');
    }

    public function overview($id)
    {
        $peerReview = Peer_review::findorfail($id);
        return view('peerReview.overview',['peerReview' => $peerReview ]);

    }
}
