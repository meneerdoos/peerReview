@extends('template')

@section('content')
    <div class="flash-message">
        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
            @if(Session::has('alert-' . $msg))

                <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="/peerReviews" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
            @endif
        @endforeach
    </div>
    <div class="container">
        <div class="row ">
        @if($sets->isempty() )
            <p>You have not created any lists yet. Start by selecting Peer reviews in the menu </p>
        @endif
        @foreach($sets as $set)
                <div class="col-md-4">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><a href="/editList/{{$set->id}}"><b>{{ $set->name }}</b></a></li>
                        @foreach($set->setCriteria()->get() as $criteria )
                            <li class="list-group-item">{{ $criteria->title }}</li>

                        @endforeach

                    </ul>
                </div>
        @endforeach
        </div>
        <div>
            <a href="/addList" ><button type="button" class="btn btn-primary"> add </button></a>

        </div>
    </div>
@endsection('content')
