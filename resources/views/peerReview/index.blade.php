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

<table class="table">
    <thead>
    <tr>
        <th scope="col">id</th>
        <th scope="col">Title</th>
        <th scope="col">state</th>
        <th scope="col">deadline</th>
        <th scope="col">edit</th>
        <th scope="col">delete</th>

    </tr>
    </thead>
    <tbody>
    @foreach( $peerReviews as $peerReview)
        <tr>
            <th scope="row"> {{ $peerReview->id }} </th>
            <td>{{ $peerReview-> title }}</td>
            <td>{{ $peerReview->state }}</td>
            <td>{{$peerReview->deadline }}</td>
            <td><a href="/editPeerReview/{{ $peerReview->id }}" ><button type="button" class="btn btn-primary">edit</button></a> </td>
            <td><form action="/deletePeerReview/{{ $peerReview->id }}" method="POST">
                    {{ csrf_field() }}

                <button type="submit" class="btn btn-primary">delete</button>
                </form> </td>
        </tr>
    @endforeach


    </tbody>
</table>
    <a href="/addPeerReview" ><button type="button" class="btn btn-primary"> add </button></a>

</div>
</body>
</html>