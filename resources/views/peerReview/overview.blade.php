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
    <h1> peer Review {{$peerReview->id}}</h1>

    @foreach( $peerReview->people() as $person )
    <h3>{{$person->firstName}}</h3>
    <p> Pa factor : {{$person->calculatePAfactor() }}</p>
    <p> Pa factorscore : {{ $person->calculatePAfactorscore() }}</p>
        <table class="table">
        <thead>
        <tr>
            <th> </th>

        @foreach($peerReview->people() as $pers )
                @if($person->id != $pers->id )
                    <th scope="col">{{$pers->firstName}} {{$pers->lastName}}</th>
                @endif
        @endforeach

        </tr>
        </thead>
        <tbody>
            @foreach($peerReview->criteria()->get() as $crit)
                <tr>
                    <td>{{$crit->title}}</td>
                    @foreach($peerReview->people() as $pers )
                        @if($person->id != $pers->id )
                            <td scope="col">
                                {{--{{dd($crit->answers()->where(['about_id' => $person->id])->where(['person_id' => $pers->id ]))}}--}}

                                @if( ($crit->answers()->where(['about_id' => $person->id])->where(['person_id' => $pers->id ])->first()) == null )
                                    x
                                @else
                                    {{$crit->answers()->where(['about_id' => $person->id])->where(['person_id' => $pers->id ])->first()->score}}
                                @endif
                            </td>
                        @endif
                    @endforeach

                </tr>
            @endforeach

        </tbody>
    </table>
    <a href="/addPeerReview" ><button type="button" class="btn btn-primary"> add </button></a>

        @endforeach
</div>
</body>
</html>