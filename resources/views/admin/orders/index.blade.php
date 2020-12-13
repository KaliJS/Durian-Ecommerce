@extends('layouts.admin')

@section('css')

    <style>
        .delivery_boy_assign,.change_order_status,.change_payment_status{
            color:blue !important;
            text-decoration:underline !important;
            cursor:pointer;
        }
        .select2-container{
            width:100% !important;
        }
    </style>

@endsection

@section('content')

<!-- Simple Datatable start -->
   <div class="card-box mb-30">
      <div class="pd-20">
         <h4 class="text-dark h4">Orders List</h4>
      </div>
      <div class="pb-20">
         <table class="data-table table stripe hover nowrap">
            <thead>
               <tr>
                  <th class="table-plus datatable-nosort">Order Id</th>
                  <th>User Email</th>
                  <th>Order Status</th>
                  <th>Order Items</th>
                  <th>Transaction Details</th>
                  
                  <th>Delivery Boy</th>
                  <th>Order Status</th>
                  <th>Actual Price</th>
                  <th>Final Price</th>
                  <th>Payment Method</th>
                  <th>Order Address</th>
                  <th>Pincode</th>
                  <th>Order Datetime</th>
               </tr>
            </thead>
            <tbody>

               @foreach($orders as $order)
               <tr>
                  <td class="table-plus">{{$order->id}}</td>
                  <td>{{$order->user->email}}</td>
                  
                    
                  <td>
                    <a class="change_order_status" data-order_id='{{$order->id}}'>
                        {{ucwords($order->order_status)}}</td>
                    </a>
                  <td>
                    <a class="btn-block orderItemsButton" data-order_id="{{$order->id}}" type="button">
                        <i class="dw dw-eye"></i> View
                     </a>
                  </td>
                  <td>
                    @if($order->payment_method == 'paypal')
                    <a class="btn-block transactionButton" data-order_id="{{$order->id}}" type="button">
                        <i class="dw dw-eye"></i> View
                     </a>
                     @endif

                     @if($order->payment_method == 'cash')
                      Cash on delivery
                     @endif
                  </td>
                 
                  <td>
                    <a class='delivery_boy_assign' data-order_id='{{$order->id}}' data-toggle="modal" data-target="#deliveryBoyModal">
                        {{isset($order->delivery_boy_id)?$order->delivery_boy->name:"Assign Delivery Boy"}}
                    </a>
                  </td>
                  <td>
                    <a class="change_payment_status" data-order_id='{{$order->id}}'>
                      {{ucwords($order->payment_status)}}</a></td>
                  <td>{{$order->actual_price}}</td>
                  <td>{{$order->final_price}}</td>
                  <td>{{ucwords($order->payment_method)}}</td>
                  <td>{{$order->address}}</td>
                  <td>{{$order->pincode}}</td>
                  
                  <td>{{date("j F Y g:i A",strtotime($order->created_at))}}</td>
               </tr>
               @endforeach

            </tbody>
         </table>
      </div>
   </div>



   <div class="modal fade" id="orderItemsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
       <div class="modal-content">
                <div class="modal-header">
                   <h6 class="modal-title" id="myLargeModalLabel">Order Items</h6>
                   <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                   <div class="table-responsive">
                      <table class="table table-striped">
                        <thead>
                          <tr>
                            <th scope="col">Product</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Price</th>
                          </tr>
                        </thead>
                        <tbody>

                        </tbody>
                      </table>
                   </div>
                </div>

             </div>
    </div>
 </div>

 <div class="modal fade" id="transactionModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document" style="width:90%;max-width:100% !important;">
       <div class="modal-content">
                <div class="modal-header">
                   <h6 class="modal-title" id="myLargeModalLabel">Transaction Details</h6>
                   <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                   <div class="table-responsive">
                      <table class="table table-striped">
                        <thead>
                          <tr>
                            <th>Transaction Id</th>
                            <th>Order Id</th>
                            <th>Amount</th>
                            <th>Payment Id</th>
                            <th>Payer Email</th>
                            <th>Merchant Id</th>
                            <th>Payment Status</th>
                            <th>Payer Id</th>
                            <th>Transaction Datetime</th>
                          </tr>
                        </thead>
                        <tbody>

                        </tbody>
                      </table>
                   </div>
                </div>

             </div>
    </div>
 </div>

 <div class="modal fade" id="deliveryBoyModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
       <div class="modal-content">
                <div class="modal-header">
                   <h6 class="modal-title" id="myLargeModalLabel">Assign Delivery Boy</h6>
                   <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                   <form method="post">
                        {{ csrf_field() }}
                       <div class="form-group">
                           <label>Select Delivery Boy</label>
                           <select class="form-control" name="delivery_boy_id" required>
                               <option value="" disabled selected>Select</option>
                               @foreach($delivery_boys as $delivery_boy)
                                <option value="{{$delivery_boy->id}}">{{$delivery_boy->name}}</option>
                                @endforeach
                           </select>
                       </div>
                       <button type="submit" class="btn btn-success btn-block">Save</button>
                   </form>
                </div>

             </div>
    </div>
 </div>

 <div class="modal fade" id="orderStatusModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
       <div class="modal-content">
                <div class="modal-header">
                   <h6 class="modal-title" id="myLargeModalLabel">Change Order Status</h6>
                   <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                   <form method="post">
                        {{ csrf_field() }}
                       <div class="form-group">
                           <label>Update Order Status</label>
                           <select class="form-control" name="status" id="status">

                           </select>
                       </div>
                       <button type="submit" class="btn btn-success btn-block">Save</button>
                   </form>
                </div>

             </div>
    </div>
 </div>

 <div class="modal fade" id="paymentStatusModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
       <div class="modal-content">
                <div class="modal-header">
                   <h6 class="modal-title" id="myLargeModalLabel">Change Payment Status</h6>
                   <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                   <form method="post">
                        {{ csrf_field() }}
                       <div class="form-group">
                           <label>Update Payment Status</label>
                           <select class="form-control" name="status" id="status">

                           </select>
                       </div>
                       <button type="submit" class="btn btn-success btn-block">Save</button>
                   </form>
                </div>

             </div>
    </div>
 </div>


@stop

@section('js')

<script>

    $(document).on("click",".orderItemsButton",function(){
        const order_id = $(this).data('order_id');
        $.ajax({
            url:"{{url('admin/order/getOrderItems')}}"+`/${order_id}`
        })
        .then(response=>{
            $("#orderItemsModal tbody").html(response);
            $("#orderItemsModal").modal("show");
        }).fail(err=>console.log('error',err));
    });

    $(document).on("click",".transactionButton",function(){
        const order_id = $(this).data('order_id');
        $.ajax({
            url:"{{url('admin/order/getTransaction')}}"+`/${order_id}`
        })
        .then(response=>{
            $("#transactionModal tbody").html(response);
            $("#transactionModal").modal("show");
        }).fail(err=>console.log('error',err));
    });

    $(document).on("click",".delivery_boy_assign",function(){
        const order_id = $(this).data('order_id');
        const action = "{{url('admin/order/assignDeliveryBoy')}}"+`/${order_id}`;
        $("#deliveryBoyModal form").attr("action",action);
    });

    $(document).on("click",".change_order_status",function(){
        const order_id = $(this).data('order_id');
        const action = "{{url('admin/order/changeOrderStatus')}}"+`/${order_id}`;
        $.ajax({
            url:"{{url('admin/order/getOrderStatus')}}"+`/${order_id}`
        })
        .then(response=>{
            $("#orderStatusModal form").attr("action",action);
            $("#orderStatusModal select#status").html(response);
            $("#orderStatusModal").modal("show");
        }).fail(err=>console.log('error',err));
    });

    $(document).on("click",".change_payment_status",function(){
        const order_id = $(this).data('order_id');
        const action = "{{url('admin/order/changePaymentStatus')}}"+`/${order_id}`;
        $.ajax({
            url:"{{url('admin/order/getPaymentStatus')}}"+`/${order_id}`
        })
        .then(response=>{
            $("#paymentStatusModal form").attr("action",action);
            $("#paymentStatusModal select#status").html(response);
            $("#paymentStatusModal").modal("show");
        }).fail(err=>console.log('error',err));
    });

</script>

@endsection
