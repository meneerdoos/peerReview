@extends('template')

@section('content')

    <div class="container">
        <div class="container">
            <ul class="progressbar">
                <li class="active">Create a peer review</li>
                <li >Add criteria</li>
                <li>Add people </li>
                <li>Notify people </li>
            </ul>
        </div>
        <br/>
        <form data-parsley-validate="" method="post" action="/saveStepOne">
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

            <div class="row">
                <div class="col-md-4"></div>
                <div class="form-group col-md-4">
                    <label for="deadline">Deadline:</label>
                    <input required="" type="date" class="form-control" name="deadline">
                </div>
            </div>

            <div class="row">
                <div class="col-md-4"></div>
                <div class="form-group col-md-4">
                    <button type="submit" class="btn btn-success" style="margin-left:38px">Create Peer Review</button>
                </div>
            </div>
        </form>

    </div>

@endsection('content')
