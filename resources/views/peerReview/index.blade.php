@extends('template')

@section('content')

    <div class="flash-message">
        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
            @if(Session::has('alert-' . $msg))

                <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="/peerReviews" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
            @endif
        @endforeach
    </div>
    <div class="container">

        <table class="table">
            <thead>
            <tr>
                <th scope="col">id</th>
                <th scope="col">Title</th>
                <th scope="col">state</th>
                <th scope="col">deadline</th>
                <th scope="col">edit</th>
                <th scope="col">delete</th>

            </tr>
            </thead>
            <tbody>


            @foreach( $peerReviews as $peerReview)
                <tr>
                    <th scope="row"> {{ $peerReview->id }} </th>
                    <td>{{ $peerReview-> title }}</td>
                    <td>{{ $peerReview->state }}</td>
                    <td>{{$peerReview->deadline }}</td>
                    <td><a href="/editPeerReview/{{ $peerReview->id }}" ><button type="button" class="btn btn-primary">edit</button></a> </td>
                    <td><form action="/deletePeerReview/{{ $peerReview->id }}" method="POST">
                            {{ csrf_field() }}

                            <button type="submit" class="btn btn-primary">delete</button>
                        </form> </td>
                </tr>
            @endforeach


            </tbody>
        </table>
        <a href="/stepOne" ><button type="button" class="btn btn-primary"> add </button></a>

    </div>
@endsection
