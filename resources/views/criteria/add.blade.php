@extends('template')

@section('content')
<div class="container">
    <h2>Create a new criteria </h2><br  />
    <form  method="post" data-parsley-validate="" action="/addCriteria">
        {!! csrf_field() !!}
        <div class="row">
            <div class="col-md-4"></div>
            <div class="form-group col-md-4">
                <label for="title">Title:</label>
                <input required="" type="text" class="form-control" name="title">
            </div>
        </div>
        <div class="row">
            <div class="col-md-4"></div>
            <div class="form-group col-md-4">
                <label for="description">Description:</label>
                <input required="" type="text" class="form-control" name="description">
            </div>
        </div>
        <p>import set</p>
        <input type="checkbox" name="richting[]" value="ea">Elektronica-ICT</input>
        <input type="checkbox" name="richting[]" value="che">Chemie</input>
        <input type="checkbox" name="richting[]" value="me">Mechanica</input>
        <input type="checkbox" name="richting[]" value="bk">Bouwkunde</input>
        <input type="hidden" id="peerReviewId" name="peerReviewId" value="{{$peerReviewId}}">
        <div class="row">
            <div class="col-md-4"></div>
            <div class="form-group col-md-4">
                <button type="submit" class="btn btn-success" style="margin-left:38px">Create Criteria</button>
            </div>
        </div>
    </form>

</div>
@endsection('content')
