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



    public function add()
    {
        return view ('lists.add');
    }

    public function showEdit($id)
    {
        $list = Set::findorfail($id);

        return view('lists.edit',['list'=> $list]);
    }

    public function showEditSetCriteria($id)
    {
        dd($id);
    }

    public function editSetCriteria($id, Request $request)
    {
        dd($id);
    }

    public function addSetCriteria()
    {
        dd('add');
    }

    public function saveSetCriteria(Request $request)
    {
        dd($request);
    }

    public  function deleteSetCriteria(Request $request,$id)
    {
        Setcriteria::destroy($id);

        $request->session()->flash('alert-success', 'Criteria was successfully deleted!');
        return redirect ('/lists');

    }

    public function Edit($id, Request $request)
    {
        $set = Set::findorfail($id);
        $set->name =  $request->name ;
        $set->description = $request->description ;
        $set->save();

        $group = Group::findorfail($id);
        $group->name = $request->name ;
        $group->description = $request->description ;
        $group-> save();
        $request->session()->flash('alert-success', 'Set was successfully edited!');
        return redirect ('/lists');
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
                    $setCriteria = new Setcriteria();
                    $setCriteria->title = $request->title[$count];
                    $setCriteria->description = $request->description[$count];
                    $setCriteria->set_id = $set->id ;
                    $setCriteria->save();
                    $setCriteria->id;
                    $count++;
            }

        }
        return redirect()->route("listsIndex");
    }
}
