@extends('layouts.admin')

@section('content')

<div class="pd-20 card-box mb-30">
    <div class="clearfix">
        <div class="pull-left mb-20">
            <h4 class="text-dark h4">Create Category</h4>
            
        </div>
        
    </div>
    <form class="form-horizontal" action="{{route('categories.store')}}" method="POST">
        @csrf
        <div class="form-group row">
            <label class="col-sm-12 col-md-2 col-form-label">Category Name</label>
            <div class="col-sm-12 col-md-10">
                <input class="form-control" type="text" name="name" placeholder="Name">
            </div>
        </div>
        
        <div class="form-group row">
            <label class="col-sm-12 col-md-2 col-form-label">Description</label>
            <div class="col-sm-12 col-md-10 html-editor">
                <textarea rows="2" name="description" class="textarea_editor form-control border-radius-0"></textarea>
            </div>
        </div>

        <button class="btn btn-success" type="submit">Create</button>

    </form>
    
</div>

@stop

