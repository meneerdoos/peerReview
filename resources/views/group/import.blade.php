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
<form method="post" action="/editGroup/{{$groupId}}/saveImport" enctype="multipart/form-data" >
    {!! csrf_field() !!}

    <div class="row">
        <div class="col-md-4"></div>
        <div class="form-group col-md-4">
            <label for="title">select csv:</label>
            <input type="file" name="csv" >
        </div>
    </div>
    <input type="hidden" id="peerReviewId" name="groupId" value="{{$groupId}}">

    <div class="row">
        <div class="col-md-4"></div>
        <div class="form-group col-md-4">
            <button type="submit" class="btn btn-success" style="margin-left:38px"> Submit </button>
        </div>
    </div>
</form>


</body>
</html>