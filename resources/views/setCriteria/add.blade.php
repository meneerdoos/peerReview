@extends('template')
@section('title','Add list review')

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
        <form method="post" data-parsley-validate="" action="/editCriteria/{{$criteria->peer_review_id}}">
            {!! csrf_field() !!}

            <div class="row">
                <div class="col-md-4"></div>
                <div class="form-group col-md-4">
                    <label for="title">Title:</label>
                    <input required="" type="text" class="form-control" name="title" value = "{{$criteria->title}}">
                </div>
            </div>
            <div class="row">
                <div class="col-md-4"></div>
                <div class="form-group col-md-4">
                    <label for="description">Description:</label>
                    <input required="" type="text" class="form-control" name="description" value = "{{$criteria->description}}">
                </div>
            </div>

            <div class="row">
                <div class="col-md-4"></div>
                <div class="form-group col-md-4">
                    <button type="submit" class="btn btn-success" style="margin-left:38px">edit Criteria </button>
                </div>
            </div>
        </form>

    </div>

@endsection('content')
