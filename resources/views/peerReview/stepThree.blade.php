@extends('template')

@section('content')
    <div class="container">
        <ul class="progressbar">
            <li class="active">Create a peer review</li>
            <li class="active">Add criteria</li>
            <li class="active">Add people </li>
            <li >Notify people </li>
        </ul>
    </div>
    <form data-parsley-validate="" method="post" action="/saveStepThree" enctype="multipart/form-data" >
        {!! csrf_field() !!}

        <div class="row">
            <div class="col-md-4"></div>
            <div class="form-group col-md-4">
                <label for="title">select csv:</label>
                <input required="" type="file" name="csv" >
            </div>
        </div>
        <input type="hidden" id="peerReviewId" name="peerReviewId" value="{{$peerReviewId}}">


        <div class="row">
            <div class="col-md-4"></div>
            <div class="form-group col-md-4">
                <button type="submit" class="btn btn-success" style="margin-left:38px"> Submit </button>
            </div>
        </div>
    </form>

@endsection('content')
