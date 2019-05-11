@extends('template')
@section('title','edit group')

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
    <form data-parsley-validate="" method="post" action="/editGroup/{{$group->id}}">
        {!! csrf_field() !!}

        <div class="row">
            <div class="col-md-4"></div>
            <div class="form-group col-md-4">
                <label for="title">Name:</label>
                <input required="" type="text" class="form-control" name="name" value = "{{$group->name}}">
            </div>
        </div>
        <div class="row">
            <div class="col-md-4"></div>
            <div class="form-group col-md-4">
                <label for="description">Description:</label>
                <input required="" type="text" class="form-control" name="description" value = "{{$group->description}}">
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

    </thead>
    @foreach($group->people()->get() as $person )
        <tr>
            <td>{{$person->id}}</td>
            <td>{{$person->firstName}}</td>
            <td>{{$person->lastName}}</td>
            <td>{{$person->email}}</td>

        </tr>
    @endforeach

</table>
</div>

@endsection('content')
