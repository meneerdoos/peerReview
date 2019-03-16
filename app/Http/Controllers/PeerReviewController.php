<?php

namespace App\Http\Controllers;

use App\Group;
use App\Peer_review;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PeerReviewController extends Controller
{
    /**
     * Show the profile for the given user.
     *
     * @param  int $id
     * @return View
     */
    public function show($id)
    {
        return view('user.profile', ['user' => User::findorfail($id)]);
    }

    public function addPeerReview()
    {
        return view ('peerReview.add');
    }

    public function showEditPeerReview($id)
    {
        $peerReview = Peer_review::findorfail($id);
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

}