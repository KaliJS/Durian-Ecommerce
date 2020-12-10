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
                            <span>Coupon Applied Successfully.</span>
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
          	<p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home</a></span> <span>Checkout</span></p>
            <h1 class="mb-0 bread">Checkout</h1>
          </div>
        </div>
      </div>
    </div>

    <section class="ftco-section">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-xl-7 ftco-animate">
			<form class="billing-form" action="{{route('checkout.store')}}" method="POST">
              @csrf
              <h3 class="mb-4 billing-heading">Register</h3>
              <div class="row align-items-end">
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="lastname">Name</label>
                    <input type="text" name="name" value="{{Auth::user()->name}}" class="form-control" placeholder="Last Name" required>
                    <input type="text" hidden value="{{Auth::user()->id}}" class="form-control">
                  </div>
                </div>

                <div class="w-100"></div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="firstname">Email Address</label>
                    <input type="email" name="email" value="{{Auth::user()->email}}" class="form-control" placeholder="Email" required>
                  </div>
                </div>
                
               
                <div class="w-100"></div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="streetaddress">Street Address</label>
                    <input type="text" id="street" class="form-control" value="{{Auth::user()->area}}" name="address1" placeholder="House number and street name" required>
                  </div>
                </div>

                <div class="w-100"></div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="towncity">Town / City</label>
                    <input type="text" id="city" name="city" value="{{Auth::user()->city}}" class="form-control" placeholder="Town / City" required>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="postcodezip">Postcode / ZIP *</label>
                    <input type="number" id="pincode" name="pincode" value="{{Auth::user()->pincode}}" class="form-control" placeholder="Postcode" required>
                  </div>
                </div>
                <div class="w-100"></div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="phone">Phone</label>
                    <input type="number" name="phone" value="{{Auth::user()->phone}}" class="form-control" placeholder="Phone" required>
                  </div>
                </div>
                
                <div class="w-100"></div>
                <button type="submit" class="btn btn-primary ml-3">
                    Register
                </button>
              </div>
            </form>
          </div>
			<div class="col-xl-5">
	          <div class="row mt-5 pt-3">
	          	

	          	<div class="col-md-12 d-flex mb-5">
	          		<div class="cart-detail cart-total p-3 p-md-4">
	          			<h3 class="billing-heading mb-4">Cart Total</h3>
	          			<p class="d-flex">
							<span>Subtotal</span>
							<span>${{$total_price}}</span>
						</p>
						<p class="d-flex">
							<span>Delivery</span>
							<span>$0.00</span>
						</p>
						<p class="d-flex">
							<span>Discount</span>
							<span class="price_discount">$0.00</span>
						</p>
						<hr>
						<p class="d-flex total-price">
							<span>Total</span>
							<span class="final_price">${{$total_price}}</span>
						</p>
					</div>
	          	</div>

	          	<div class="col-md-12 cart-wrap mb-4 ftco-animate" id="coupon_form">
					<div class="cart-total mb-3">
						<h3>Coupon Code</h3>
						<p>Enter your coupon code if you have one</p>
						<form action="#" class="info">
			              <div class="form-group">
			              	<label for="">Coupon code</label>
			                <input type="text" id="coupon_code" class="form-control text-left px-3" placeholder="">
			                <span class="text-danger expired_coupon"></span>
			              </div>
			              <p><a type="botton" class="btn btn-primary py-3 px-4 apply_coupon_botton">Apply Coupon</a></p>
			            </form>
					</div>

				</div>

	          	<div class="col-md-12">
	          		<div class="cart-detail p-3 p-md-4">
	          			<h3 class="billing-heading mb-4">Payment Method</h3>
						<div class="form-group">
							<div class="col-md-12">
								<div class="radio">
								   <label><input type="radio" name="optradio" class="mr-2"> Direct Bank Tranfer</label>
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="col-md-12">
								<div class="radio">
								   <label><input type="radio" name="optradio" class="mr-2"> Check Payment</label>
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="col-md-12">
								<div class="radio">
								   <label><input type="radio" name="optradio" class="mr-2"> Paypal</label>
								</div>
							</div>
              <div id="paypal-button-container"></div>
						</div>
						<div class="form-group">
							<div class="col-md-12">
								<div class="checkbox">
								   <label><input type="checkbox" value="" class="mr-2"> I have read and accept the terms and conditions</label>
								</div>
							</div>
						</div>
						<p><a href="#"class="btn btn-primary py-3 px-4">Place an order</a></p>
					</div>
	          	</div>
	          </div>
          </div> <!-- .col-md-8 -->
        </div>
      </div>
    </section> <!-- .section -->

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
<script src="https://www.paypal.com/sdk/js?client-id=AUWFbGLu9ZihDL_sc8qUuBLtoL3DBtfyEkgUnvBlmpUDGgX2nlFWARi2OPGe0Swjpjw43WZw4bM3uWp5"></script>
<script type="text/javascript">



var products = {!! json_encode($cart) !!};

var amount = {!! json_encode($total_price) !!};
var price_after_discount = amount;

console.log(products);

  paypal.Buttons({
        createOrder: function(data, actions) {
          return actions.order.create({
            purchase_units: [{
              amount: {
                value: amount
              }
            }]
          });
        },
        onApprove: function(data, actions) {
          return actions.order.capture().then(function(details) {
              console.log(details);

              var street = $('#street').val();
              var city = $('#city').val();
              var pincode = $('#pincode').val();
              var address = street + ' ' + city;

                $.ajax({
                    method:'POST',
                    url:`/checkout/placeOrder`,
                    data:{details,products,amount,price_after_discount,pincode,address,"_token":"{{csrf_token()}}"},
                    encode  : true
                }).then(response=>{
                  
                     console.log(response);     
                    
                }).fail(error=>{
                    console.log('error',error);
                });
            // alert('Transaction completed by ' + details.payer.name.given_name);
          });
        }
      }).render('#paypal-button-container');



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


  $(document).on("click",".apply_coupon_botton",function(){

      const coupon_code = $('#coupon_code').val();
      

      var withoutSpace = coupon_code.replace(/ /g, '').length; 
      
      if(withoutSpace>0){
      $.ajax({
            method:'POST',
            url:`/cart/applyCoupon`,
            data:{coupon_code,"_token":"{{csrf_token()}}"},
            encode  : true
        }).then(response=>{
          
            if(response == 'blank'){
              $('.expired_coupon').text('! Invalid coupon');
            }else if(response == 'finished' || response == 'expire'){
              $('.expired_coupon').text('! Currently not available');
            }else if(response == 'less_amount'){
              $('.expired_coupon').text('! This Coupon can not be applied on your cart');
            }else{

            	$('#coupon_form').fadeOut(function(){
	                $(this).remove();
	                modal.style.display = "block";
	             });

	            $('.price_discount').text('$'+response[0]);
	            $('.final_price').text('$'+response[1]);
              price_after_discount = response[1];
            
            }          
            
        }).fail(error=>{
            console.log('error',error);
        });

      }else{
        $('.expired_coupon').text('! Please Enter Coupon Code, If have one.');
      }
      
    });


   
    
</script>

@stop