@extends('template')
@section('content')
<div class="container">
    @foreach($peerReviews as $peerReview)
    <div class="col-md-4">
        <a href="/overview/{{$peerReview->id}}">
<div class="card ">
    <div class="card-header ">

        <h4 class="card-title">{{$peerReview->title}}</h4>
    </div>

    <div class="card-footer ">
        <div class="legend">
            <div class="progress">
                <div class="progress-bar" role="progressbar" style="width: {{$peerReview->getProgress()}}%;" aria-valuenow="{{$peerReview->getProgress()}}" aria-valuemin="0" aria-valuemax="100">{{$peerReview->getProgress()}}%</div>
            </div>
            <p><i class="fas fa-key"></i> {{$peerReview->id}}</p>
            <p><i class="fas fa-user"></i> @if($peerReview->people() == null )0 @else {{$peerReview->people()->count()}} @endif</p>
            <p><i class="fas fa-comment"></i>  @if($peerReview->criteria() == null )0 @else {{$peerReview->criteria()->count()}} @endif</p>
            <p><i class="fas fa-calendar"></i> {{$peerReview->deadline}}</p>
        </div>
        <hr>
        <div class="stats">
            <i class="fa fa-clock-o"></i> {{$peerReview->created_at}}
        </div>
    </div>
</div>
    </div>
    </a>
        @endforeach
</div>
    @endsection('content')