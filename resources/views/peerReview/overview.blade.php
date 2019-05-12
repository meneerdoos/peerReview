@extends('template')
@section('title',$peerReview->title)
@section('script','https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.bundle.js')
@section('content')

    <script>
        console.log("loaded");
        function show(id, graphdata)
        {
            //display the table which is hidden
            id = id ;
            tablename = "table" +id ;
            chartname = "chart" +id ;
            table = document.getElementById(tablename);
            chart = document.getElementById(chartname);
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
            //display the graph per person
            peerReviewGraphs(graphdata, chartname );
        }

        function peerReviewGraphs(graphdata, chart){




            chart = "#"+chart;
            var ctx = $(chart);
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: Object.keys(graphdata),
                    datasets: [{
                        label: 'score ',
                        data: Object.values(graphdata),

                        borderWidth: 1,
                        backgroundColor: "rgba(64,224,208,1)"

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

    </script>
<div class="flash-message">
    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
        @if(Session::has('alert-' . $msg))

            <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="/peerReviews" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
        @endif
    @endforeach
</div>
<div class="container">
    @foreach($peerReview->groups()->get() as $group)
        {{--{{dd($group->getProgress())}}--}}
        <div class="col-md-8">
                <div class="card ">
                    <div class="card-header ">

                        <h4 class="card-title">{{$group->name}}</h4>
                        <p>total: {{$group->getTotalScore()}} average: {{$group->getAvg()}} average score: {{$group->getAvgScore()}}</p>
                    </div>
                    <div class="card-footer ">
                        <div class="legend">
                            <div class="progress">
                                <div class="progress-bar" role="progressbar" style="width: {{$group->getProgress()}}%;" aria-valuenow="{{$group->getProgress()}}" aria-valuemin="0" aria-valuemax="100">{{$group->getProgress()}}%</div>
                            </div>
                            <p><i class="fas fa-comment"></i> {{$group->description }}</p>
                        @foreach($group->people()->get() as $person)
                                <p> <a href="#" onclick="show(({{$person->id}}), {{$person->getGraphData()}}  )"><i class="fas fa-user"></i> {{$person->firstName}} </a>  @if($person->hasCompleted() )<i class="fas fa-check"></i> @else <i class="fas fa-times"></i> @endif </p>
                                <table id="table{{$person->id}}" class="table" style="display: none">
                                    <thead>
                                    <tr>
                                        <th> </th>

                                        @foreach($group->people()->get() as $pers )
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
                                            @foreach($group->people()->get() as $pers )
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
                                <canvas id="chart{{$person->id}}" style="display: none" ></canvas>
                                <p> PA Factor: {{$person->calculatePAfactor()}} PA Factorscore: {{$person->calculatePAFactorscore()}} total : {{$person->getTotalScore()}}  avg: {{$person->getAvgScore()}}</p>
                            @endforeach

                        </div>
                        <hr>

                    </div>

                </div>
        </div>
    @endforeach


</div>
</body>
</html>
    @endsection('content')
