<?php

namespace App\Http\Controllers;

use App\Criteria;
use Illuminate\Http\Request;

class CriteriaController extends Controller
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

    public function add($id)
    {
        return view ('criteria.add', ['peerReviewId' => $id ]);
    }

    public function showEdit($id)
    {
        return view('criteria.edit',['criteria'=> Criteria::findorfail($id)]);
    }

    public function edit($id, Request $request){
        $criteria = Criteria::findorfail($id);
        $criteria->title = $request->title;
        $criteria->description = $request->description ;
        $criteria->save();
        $request->session()->flash('alert-success', 'criteria was successful edited!');
        $link = "/editPeerReview/". $criteria->peer_review_id;
        return redirect($link);
    }
    public function index()
    {
    }

    public function delete($id, Request $request)
    {
        $criteria = Criteria::findorfail($id);
        $id = $criteria -> peer_review_id ;
        $criteria->delete();
        $request->session()->flash('alert-success', 'Criteria was successful deleted!');
        $link = "/editPeerReview/". $id;
        return redirect($link);
    }

    public function save(Request $request)
    {
        $criteria = new Criteria();
        $criteria->title = $request->title ;
        $criteria->description = $request->description;
        $criteria->peer_review_id = $request->peerReviewId;
        $criteria->save();


        $request->session()->flash('alert-success', 'criteria was successful added!');
        $link = "/editPeerReview/". $criteria->peer_review_id;
        return redirect($link);
    }

}
