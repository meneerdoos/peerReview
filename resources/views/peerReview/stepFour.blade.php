@extends('template')
@section('title','STEP FOUR')

@section('content')
    <div class="container">
        <div class="container">
            <ul class="progressbar">
                <li class="active">Create a peer review</li>
                <li class="active">Add criteria</li>
                <li class="active">Add people </li>
                <li class="active">Notify people </li>
            </ul>
        </div>
        peer review completed

        click here to notify students to complete their peer review  or                     <a href="/"> return </a>

        <div class="row">
            <div class="col-4">

            </div>
            <div class="col-4">
                <form action="/saveStepFour/{{$peerReviewId }}" method="post">
                    {!! csrf_field() !!}

                    <button class="btn btn-info" type="submit" name="complete"  > Notify </button>
                </form>

            </div>
            <div class="col-4">

            </div>
        </div>

    </div>
@endsection('content')
