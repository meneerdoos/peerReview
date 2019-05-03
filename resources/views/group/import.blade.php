@extends('template')

@section('content')
<form data-parsley-validate="" method="post" action="/editGroup/{{$groupId}}/saveImport" enctype="multipart/form-data" >
    {!! csrf_field() !!}

    <div class="row">
        <div class="col-md-4"></div>
        <div class="form-group col-md-4">
            <label for="title">select csv:</label>
            <input required="" type="file" name="csv" >
        </div>
    </div>
    <input type="hidden" id="peerReviewId" name="groupId" value="{{$groupId}}">

    <div class="row">
        <div class="col-md-4"></div>
        <div class="form-group col-md-4">
            <button type="submit" class="btn btn-success" style="margin-left:38px"> Submit </button>
        </div>
    </div>
</form>

@endsection('content')
