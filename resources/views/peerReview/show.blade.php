<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title> </title>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
</head>
<body>
<script src="/js/jquery.3.2.1.min.js" type="text/javascript"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.9.0/parsley.js" type="text/javascript"></script>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
                 PEER REVIEW
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

</nav>
<div class="container">
    <h2>Peer Review #{{$id}} </h2><br  />
    <form data-parsley-validate="" method="post" action="/completePeerReview/{{$id}}">
            {!! csrf_field() !!}
    @foreach($people as $person)
        <h1 style="color: darkblue"> {{ $person-> firstName }}</h1>
        @foreach( $criteria as $crit )
            <h3 style="color: cornflowerblue;"> {{$crit->title}}</h3>
            <p>{{$crit->description }}</p>
                <div class="row">
                    <div class="col-md-4"></div>
                    <div class="form-group col-md-4">
                        <select required="" name="score[]">
                            <option value="-1">-1 was a hinderence for the group</option>
                            <option value="0">0 was of no help to the group</option>
                            <option value="1">1 performed slightly less than average</option>
                            <option selected value="2">2 Group average</option>
                            <option value="3">3 Performed better than the rest of the group</option>

                        </select>

                        {{--<input type="text" class="form-control" name="score[]" value = " ">--}}
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4"></div>
                    <div class="form-group col-md-4">
                        <i class="fas fa-pencil-alt prefix"></i>
                        <textarea  name="comment[]" class="md-textarea form-control" rows="3"></textarea>
                        <label for="comment">comment</label>
                        {{--<label for="comment">Comment:</label>--}}
                        {{--<input type="textarea" class="form-control" name="comment[]" value = " ">--}}
                    </div>
                </div>

                <input type="hidden" id="about" name="about[]" value="{{$person->id}}">

                <input type="hidden" id="criteria" name="criteria[]" value="{{$crit->id}}">


            @endforeach
    @endforeach
        <input type="hidden" name="from" value="{{$from}}">

        <div class="row">
            <div class="col-md-4"></div>
            <div class="form-group col-md-4">
                <button type="submit" class="btn btn-success" style="margin-left:38px">Complete Peer Review </button>
            </div>
        </div>
    </form>
</div>

</body>
</html>
