@extends('layouts.admin')

@section('content')

<!-- Simple Datatable start -->
   <div class="card-box mb-30">
      <div class="pd-20">
         <h4 class="text-dark h4">No Delivery Slots</h4>
         <a class="btn btn-info text-white" data-toggle="modal" data-target="#noDeliveryModal">Add New Slot</a>
      </div>
      <div class="pb-20">
         <table class="table stripe hover nowrap">
            <thead>
               <tr>
                  <th>Date</th>
                  <th>Start Time</th>
                  <th>End Time</th>
                  <th>Action</th>
               </tr>
            </thead>
            <tbody>

               @foreach($no_delivery_dates as $date)
               <tr>
                  <td>{{$date->date}}</td>
                  <td>{{$date->start_time}}</td>
                  <td>{{$date->end_time}}</td>
                  <td>
                    <form method="post" action="{{url('/admin/delete/no_delivery_dates')."/$date->id"}}">
                        {{csrf_field()}}
                        <button class="btn btn-danger" type="submit">Delete</button>
                    </form>
                  </td>
               </tr>
               @endforeach

            </tbody>
         </table>
      </div>
   </div>

   <div class="modal fade" id="noDeliveryModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
       <div class="modal-content">
                <div class="modal-header">
                   <h6 class="modal-title" id="myLargeModalLabel">Add Custom No Delivery Date</h6>
                   <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{url('/admin/add_no_delivery_dates')}}">
                        {{ csrf_field() }}
                       <div class="form-group">
                           <label>Date</label>
                           <input type="date" class="form-control" name="date" required>
                       </div>
                       <div class="form-group">
                        <label>Start Time</label>
                        <input type="time" class="form-control" name="start_time" required>
                        </div>
                        <div class="form-group">
                            <label>End Time</label>
                            <input type="time" class="form-control" name="end_time" required>
                        </div>
                       <button type="submit" class="btn btn-success btn-block">Save</button>
                   </form>
                </div>

             </div>
    </div>
 </div>

@stop
