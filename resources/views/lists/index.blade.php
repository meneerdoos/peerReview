@extends('template')
@section('title','Criteria lists')

@section('content')
    <div class="flash-message">
        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
            @if(Session::has('alert-' . $msg))

                <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="/lists" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
            @endif
        @endforeach
    </div>
    <div class="container">
        <div class="row ">
        @if($sets->isempty() )
            <p>You have not created any lists yet.  </p>
        @endif
        @foreach($sets as $set)
                <div class="col-md-4">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><a href="/editList/{{$set->id}}"><b>{{ $set->name }}</b></a></li>
                        @foreach($set->setCriteria()->get() as $criteria )
                            <li class="list-group-item">{{ $criteria->title }}</li>

                        @endforeach
                        <li class="list-group-item">  <form action="/deleteList/{{$set->id }}" method="post">
                                <button class="btn btn-info" type="submit" name="complete"  > Delete </button>
                            </form></li>


                    </ul>
                </div>
        @endforeach
        </div>
        <div>
            <a href="/addList" ><button type="button" class="btn btn-primary"> add </button></a>

        </div>
    </div>
@endsection('content')
