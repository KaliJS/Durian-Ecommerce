@extends('layouts.admin')

@section('content')

<div class="pd-20 card-box mb-30">
    <div class="clearfix">
        <div class="pull-left mb-20">
            <h4 class="text-dark h4">Create Role</h4>
            
        </div>
        
    </div>
    <form class="form-horizontal" action="{{route('roles.store')}}" method="POST">
        @csrf
        <div class="form-group row">
            <label class="col-sm-12 col-md-2 col-form-label">Role Name</label>
            <div class="col-sm-12 col-md-10">
                <input class="form-control" type="text" name="name" placeholder="Name">
            </div>
        </div>
        
        <div class="form-group row">
            <label class="col-sm-12 col-md-2 col-form-label">Select Permissions</label>
            <div class="col-sm-12 col-md-10">
                <select class="custom-select2 form-control" name="permissions[]" multiple="multiple" style="width: 100%;">
                    <option value="admin">Admin</option>
                    <option value="delivery-boy">Delivery Boy</option>
                    <option value="user">User</option>
                    <option value="seller">Seller</option>
                </select>
            </div>
        </div>

        <button class="btn btn-success" type="submit">Create</button>

    </form>
    
</div>

@stop

