<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laravel 5.5 CRUD Tutorial With Example From Scratch </title>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="/"> Projec </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav">
            <li class="nav-item active">
                <a class="nav-link" href="/peerReviews "> Peer Reviews </a>
            </li>
        </ul>
    </div>
</nav>
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

</div>
</br>

</body>
</html>