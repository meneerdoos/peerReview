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
    <h2>Create a new peer review </h2><br  />
    <form method="post" action="/addPeerReview">
        {!! csrf_field() !!}
        <div class="row">
            <div class="col-md-4"></div>
            <div class="form-group col-md-4">
                <label for="title">Title:</label>
                <input type="text" class="form-control" name="title">
            </div>
        </div>
        <div class="row">
            <div class="col-md-4"></div>
            <div class="form-group col-md-4">
                <label for="description">Description:</label>
                <input type="text" class="form-control" name="description">
            </div>
        </div>

        <div class="row">
            <div class="col-md-4"></div>
            <div class="form-group col-md-4">
                <label for="deadline">Deadline:</label>
                <input type="date" class="form-control" name="deadline">
            </div>
        </div>
</div>
<div class="row">
    <div class="col-md-4"></div>
    <div class="form-group col-md-4">
        <button type="submit" class="btn btn-success" style="margin-left:38px">Create Peer Review</button>
    </div>
</div>
</form>

</div>

</body>
</html>