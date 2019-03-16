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
    <form method="post" action="/editGroup/{{$group->id}}">
        {!! csrf_field() !!}

        <div class="row">
            <div class="col-md-4"></div>
            <div class="form-group col-md-4">
                <label for="title">Name:</label>
                <input type="text" class="form-control" name="name" value = "{{$group->name}}">
            </div>
        </div>
        <div class="row">
            <div class="col-md-4"></div>
            <div class="form-group col-md-4">
                <label for="description">Description:</label>
                <input type="text" class="form-control" name="description" value = "{{$group->description}}">
            </div>
        </div>

        <div class="row">
            <div class="col-md-4"></div>
            <div class="form-group col-md-4">
                <button type="submit" class="btn btn-success" style="margin-left:38px">edit Group </button>
            </div>
        </div>

    </form>

        </tbody>

    <hr/>
<table class="table">
    <thead>
        <th scope="col">id</th>
        <th scope="col">first name</th>
        <th scope="col">last name </th>
        <th scope="col">email</th>
        <th scope="col"></th>
        <th scope="col"></th>
    </thead>
    @foreach($group->people()->get() as $person )
        <tr>
            <td>{{$person->id}}</td>
            <td>{{$person->firstName}}</td>
            <td>{{$person->lastName}}</td>
            <td>{{$person->email}}</td>
            <td> <a href=""> <button type="button" class="btn btn-success"> edit </button></a> </td>
            <td>
                <form>
                    {{csrf_field()}}
                    <button type="submit" class="btn btn-danger"> delete </button>
                </form>
            </td>
        </tr>
    @endforeach

</table>
<a href="/showImport/{{$group->id}}"><button type="button" class="btn btn-info"> Import csv </button></a>
</div>

</body>
</html>