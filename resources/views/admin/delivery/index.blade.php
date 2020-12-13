@extends('layouts.admin')

@section('content')

<!-- Simple Datatable start -->
   <div class="card-box mb-30">
      <div class="pd-20">
         <h4 class="text-dark h4">Delivery Management</h4>
         <a href="{{url('/admin/no_delivery_dates')}}" class="btn btn-primary">Manage No Delivery Slots</a>
      </div>
      <div class="pb-20">
         <table class="table stripe hover nowrap">
            <thead>
               <tr>
                  <th>Day</th>
                  <th>Allow Delivery On This Day</th>
                  <th>Delivery Start Time</th>
                  <th>Delivery End Time</th>
               </tr>
            </thead>
            <tbody>

               @foreach($date_time_slots as $slot)
               <tr>
                  <td>{{$slot->day}}</td>
                  <td><input type="checkbox" {{$slot->status?"checked":""}} class="form-control slot_status" data-day_no="{{$slot->day_number}}"></td>
                  <td><input type="time" class="form-control start_time" value="{{$slot->start_time}}" data-day_no="{{$slot->day_number}}"></td>
                  <td><input type="time" class="form-control end_time" value="{{$slot->end_time}}" data-day_no="{{$slot->day_number}}"></td>
               </tr>
               @endforeach

            </tbody>
         </table>
      </div>
   </div>

@stop

@section('js')

   <script>
       $(document).on("change",".start_time",function(){
        const slot_day_no = $(this).data("day_no");
        const key = 'start_time';
        const value = $(this).val();
        $.ajax({
            url: "{{url('/admin/update_delivery_slot')}}"+`/${slot_day_no}`,
            method: 'post',
            data: {'key':key,'value':value,'_token':"{{csrf_token()}}"}
        }).then(response=>console.log(response)).fail(err=>console.log(err));
       });

       $(document).on("change",".end_time",function(){
        const slot_day_no = $(this).data("day_no");
        const key = 'end_time';
        const value = $(this).val();
        $.ajax({
            url: "{{url('/admin/update_delivery_slot')}}"+`/${slot_day_no}`,
            method: 'post',
            data: {'key':key,'value':value,'_token':"{{csrf_token()}}"}
        }).then(response=>console.log(response)).fail(err=>console.log(err));
       });

       $(document).on("change",".slot_status",function(){
        const slot_day_no = $(this).data("day_no");
        const key = 'status';
        const value = $(this).val() == 0?1:0;
        const me = $(this);
        $.ajax({
            url: "{{url('/admin/update_delivery_slot')}}"+`/${slot_day_no}`,
            method: 'post',
            data: {'key':key,'value':value,'_token':"{{csrf_token()}}"}
        }).then(response=>me.val(response.status)).fail(err=>console.log(err));
       });
   </script>

@stop
