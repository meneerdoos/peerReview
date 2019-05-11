@extends('template')
@section('title','Edit List')

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
        <form data-parsley-validate="" method="post" action="/editList/{{$list->id}}">
            {!! csrf_field() !!}

            <div class="row">
                <div class="col-md-4"></div>
                <div class="form-group col-md-4">
                    <label for="title">Title:</label>
                    <input required="" type="text" class="form-control" name="name" value = "{{$list->name}}">
                </div>
            </div>
            <div class="row">
                <div class="col-md-4"></div>
                <div class="form-group col-md-4">
                    <label for="description">Description:</label>
                    <input required="" type="text" class="form-control" name="description" value = "{{$list->description}}">
                </div>
            </div>

            <div class="row">
                <div class="col-md-4"></div>
                <div class="form-group col-md-4">
                    <button type="submit" class="btn btn-success" style="margin-left:38px">edit List</button>
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
                @foreach( $list->setCriteria()->get() as $crit)
                    <tr>
                        <td> {{ $crit->id }} </td>
                        <td>{{ $crit-> title }}</td>
                        <td><a href="/editSetCriteria/{{ $crit->id }}" ><button type="button" class="btn btn-primary">edit</button></a> </td>
                        <td><form action="/deleteSetCriteria/{{ $crit->id }}" method="POST">
                                {{ csrf_field() }}

                                <button type="submit" class="btn btn-primary">delete</button>
                            </form> </td>
                    </tr>
                @endforeach

                </tbody>
            </table>
            <a href="/addSetCriteria/{{$list->id}}" ><button type="button" class="btn btn-primary"> add </button></a>
        </div>

    </div>
@endsection('content')
