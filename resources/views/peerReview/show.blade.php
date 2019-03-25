<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title> </title>
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
<div class="container">
    <h2>Peer Review #{{$id}} </h2><br  />
    <form method="post" action="/completePeerReview/{{$id}}">
            {!! csrf_field() !!}
    @foreach($people as $person)
        <h1> {{ $person-> firstName }}</h1>
        @foreach( $criteria as $crit )
            <h3> {{$crit->title}}</h3>
            <p>{{$crit->description }}</p>
                <div class="row">
                    <div class="col-md-4"></div>
                    <div class="form-group col-md-4">
                        <label for="score">Score:</label>
                        <input type="text" class="form-control" name="score[]" value = " ">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4"></div>
                    <div class="form-group col-md-4">
                        <label for="comment">Comment:</label>
                        <input type="textarea" class="form-control" name="comment[]" value = " ">
                    </div>
                </div>

                <input type="hidden" id="about" name="about[]" value="{{$person->id}}">

                <input type="hidden" id="criteria" name="criteria[]" value="{{$crit->id}}">


            @endforeach
    @endforeach
        <input type="hidden" name="from" value="{{$from}}">

        <div class="row">
            <div class="col-md-4"></div>
            <div class="form-group col-md-4">
                <button type="submit" class="btn btn-success" style="margin-left:38px">Complete Peer Review </button>
            </div>
        </div>
    </form>
</div>

</body>
</html>