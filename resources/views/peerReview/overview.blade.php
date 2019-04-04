@extends('template')
@section('title',$peerReview->title)
@section('script','https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.bundle.js')
@section('content')

    <script>
        console.log("loaded");
        function peerReviewGraphs(peerReview){
            console.log(peerReview);
            var ctx = $('#myChart');
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
                    datasets: [{
                        label: '# of Votes',
                        data: [12, 19, 3, 5, 2, 3],
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive:false ,
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                }
            });
        }
        function personGraphs()
        {

        }
    </script>
<div class="flash-message">
    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
        @if(Session::has('alert-' . $msg))

            <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="/peerReviews" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
        @endif
    @endforeach
</div>
    <canvas id="myChart" width="400" height="400"></canvas>
<div class="container">
    <button onclick="peerReviewGraphs({{$peerReview}})">load</button>
    @foreach( $peerReview->people() as $person )
    {{--<h3>{{$person->firstName}}</h3>--}}
    {{--<p> Pa factor : {{$person->calculatePAfactor() }}</p>--}}
    {{--<p> Pa factorscore : {{ $person->calculatePAfactorscore() }}</p>--}}
        {{--<table class="table">--}}
        {{--<thead>--}}
        {{--<tr>--}}
            {{--<th> </th>--}}

        {{--@foreach($peerReview->people() as $pers )--}}
                {{--@if($person->id != $pers->id )--}}
                    {{--<th scope="col">{{$pers->firstName}} {{$pers->lastName}}</th>--}}
                {{--@endif--}}
        {{--@endforeach--}}

        {{--</tr>--}}
        {{--</thead>--}}
        {{--<tbody>--}}
            {{--@foreach($peerReview->criteria()->get() as $crit)--}}
                {{--<tr>--}}
                    {{--<td>{{$crit->title}}</td>--}}
                    {{--@foreach($peerReview->people() as $pers )--}}
                        {{--@if($person->id != $pers->id )--}}
                            {{--<td scope="col">--}}
                                {{--{{dd($crit->answers()->where(['about_id' => $person->id])->where(['person_id' => $pers->id ]))}}--}}

                                {{--@if( ($crit->answers()->where(['about_id' => $person->id])->where(['person_id' => $pers->id ])->first()) == null )--}}
                                    {{--x--}}
                                {{--@else--}}
                                    {{--{{$crit->answers()->where(['about_id' => $person->id])->where(['person_id' => $pers->id ])->first()->score}}--}}
                                {{--@endif--}}
                            {{--</td>--}}
                        {{--@endif--}}
                    {{--@endforeach--}}

                {{--</tr>--}}
            {{--@endforeach--}}

        {{--</tbody>--}}
    {{--</table>--}}

        @endforeach
</div>
</body>
</html>
    @endsection('content')