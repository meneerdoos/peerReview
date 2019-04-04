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
    <h2>Edit a new peer review </h2><br  />
    <form method="post" action="/editPeerReview/{{$peerReview->id}}">
        {!! csrf_field() !!}

        <div class="row">
            <div class="col-md-4"></div>
            <div class="form-group col-md-4">
                <label for="title">Title:</label>
                <input type="text" class="form-control" name="title" value = "{{$peerReview->title}}">
            </div>
        </div>
        <div class="row">
            <div class="col-md-4"></div>
            <div class="form-group col-md-4">
                <label for="description">Description:</label>
                <input type="text" class="form-control" name="description" value = "{{$peerReview->description}}">
            </div>
        </div>

        <div class="row">
            <div class="col-md-4"></div>
            <div class="form-group col-md-4">
                <label for="deadline">Deadline:</label>
                <input type="date" class="form-control" name="deadline" value = "{{$peerReview->deadline}}">
            </div>
        </div>

<div class="row">
    <div class="col-md-4"></div>
    <div class="form-group col-md-4">
        <button type="submit" class="btn btn-success" style="margin-left:38px">edit Peer Review</button>
    </div>
</div>
</form>

    <div class="col-md-6">
    <h1> criteria </h1>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">id</th>
            <th scope="col">Title</th>
            <th scope="col"></th>
            <th scope="col"></th>

        </tr>
        </thead>
        <tbody>
        @foreach( $peerReview->criteria()->get() as $crit)
            <tr>
                <td> {{ $crit->id }} </td>
                <td>{{ $crit-> title }}</td>
                <td><a href="/editCriteria/{{ $crit->id }}" ><button type="button" class="btn btn-primary">edit</button></a> </td>
                <td><form action="/deleteCriteria/{{ $crit->id }}" method="POST">
                        {{ csrf_field() }}

                        <button type="submit" class="btn btn-primary">delete</button>
                    </form> </td>
            </tr>
        @endforeach

        </tbody>
    </table>
    <a href="/addCriteria/{{$peerReview->id}}" ><button type="button" class="btn btn-primary"> add </button></a>
    </div>


    <div class="col-md-6">
    <h1> Groups </h1>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">id</th>
            <th scope="col">name</th>
            <th scope="col"></th>
            <th scope="col"></th>

        </tr>
        </thead>
        <tbody>
        @foreach( $peerReview->groups()->get() as $group )
            <tr>
                <td> {{$group-> id }} </td>
                <td>{{ $group-> name }}</td>
                <td><a href="/editGroup/{{$group->id}}" ><button type="button" class="btn btn-primary">edit</button></a> </td>
                <td><form action="/deleteGroup" method="POST">
                        {{ csrf_field() }}

                        <button type="submit" class="btn btn-primary">delete</button>
                    </form> </td>
            </tr>
        @endforeach

        </tbody>
    </table>
    <a href="/editPeerReview/{{$peerReview->id }}/addGroup" ><button type="button" class="btn btn-primary"> Add group </button></a>
    </div>
<form action="/editPeerReview/{{$peerReview->id }}/notifyToComplete" method="post">
    <input type="submit" name="complete" value="Notify" />
</form>
<a href="/overview/{{$peerReview->id}}" ><button type="button" class="btn btn-primary"> overview </button></a>


</div>
@endsection('content')