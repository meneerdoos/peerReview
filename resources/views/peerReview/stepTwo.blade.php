@extends('template')

@section('content')
    <script>
        console.log("loaded");
        function addFields () {
            var place = document.getElementById('newFields');
            place.innerHTML += ''+
                ' <div class="row">\n' +
                '                <div class="col-md-4"></div>\n' +
                '                <div class="form-group col-md-4">\n' +
                '                    <label for="title">Title:</label>\n' +
                '                    <input  type="text" class="form-control" name="title[]">\n' +
                '                </div>\n' +
                '            </div>\n' +
                '            <div class="row">\n' +
                '                <div class="col-md-4"></div>\n' +
                '                <div class="form-group col-md-4">\n' +
                '                    <label for="description">Description:</label>\n' +
                '                    <input  type="text" class="form-control" name="description[]">\n' +
                '                </div>\n' +
                '            </div>'
        }

    </script>

    <div class="container">
        <div class="container">
            <ul class="progressbar">
                <li class="active">Create a peer review</li>
                <li class="active" >Add criteria to the peer review </li>
                <li>Add students to the peer review  </li>
                <li>Notify students </li>
            </ul>
        </div>
        <br/>
        <form  method="post" data-parsley-validate="" action="/saveStepTwo">
            {!! csrf_field() !!}
            <div class="row">
                <div class="col-md-4"></div>
                <div class="form-group col-md-4">
                    <label for="title">Title:</label>
                    <input  type="text" class="form-control" name="title[]">
                </div>
            </div>
            <div class="row">
                <div class="col-md-4"></div>
                <div class="form-group col-md-4">
                    <label for="description">Description:</label>
                    <input  type="text" class="form-control" name="description[]">
                </div>
            </div>
            <div id="newFields">

            </div>
            <div class="row">
                <div class="col-md-4"></div>
                <div class="form-group col-md-4">
                    <button type="button" onclick="addFields()" class="btn btn-success" style="margin-left:38px"> + </button>
                </div>

            </div>
            <div class="row">


                <div class="col-md-4"></div>
                <div class="form-group col-md-4">
                    <label for="import">import set:</label>
                    @foreach(\App\Set::all() as $set )
                    <input type="checkbox" name="set[]" value="{{$set->id}}" > {{$set->name}} </input>
                    @endforeach

                    <input type="hidden" id="peerReviewId" name="peerReviewId" value="{{$peerReviewId}}">
                </div>


            </div>

            <input type="hidden" id="peerReviewId" name="peerReviewId" value="{{$peerReviewId}}">
            <div class="row">
                <div class="col-md-4"></div>
                <div class="form-group col-md-4">
                    <button type="submit" class="btn btn-success" style="margin-left:38px">Continue</button>
                </div>
            </div>
        </form>

    </div>
@endsection('content')
