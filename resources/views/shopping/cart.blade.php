@extends('layouts.index')
@section('css')
<style type="text/css">

.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  padding-top: 100px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
  margin: auto;
}
.modal-content {
    position: relative;
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-orient: vertical;
    -webkit-box-direction: normal;
    -ms-flex-direction: column;
    flex-direction: column;
    width: 40% !important;
    pointer-events: auto;
    background-color: #fff;
    background-clip: padding-box;
    border: 1px solid rgba(0, 0, 0, 0.2);
    border-radius: 0.3rem;
    outline: 0;
    }

/* Modal Content */
.modal-content {
    background-color: #fefefe;
    padding: 10px;
    border: 1px solid #888;
    width: 80%;
    margin-right: 16px;
    margin-left: auto;
    margin-top: -80px !important;
}

/* The Close Button */
.close {
  color: #aaaaaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
  margin-left: 95%;
}

.close:hover,
.close:focus {
  color: #000;
  text-decoration: none;
  cursor: pointer;
}
a:not([href]):not([tabindex]) {
    color: white;
    text-decoration: none;
}
a:not([href]):not([tabindex]):hover {
    color: #82ae46;
    text-decoration: none;
}


@media(max-width: 400px){
	.modal-content{
		width: 90% !important;
		margin: auto;
	}
}

</style>

@stop


@section('content')



<div id="myModal" class="modal" style="z-index: 999;">

  <!-- Modal content -->
  <div class="modal-content">
    
    <div class="row">
        <div class="col-12">
            <div class="modal-bg addtocart">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                
                    
                    <div class="align-self-center text-center">
                        <a href="#" class="">
                            <h6 class="mb-3" style="margin-top: -5px;padding: 5px;">
                                <i class="fa fa-check-circle mr-2"></i>
                                <span>Item successfully removed from your Cart</span>
                            </h6>
                        </a>
                        
                    
                </div>
            </div>
        </div>
    </div>

  </div>

</div>


<div class="hero-wrap hero-bread" style="background-image: url({{url('uploads/banners/'.$header->image)}});">
      <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
          <div class="col-md-9 ftco-animate text-center">
          	<p class="breadcrumbs"><span class="mr-2"><a href="{{url('/')}}">Home</a></span> <span>Cart</span></p>
            <h1 class="mb-0 bread">My Cart</h1>
          </div>
        </div>
      </div>
    </div>

    <section class="ftco-section ftco-cart">
		<div class="container">
			<div class="row">
			<div class="col-md-12 ftco-animate">
				<div class="cart-list">
    				<table class="table">
					    <thead class="thead-primary">
					      <tr class="text-center">
					        <th>Remove</th>
					        <th>Product Image</th>
					        <th>Product name & Quantity</th>
					        <th>Price</th>
					        <th>Quantity</th>
					        <th>Total</th>
					      </tr>
					    </thead>
					    <tbody>

					    	

					    	@foreach($cart as $key=>$value)
							      <tr class="text-center">
							        <td class="product-remove" id="{{$key}}"><a><span class="ion-ios-close"></span></a></td>
							        
							        <td class="image-prod"><div class="img" style="background-image: url({{url('uploads/products/'.$value['image'])}});"></div></td>
							        
							        <td class="product-name">
							        	<h3>{{$value['product_name']}}</h3>
							        </td>
							        
							        <td class="price">${{$value['variant_price']}}</td>
							        
							        <td class="quantity">
							        	<div class="input-group mb-3">
							             	<span class="input-group-btn mr-2">
							                	<button type="button" id="{{$key}}" class="quantity-left-minus btn"  data-type="minus" data-field="">
							                   <i class="ion-ios-remove"></i>
							                	</button>
							            	</span>
							             	<input type="text" id="quantity-{{$key}}" name="quantity" class="form-control input-number" value="{{$value['quantity']}}" min="1" max="100" readonly>
							             	<span class="input-group-btn ml-2">
							                	<button type="button" class="quantity-right-plus btn" data-type="plus" id="{{$key}}" data-field="">
							                     <i class="ion-ios-add"></i>
							                 	</button>
							             	</span>
							          	</div>
						          </td>
							        
							        <td class="total-{{$key}}">${{$value['subtotal']}}</td>
							      </tr>
							@endforeach

							@if(count($cart) < 1)

							<tr>
								<td>{{$empty}}</td>
							</tr>
							    
							@endif
					      
					    </tbody>
					  </table>
				  </div>
			</div>
		</div>
		<div class="row">

			@if(!count($cart) < 1)
			
			<div class="col-lg-4 mt-5 cart-wrap ftco-animate">
				<div class="cart-total mb-3">
					<h3>Cart Totals</h3>
					
					<hr>
					<p class="d-flex total-price">
						<span>Total</span>
						<span id="final_price">${{$total_price}}</span>
					</p>
				</div>
				<p><a href="{{url('/checkout')}}" class="btn btn-primary py-3 px-4">Proceed to Checkout</a></p>
			</div>

			@endif
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
  

@stop


@section('js')

<script type="text/javascript">


  let checkout_total_price = 0;

	var modal = document.getElementById("myModal");
	var span = document.getElementsByClassName("close")[0];
    span.onclick = function() {
	    modal.style.display = "none";
	} 

	window.onclick = function(event) {
	  if (event.target == modal) {
	    modal.style.display = "none";
	  }
	}

	$(document).on("click",".quantity-right-plus",function(){
      
      const selected_variant_id = this.id;
      let quantity = $('#quantity-'+selected_variant_id).val();

        quantity++;

        $('#quantity-'+selected_variant_id).val(quantity);
        const todo = 'update';

      $.ajax({
            method:'POST',
            url:`/cart/updateCart`,
            data:{selected_variant_id,todo,quantity,"_token":"{{csrf_token()}}"},
            encode  : true
        }).then(response=>{
          
            if(response){
	              $('.total-'+selected_variant_id).text(response[2]);
                $('#final_price').text(response[1]);
            }else{
                alert('! Something went wrong, Please Try again later..');
            }  

        }).fail(error=>{
            console.log('error',error);
        });
      
    });

    $(document).on("click",".quantity-left-minus",function(){
      const selected_variant_id = this.id;
      let quantity = $('#quantity-'+selected_variant_id).val();

      if(quantity<=1){
        return;
      }else{
        quantity--;
      }
      $('#quantity-'+selected_variant_id).val(quantity);
      const todo = 'update';
      $.ajax({
            method:'POST',
            url:`/cart/updateCart`,
            data:{selected_variant_id,todo,quantity,"_token":"{{csrf_token()}}"},
            encode  : true
        }).then(response=>{
          
            if(response){
                $('.total-'+selected_variant_id).text(response[2]);
                $('#final_price').text(response[1]);
              }else{
                alert('! Something went wrong, Please Try again later..');
              }           
            
        }).fail(error=>{
            console.log('error',error);
        });
    });

	$(document).on("click",".product-remove",function(){

	  const el = this;
      const selected_variant_id = this.id;
      
      const todo = 'delete';
      $.ajax({
            method:'POST',
            url:`/cart/updateCart`,
            data:{selected_variant_id,todo,"_token":"{{csrf_token()}}"},
            encode  : true
        }).then(response=>{
          
            if(response){
              
	             $(el).parent().fadeOut(function(){
	                $(this).remove();
	                modal.style.display = "block";
	             }); 
	             $('#cart_count').text(response[0]);
               $('#final_price').text(response[1]);

              }else{
                alert('! Something went wrong, Please Try again later..');
              }          
            
        }).fail(error=>{
            console.log('error',error);
        });
      
    });

  


   
    
</script>

@stop