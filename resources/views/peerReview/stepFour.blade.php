@extends('template')

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

        click here to notify students to complete their peer review .
        <form action="/saveStepFour/{{$peerReviewId }}" method="post">
            <button class="btn btn-info" type="submit" name="complete"  > Notify </button>
        </form>
    </div>
@endsection('content')
