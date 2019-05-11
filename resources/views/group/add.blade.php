@extends('template')
@section('title','Add group')

@section('content')
<div class="flash-message">
    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
        @if(Session::has('alert-' . $msg))

            <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="/peerReviews" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
        @endif
    @endforeach
</div>
<div class="container">
    <form data-parsley-validate="" method="post" action="/editPeerReview/{{$peerReviewId}}/addGroup" enctype="multipart/form-data" >
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


</div>
@endsection('content')
