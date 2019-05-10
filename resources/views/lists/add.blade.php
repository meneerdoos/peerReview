@extends('template')

@section('content')
    <script>
        console.log("loaded");
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
                '<div class="row"> '+
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

    </script>
    <div class="container">
        <form method="post" data-parsley-validate="" action="/saveList">
            {!! csrf_field() !!}
            <h4>
                List
            </h4>
            <div class="row">
                <div class="col-md-4"></div>
                <div class="form-group col-md-4">
                    <label for="title">Name:</label>
                    <input required="" type="text" class="form-control" name="name" >
                </div>
            </div>
            <div class="row">
                <div class="col-md-4"></div>
                <div class="form-group col-md-4">
                    <label for="description">Description:</label>
                    <input required="" type="text" class="form-control" name="listDescription" >
                </div>
            </div>
            <h4>
                Criteria
            </h4>
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

                <div class="row">
                    <div class="col-md-4"></div>
                    <div class="form-group col-md-4">
                        <button type="button" onclick="addFields()" class="btn btn-success" style="margin-left:38px"> + </button>
                    </div>

                </div>
            <div class="row">
                <div class="col-md-4"></div>
                <div class="form-group col-md-4">
                    <button type="submit" class="btn btn-success" style="margin-left:38px">Create List </button>
                </div>
            </div>

        </form>


    </div>
@endsection('content')
