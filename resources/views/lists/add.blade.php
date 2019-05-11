@extends('template')
@section('script','/js/criteria.js')
@section('title','Add List')

@section('content')

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
