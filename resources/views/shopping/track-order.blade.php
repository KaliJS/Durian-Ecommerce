@extends('layouts.index')

@section('content')


    <section class="ftco-section ftco-cart py-5">
		<div class="container">
      <div class="text-success">
      <h4 class="mb-3 mx-auto text-center" style="margin-top: -5px;padding: 5px;">
          
          <span class="text-success">Orders List</span>
      </h4>
    </div>
			<div class="row">
        
			<div class="col-md-12 ftco-animate">
				<div class="cart-list">
    				<table class="table">
					    <thead class="thead-primary">
					      <tr class="text-center">
					        
					        <th>Order Id</th>
					        <th>Items</th>
					        <th>Amount</th>
					        <th>Delivery Boy</th>
					        <th>Order Status</th>
                  <th>Payment Status</th>
                  <th>Order Date</th>
					      </tr>
					    </thead>
					    <tbody>

                @if($orders)
					    	@foreach($orders as $order)
							      <tr class="text-center">
							        
							       
                      <td class="price">{{$order->id}}</td>
                      <td class="price text-success" style="cursor: pointer;">
                        <a class='items_model' data-order_id='{{$order->id}}' data-toggle="modal" data-target="#items_modal">
                          View
                        </a>
                      </td>
                      <td class="price">${{$order->final_price}}</td>
                      <td class="price text-success" style="cursor: pointer;">
                        @if($order->delivery_boy_id)
                        <a class='delivery_boy_assign' data-order_id='{{$order->id}}' data-toggle="modal" data-target="#deliveryBoyModal">
                        {{$order->delivery_boy->name}}
                        </a>
                        @endif
                        @if(!$order->delivery_boy_id)
                        Did Not Assigned Yet
                        @endif

                      </td>
                      <td class="price">{{$order->order_status}}</td>
                      <td class="price">{{$order->payment_status}}</td>
                      <td class="price">{{date("j F Y g:i A",strtotime($order->created_at))}}</td>

							      </tr>
                  
							  @endforeach

              @endif

              @if(!$orders)
							<tr>
								<td><h3>!No Order Items Yes Please Place and order.</td></h3>
							</tr>
							@endif  
							
					      
					    </tbody>
					  </table>
				  </div>
			</div>
		</div>
		
		</div>
	</section>

	<section class="ftco-section ftco-no-pt ftco-no-pb py-5 bg-light">
      <div class="container py-4">
        <div class="row d-flex justify-content-center py-5">
          <div class="col-md-6">
          	<h2 style="font-size: 22px;" class="mb-0">Subcribe to our Newsletter</h2>
          	<span>Get e-mail updates about our latest shops and special offers</span>
          </div>
          <div class="col-md-6 d-flex align-items-center">
            <form action="#" class="subscribe-form">
              <div class="form-group d-flex">
                <input type="text" class="form-control" placeholder="Enter email address">
                <input type="submit" value="Subscribe" class="submit px-3">
              </div>
            </form>
          </div>
        </div>
      </div>
    </section>



    <div class="modal fade" id="deliveryBoyModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
       <div class="modal-content">
                <div class="modal-header">
                   <h6 class="modal-title" id="myLargeModalLabel">Delivery Boy Details</h6>
                   <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                   <div class="table-responsive">
                      <table class="table table-striped" style="min-width: auto !important;">
                        <thead>
                          <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                          </tr>
                          <tr id="deliveryBoy"></tr>
                        </thead>
                        <tbody>

                        </tbody>
                      </table>
                   </div>
                </div>

             </div>
    </div>
 </div>


 <div class="modal fade" id="items_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
       <div class="modal-content">
                <div class="modal-header">
                   <h6 class="modal-title" id="myLargeModalLabel">Delivery Boy Details</h6>
                   <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                   <div class="table-responsive">
                      <table class="table table-striped" style="min-width: auto !important;">
                        <thead>
                          <tr>
                            
                            <th>Product name & Quantity</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
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
  

@stop


@section('js')

<script type="text/javascript">


  $(document).on("click",".delivery_boy_assign",function(){
        const order_id = $(this).data('order_id');

        $.ajax({
            url:"{{url('order/getDeliveryBoy')}}"+`/${order_id}`
        })
        .then(response=>{

            $("#deliveryBoy").html(response);
            $("#deliveryBoyModal").modal("show");
        }).fail(err=>console.log('error',err));
    });

  $(document).on("click",".items_model",function(){
        const order_id = $(this).data('order_id');
        $.ajax({
            url:"{{url('order/getAllOrderItems')}}"+`/${order_id}`
        })
        .then(response=>{

            $("#items_modal tbody").html(response);
            $("#items_modal").modal("show");
        }).fail(err=>console.log('error',err));
    });
    
</script>

@stop