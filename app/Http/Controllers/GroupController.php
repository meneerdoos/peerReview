<?php

namespace App\Http\Controllers;

use App\Group;
use App\Person;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class GroupController extends Controller
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
        return view ('group.add', ['peerReviewId' => $id ]);
    }

    public function showEdit($id)
    {
        return view('group.edit',['group'=> Group::findorfail($id)]);
    }

    public function saveEdit($id, Request $request)
    {
        $group = Group::findorfail($id);
        $group->name = $request->name ;
        $group->description = $request->description ;
        $group-> save();
        $request->session()->flash('alert-success', 'Group was successful edited!');
        $link = "/editPeerReview/".$group->peer_review_id ;
        return redirect ($link);
    }

    public function showImportCsv($id)
    {
        return view('group.import',['groupId'=> $id ]);
    }

    public function save(Request $request){
        $group = new Group();
        $group-> name = $request->name ;
        $group-> description = $request->description ;
        $group -> peer_review_id = $request->peerReviewId ;
        $group->save();
        $request->session()->flash('alert-success', 'Group was successful created!');
        $link = "/editPeerReview/".$group->peer_review_id ;
        return redirect ($link);
    }

    public function saveImport($id, Request $request){
        $handle = fopen($request->file('csv'),'r') ;
        $header = true;
        $count = 0 ;
        dd($id);
        while ($csvLine = fgetcsv($handle, 1000, ",")) {
            if ($header) {
                $header = false;
            } else {
                $persoon = new Person();
                $persoon -> firstName = $csvLine[0];
                $persoon -> lastName = $csvLine[1];
                $persoon -> email = $csvLine[2];
                $persoon->group_id = $request->groupId ;
                $persoon->uniqueLink = '123';
                $persoon->save();
                $count ++;
            }
        }
        $request->session()->flash('alert-success', $count.'person added');
        $link = "/editPeerReview/". $id;
        return redirect($link);
    }

    public function edit($id, Request $request){

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

}