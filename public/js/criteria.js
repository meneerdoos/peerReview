
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
}

function selecting(set)
{
    var place = document.getElementById('precriteria');

    for( counter=0 ; counter < set.length ; counter++ )
    {
        numberOfFields++;
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


