@extends('template')
@section('title','Edit peer review')

@section('content')

    <div class="container">
        <h2>Edit a new peer review </h2><br  />
        <form method="post" data-parsley-validate="" action="/editSetCriteria/{{$criteria->id}}">
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
