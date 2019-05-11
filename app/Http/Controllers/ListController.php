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

    public function Delete($id, Request $request)
    {
        $list = Set::findorfail($id);
        $setCriteria = $list->setCriteria()->get();
        if(!empty($setCriteria))
        {
            foreach ( $setCriteria as $setCrit) {
                $setCrit->delete();
            }
        }

        $list->delete();
        $request->session()->flash('alert-success', 'List has been deleted');
        return redirect('/lists');

    }

    public function showEditSetCriteria($id)
    {
        $criteria = Setcriteria::findorfail($id);


        return view('setCriteria.show',['criteria'=> $criteria]);
    }

    public function editSetCriteria($id, Request $request)
    {
        $setCriteria = Setcriteria::findorfail($id);
        $setCriteria->title = $request->title ;
        $setCriteria->description = $request->description ;
        $setCriteria->save();

        $setid = $setCriteria->set()->first()->id;

        $link= '/editList/'.$setid ;
        $request->session()->flash('alert-success', 'criteria has been deleted');
        return redirect($link);
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
        $setCriteria = Setcriteria::findorfail($id);

        $setid = $setCriteria->set()->first()->id;

        $link= '/editList/'.$setid ;
        $request->session()->flash('alert-success', 'criteria has been deleted');
        return redirect($link);

    }

    public function Edit($id, Request $request)
    {
        $set = Set::findorfail($id);
        $set->name =  $request->name ;
        $set->description = $request->description ;
        $set->save();


        $request->session()->flash('alert-success', 'List was successfully edited!');
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
