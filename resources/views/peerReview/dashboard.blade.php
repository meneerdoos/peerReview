@extends('template')
@section('title','DASHBOARD')

@section('content')

    <div class="flash-message">
        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
            @if(Session::has('alert-' . $msg))

                <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="/" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
            @endif
        @endforeach
    </div>
<div class="container">
    @if($peerReviews->isempty() )
        <p>You have not created any peer reviews yet.  </p>
    @endif
    <div class="row">
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
                    <form action="/editPeerReview/{{$peerReview->id }}/notifyToComplete" method="post">
                        <button class="btn btn-info" type="submit" name="complete"  > Notify </button>
                    </form>
                </div>
        <hr>
                <div class="stats">
                    <i class="fa fa-clock-o"></i> {{$peerReview->created_at}}
                </div>
            </div>

        </div>
        </a>
    </div>
        @endforeach
    </div>
        <div class="row">
            <a href="/stepOne" ><button type="button" class="btn btn-primary"> add </button></a>
        </div>
</div>
    @endsection('content')
