<?php

namespace App\Http\Controllers;

use App\Answer;
use App\Group;
use App\Mail\NotifyToComplete;
use App\Peer_review;
use App\Person;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

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
        return view ('peerReview.index', ['peerReviews' => Peer_review::all()]);
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
        $peerReview->user_id = 1 ;
        $peerReview->description = $request->description ;
        $peerReview->state = 0 ;
        $peerReview->deadline = $request->deadline ;
        $peerReview->save();

        //create a group when creating a peer review
//        $group = new Group();
//        $group->peer_review_id = $peerReview->id ;
//        $group->save();

        $request->session()->flash('alert-success', 'Peer Review was successful added!');
        return redirect()->route("peerReviewIndex");
    }

    public function notify($id)
    {
        $peer_review = Peer_review::findorfail($id);
        $people = $peer_review->people();

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
        Mail::to($person)->send(new NotifyToComplete($token, $id));

    }

    public function show($id, $link)
    {
        $person = Person::where('token', $link)->first();
        $personId = $person->id;
        $peerReview = Peer_review::findorfail($id);
        $people = $peerReview->people();
        //ik ben hier dus uren mee bezig geweest en het lukt mij blijkbaar niet om één FUCKING item uit een FUCKING collection te gooien, FUCK YOU laravel

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


    public function complete( $id, Request $request)
    {
        //to iterate over all the person
        $i = 0;

        while( isset($request->score[ $i]))
        {
            $answer = new Answer();
            $answer-> person_id = $request->from;
            $answer->about_id = $request->about[$i];
            $answer->score = $request->score[$i];
            //$answer->comment = $request->comment[$i];
            //$answer->save();

            $i++;

        }

        //remove the token when the
        $persoon = Person::findorfail($request->from);
        $persoon->token = null ;
        //$persoon->save();

        return view('peerReview.complete');
    }


}