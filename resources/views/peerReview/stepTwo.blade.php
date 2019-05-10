@extends('template')

@section('content')
    <script>

        var numberOfFields = 0 ;

        function deleteFields(id)
        {
            field = document.getElementById(id);

            field.remove();
        }
        function addFields () {
            numberOfFields ++ ;
            var place = document.getElementById('newFields');
            var html =  '   <div id=' +numberOfFields+ ' class="row ">\n' +
                '                <div class="form-group col-md-4">\n' +
                '                    <input  required="" type="text" class="form-control" name="title[]">\n' +
                '                </div>\n' +
                '                <div class="form-group col-md-4">\n' +
                '                    <input required="" type="text" class="form-control" name="description[]">\n' +
                '                </div>\n' +
                '                <div class="form-group col-md-4">\n' +
                '                    <a onclick="deleteFields('+numberOfFields+')" ><i class="fa fa-trash" aria-hidden="true"></i>\n  </a>\n' +
                '                </div>\n' +
                '\n' +
                '                \n' +
                '\n' +
                '\n' +
                '            </div>';

            var row = document.createElement('div');
            row.className= "row";
            row.innerHTML = html ;

                place.appendChild(row);

            // place.appendChild(t);

            // place.innerHTML += ''+
            //     ' <div class="row">\n' +
            //     '                <div class="col-md-4"></div>\n' +
            //     '                <div class="form-group col-md-4">\n' +
            //     '                    <label for="title">Title:</label>\n' +
            //     '                    <input  type="text" class="form-control" name="title[]">\n' +
            //     '                </div>\n' +
            //     '            </div>\n' +
            //     '            <div class="row">\n' +
            //     '                <div class="col-md-4"></div>\n' +
            //     '                <div class="form-group col-md-4">\n' +
            //     '                    <label for="description">Description:</label>\n' +
            //     '                    <input  value=" " type="text" class="form-control" name="description[]">\n' +
            //     '                </div>\n' +
            //     '            </div>'
        }

        function selecting(set)
        {

            for( counter=0 ; counter < set.length ; counter++ )
            {
                numberOfFields++;
                console.log(set[counter]);
                var place = document.getElementById('precriteria');
                var html =  '   <div id=' +numberOfFields+ ' class="row ">\n' +
                    '                <div class="form-group col-md-4">\n' +
                    '                    <input  required="" value="'+set[counter]['title']+'" type="text" class="form-control" name="title[]">\n' +
                    '                </div>\n' +
                    '                <div class="form-group col-md-4">\n' +
                    '                    <input  required="" value="'+set[counter]['description']+'" type="text" class="form-control" name="description[]">\n' +
                    '                </div>\n' +
                    '                <div class="form-group col-md-4">\n' +
                    '                    <a onclick="deleteFields('+numberOfFields+')" ><i class="fa fa-trash" aria-hidden="true"></i>\n  </a>\n' +
                    '                </div>\n' +
                    '\n' +
                    '                \n' +
                    '\n' +
                    '\n' +
                    '            </div>';

                var row = document.createElement('div');
                row.className= "row";
                row.innerHTML = html ;

                place.appendChild(row);


            }



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
                <div class="form-group col-md-4">
                    <label for="title">Title:</label>
                    <input required="" type="text" class="form-control" name="title[]">
                </div>
                <div class="form-group col-md-4">
                    <label for="description">Description:</label>
                    <input required="" type="text" class="form-control" name="description[]">
                </div>




            </div>
            <div id="newFields"></div>
            <div id="precriteria"></div>

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
                    <input type="checkbox" name="set[]" onchange=" selecting({{$set->getCriteriaAsArray()}}) " value="{{$set->id}}" > {{$set->name}} </input>
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
