@extends('template')
@section('title',$peerReview->title)
@section('script','https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.bundle.js')
@section('content')

    <script>
        console.log("loaded");
        function show(person, criteria)
        {
            console.log(criteria);
            id = person.id ;
            tablename = "table" +person.id ;
            chartname = "chart" +person.id ;
            table = document.getElementById(tablename);
            chart = document.getElementById(chartname);
            console.log(table.style.display)
            if(table.style.display == "none" )
            {
                console.log(true);
                table.style.display = "block" ;
                chart.style.display = "block" ;


            }else
            {
                table.style.display = "none " ;
                chart.style.display = "none" ;

            }
            console.log("table shown");

        }

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
<div class="container">
    <button onclick="peerReviewGraphs({{$peerReview}})">load</button>
    @foreach( $peerReview->people() as $person )
        {{--{{dd($person->peerReview()->answers()->where(['about_id' => $person->id ]))}}--}}
        <a href="#" onclick="show( {{$person}} )"><h3><i class="fas fa-user"></i>{{$person->firstName}}</h3></a>
    {{--<p> Pa factor : {{$person->calculatePAfactor() }}</p>--}}
    {{--<p> Pa factorscore : {{ $person->calculatePAfactorscore() }}</p>--}}
        <table id="table{{$person->id}}" class="table" style="display: none">
        <thead>
        <tr>
            <th> </th>

        @foreach($peerReview->people() as $pers )
                @if($person->id != $pers->id )
                    <th scope="col">{{$pers->firstName}} {{$pers->lastName}}</th>
                @endif
        @endforeach

        </tr>
        </thead>
        <tbody>
            @foreach($peerReview->criteria()->get() as $crit)
                <tr>
                    <td>{{$crit->title}}</td>
                    @foreach($peerReview->people() as $pers )
                        @if($person->id != $pers->id )
                            <td scope="col">
                                {{--{{dd($crit->answers()->where(['about_id' => $person->id])->where(['person_id' => $pers->id ]))}}--}}

                                @if( ($crit->answers()->where(['about_id' => $person->id])->where(['person_id' => $pers->id ])->first()) == null )
                                    x
                                @else
                                    {{$crit->answers()->where(['about_id' => $person->id])->where(['person_id' => $pers->id ])->first()->score}}
                                @endif
                            </td>
                        @endif
                    @endforeach

                </tr>
            @endforeach

        </tbody>
    </table>
        <canvas id="chart{{$person->id}}" style="display: none" width="400" height="400"></canvas>

    @endforeach
</div>
</body>
</html>
    @endsection('content')