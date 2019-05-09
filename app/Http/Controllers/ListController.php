<?php

namespace App\Http\Controllers;

use App\Set;
use App\Setcriteria;
use Illuminate\Http\Request;

class ListController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $sets = Set::all();

        return view('lists.index',['sets' => $sets ]);
    }

    public function show($id)
    {
        return view('user.profile', ['user' => User::findorfail($id)]);
    }

    public function add()
    {
        return view ('lists.add');
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

    public function save(Request $request)
    {
        $count = 0;
        $set = new Set();
        $set->name = $request->name ;
        $set->description = $request->listDescription;
        $set->save() ;
        foreach ($request->title as $tit )
        {
            if( !empty($tit))
            {
                if( (!empty($request->title[$count])) & (!empty($request->description[$count]))) {
                    $setCriteria = new Setcriteria();
                    $setCriteria->title = $request->title[$count];
                    $setCriteria->description = $request->description[$count];
                    $setCriteria->set_id = $set->id ;
                    $setCriteria->save();
                    $setCriteria->id;
                    $count++;
                }

            }

        }
        return redirect()->route("listsIndex");
    }
}
