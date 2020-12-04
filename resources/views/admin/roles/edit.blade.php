@extends('layouts.admin')

@section('content')

<div class="pd-20 card-box mb-30">
    <div class="clearfix">
        <div class="pull-left mb-20">
            <h4 class="text-dark h4">Update Role</h4>
            
        </div>
        
    </div>
    <form class="form-horizontal"  action="{{ route('roles.update',$role) }}" method="POST">      
       @method('PUT')
       @csrf
        <div class="form-group row">
            <label class="col-sm-12 col-md-2 col-form-label">Role Name</label>
            <div class="col-sm-12 col-md-10">
                <input class="form-control" type="text" value="{{$role->name}}" name="name" placeholder="Name">
            </div>
        </div>
        
        <div class="form-group row">
            <label class="col-sm-12 col-md-2 col-form-label">Select Permissions</label>
            <div class="col-sm-12 col-md-10">
                <select class="custom-select2 form-control" name="permissions[]" multiple="multiple" style="width: 100%;">
                    <option value="admin" {{in_array("admin",explode(',',$role->permissions))?"selected":""}}>Admin</option>
                    <option value="delivery-boy" {{in_array("delivery-boy",explode(',',$role->permissions))?"selected":""}}>Delivery Boy</option>
                    <option value="user" {{in_array("user",explode(',',$role->permissions))?"selected":""}}>User</option>
                    <option value="seller" {{in_array("seller",explode(',',$role->permissions))?"selected":""}}>Seller</option>
                </select>
            </div>
        </div>

        <button class="btn btn-success" type="submit">Update</button>

    </form>
    
</div>

@stop

