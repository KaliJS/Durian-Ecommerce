@extends('layouts.admin')

@section('content')

<div class="pd-20 card-box mb-30">
    <div class="clearfix">
        <div class="pull-left mb-20">
            <h4 class="text-dark h4">Create Promo Code</h4>
            
        </div>
        
    </div>
    <form class="form-horizontal" action="{{route('promo.store')}}" method="POST">
        @csrf
        <div class="form-group row">
            <label class="col-sm-12 col-md-2 col-form-label">Title</label>
            <div class="col-sm-12 col-md-10">
                <input class="form-control" type="text" value="{{Request::old('title')}}" name="title" placeholder="title" required>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-12 col-md-2 col-form-label">Start Date</label>
            <div class="col-sm-12 col-md-10">
                <input class="form-control" value="{{Request::old('start_date')}}" name="start_date" placeholder="Select Date" type="date" required>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-12 col-md-2 col-form-label">End Date</label>
            <div class="col-sm-12 col-md-10">
                <input class="form-control" value="{{Request::old('end_date')}}" name="end_date" placeholder="Select Date" type="date" required>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-12 col-md-2 col-form-label">Minimum Order Amount</label>
            <div class="col-sm-12 col-md-10">
                <input class="form-control" type="number" value="{{Request::old('minimum_order_amount')}}" name="minimum_order_amount" placeholder="Minimum Order Amount" required>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-12 col-md-2 col-form-label">Number Of Users</label>
            <div class="col-sm-12 col-md-10">
                <input class="form-control" type="number" value="{{Request::old('number_of_users')}}" name="number_of_users" placeholder="Number Of Users" required>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-12 col-md-2 col-form-label">Discount Type</label>
            <div class="col-sm-12 col-md-10">
                <select class="custom-select2 form-control" name="discount_type" style="width: 100%;" required>
                    <option selected disabled>Select</option> 
                    <option value="flat">Flat</option>
                    <option value="discount">Discount</option>                
                </select>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-12 col-md-2 col-form-label">Discount</label>
            <div class="col-sm-12 col-md-10">
                <input class="form-control" type="number" value="{{Request::old('discount')}}" name="discount" placeholder="Discount" required>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-12 col-md-2 col-form-label">Maximum Discount</label>
            <div class="col-sm-12 col-md-10">
                <input class="form-control" type="number" value="{{Request::old('max_discount')}}" name="max_discount" placeholder="Maximum Discount" required>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-12 col-md-2 col-form-label">Number Of Usages</label>
            <div class="col-sm-12 col-md-10">
                <input class="form-control" type="number" value="{{Request::old('number_of_usages')}}" name="number_of_usages" placeholder="Number Of Usages" required>
            </div>
        </div>

        <button class="btn btn-success" type="submit">Create</button>

    </form>
    
</div>

@stop

