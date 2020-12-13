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

.close2 {
  color: #aaaaaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
  margin-left: 95%;
}

.close2:hover,
.close2:focus {
  color: #000;
  text-decoration: none;
  cursor: pointer;
}

.close2:not(:disabled):not(.disabled) {
    cursor: pointer;
}

button.close2 {
    padding: 0;
    background-color: transparent;
    border: 0;
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
  }

  .close2 {
    float: right;
    font-size: 1.5rem;
    font-weight: 700;
    line-height: 1;
    color: #000;
    text-shadow: 0 1px 0 #fff;
    opacity: .5;
  }

a:not([href]):not([tabindex]) {
    color: white;
    text-decoration: none;
}
a:not([href]):not([tabindex]):hover {
    color: #82ae46;
    text-decoration: none;
}

#zoid-paypal-buttons-b2ccfc1deb_mdc6mtc6mjg > iframe.component-frame {
  z-index: 100 !important;
}

.loaderSuccess {
  border: 16px solid #f3f3f3;
  border-radius: 50%;
  border-top: 16px solid #3498db;
  width: 120px;
  height: 120px;
  -webkit-animation: spin 2s linear infinite; /* Safari */
  animation: spin 2s linear infinite;
}

/* Safari */
@-webkit-keyframes spin {
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}


@media(max-width: 400px){
	.modal-content{
		width: 90% !important;
		margin: auto;
	}
}

.paypal-button-row.paypal-button-layout-vertical{
  display:none !important;
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

<div id="myModal2" class="modal" style="z-index: 999;">

  <!-- Modal content -->
  <div class="modal-content" style="background-color: #ffaaaa;">
    
    <div class="row">
        <div class="col-12">
            <div class="modal-bg addtocart">
                <button type="button" class="close2" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                   
                <div class="align-self-center text-center">
                    <a href="#" class="">
                        <h6 class="mb-3" style="margin-top: -5px;padding: 5px; color:red;">
                            <i class="fa fa-exclamation-circle mr-2"></i>
                            <span>Please fill the required details</span>
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
			    <form>
              
              <h3 class="mb-4 billing-heading">Shipping Details</h3>
              <div class="row align-items-end">
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="lastname">Name</label>
                    <input type="text" id='name' name="name" value="{{Auth::user()->name}}" class="form-control" placeholder="Last Name" required>
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
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="phone">Phone</label>
                    <input type="number" id="phone" name="phone" value="{{Auth::user()->phone}}" class="form-control" placeholder="Phone" required>
                  </div>
                </div>
                <div class="w-100"></div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="phone">Delivery Date</label>
                    <input type="date" id="date" name="date" class="form-control" placeholder="Phone" required>
                    <span style="color: red;" id="dateMessage"></span>
                  </div>
                  <p id=date_alert></p>
                </div>

               
                <div class="col-md-6 d-none" id="time-container">
                  <div class="form-group">
                    <label for="phone">Delivery Time</label>
                    <input type="time" id="time" name="phone" class="form-control" placeholder="Phone" required>
                    <div><span class="text-success" id="dateMessageSuccess"></span></div>
                    <div><span style="color: red;" id="timeMessage"></span></div>

                  </div>

                  <p id=date_alert></p>
                </div>
                
                <div class="w-100"></div>
              
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
      							
                    <div class="my-3">
                      <button class="btn btn-success btn-lg" id="cash_on_delivery" style="width: 100%; border-radius: 5px;">Cash On Delivery</button>  
                    </div>
                    <div class="text-center d-none" id="paymentLoader">
                        <div class="loaderSuccess"  style="margin: auto;"></div>
                        <span style="color: #0073c1;font-weight: bold;">Order is processing Please Wait.</span>
                    </div>
                    <div id="paypal-button-container"></div>

      						</div>
      						
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

var dtToday = new Date();
    
var month = dtToday.getMonth() + 1;
var day = dtToday.getDate() + 1;
var year = dtToday.getFullYear();
if(month < 10)
    month = '0' + month.toString();
if(day < 10)
    day = '0' + day.toString();

var maxDate = year + '-' + month + '-' + day;
var nextMonth = month+1;
var nextYear = year;
if(nextMonth = 13){
  nextMonth = 1;
  nextYear = nextYear+1;
}
var minDate = nextYear + '-' + nextMonth + '-' + day;

$('#date').attr('min', maxDate);
//document.getElementById("date").defaultValue = maxDate;
// $('#date').attr('max', minDate);


  $(document).on("change","#date",function(){
      $('#dateMessage').text('');
      $('#timeMessage').text('');
      $('#dateMessageSuccess').text('');

      var date = $('#date').val();
      $('#time-container').addClass('d-none');
      $.ajax({
            method:'POST',
            url:`/checkout/checkSelectedDate`,
            data:{date,"_token":"{{csrf_token()}}"},
            encode  : true
        }).then(response=>{
            if(response){
              if(response[0] == 'no'){
                $('#dateMessage').text('Delivery is not available on this day');
                $('#date').val('');
              }
              if(response[0] == 'yes'){
                var start_time = tConv24(response[1]);
                var end_time = tConv24(response[2]);
                $('#dateMessageSuccess').text(`Delivery is available between ${start_time} to ${end_time}`);
                $('#time-container').removeClass('d-none');
              }
              if(response[0] == 'yes_no'){
                var start_time = tConv24(response[1]);
                var end_time = tConv24(response[2]);
                $('#dateMessageSuccess').text(`Delivery is Not available between ${start_time} to ${end_time}`);
                $('#time-container').removeClass('d-none');
              }
            }
            
        }).fail(error=>{
            console.log('error',error);
        });
      
    });

function tConv24(time24) {
  var ts = time24;
  var H = +ts.substr(0, 2);
  var h = (H % 12) || 12;
  h = (h < 10)?("0"+h):h;  // leading 0 at the left for 1 digit hours
  var ampm = H < 12 ? " AM" : " PM";
  ts = h + ts.substr(2, 3) + ampm;
  return ts;
};

  $(document).on("change","#time",function(){

      var time = $('#time').val();
      var date = $('#date').val();
      $.ajax({
            method:'POST',
            url:`/checkout/checkSelectedTime`,
            data:{time,date,"_token":"{{csrf_token()}}"},
            encode  : true
        }).then(response=>{
              if(response){
                if(response[0] == 'no'){
                  $('#dateMessageSuccess').text('');
                  $('#timeMessage').text('Delivery is not available on Selected Time.');
                  $('#time').val('');
                }
                if(response[0] != 'no'){
                  $('#dateMessageSuccess').text('You can now place you order.');
                  $('#timeMessage').text('');
                  
                }
              }     
            
        }).fail(error=>{
            console.log('error',error);
        });
      
    });



var products = {!! json_encode($cart) !!};

var amount = {!! json_encode($total_price) !!};
var price_after_discount = amount;

var actionStatus;
  paypal.Buttons({

        onInit:  function(data, actions) {
                    actions.disable();
                    actionStatus = actions;
                  },
                  onClick :  function(){
                    let val =  validateForm(); //returns status from your Custom Validation Checkpoint
                    if(!val){
                        actionStatus.disable();
                        modal2.style.display = "block";
                    }else {
                        actionStatus.enable();
                    }
                },

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
          $('#paymentLoader').removeClass('d-none');
          return actions.order.capture().then(function(details) {
              console.log(details);

              

              var street = $('#street').val();
              var name = $('#name').val();
              var phone = $('#phone').val();
              var city = $('#city').val();
              var pincode = $('#pincode').val();
              var date = $('#date').val();
              var time = $('#time').val();
              var address = street + ' ' + city;

                  $.ajax({
                    method:'POST',
                    url:`/checkout/placeOrder`,
                    data:{name,phone,details,products,amount,price_after_discount,pincode,address,"_token":"{{csrf_token()}}"},
                    encode  : true
                  }).then(response=>{
                    
                       console.log(response);
                       $('#paymentLoader').addClass('d-none');
                       window.location=response.url;      
                      
                  }).fail(error=>{
                      console.log('error',error);
                  });
                

          });
        }
      }).render('#paypal-button-container');



  let checkout_total_price = 0;

	var modal = document.getElementById("myModal");
  var modal2 = document.getElementById("myModal2");

	var span = document.getElementsByClassName("close")[0];
  var span2 = document.getElementsByClassName("close2")[0];

  span.onclick = function() {
	    modal.style.display = "none";
	} 

  span2.onclick = function() {
      modal2.style.display = "none";
  }

	window.onclick = function(event) {
	  if (event.target == modal) {
	    modal.style.display = "none";
	  }
	}

  window.onclick = function(event) {
    if (event.target == modal2) {
      modal2.style.display = "none";
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

	            $('.price_discount').text('$'+response[1]);
	            $('.final_price').text('$'+response[0]);
              price_after_discount = response[0];
            
            }          
            
        }).fail(error=>{
            console.log('error',error);
        });

      }else{
        $('.expired_coupon').text('! Please Enter Coupon Code, If have one.');
      }
      
    });


  $(document).on("click","#cash_on_delivery",function(){
      
      var street = $('#street').val();
      var name = $('#name').val();
      var phone = $('#phone').val();
      var city = $('#city').val();
      var pincode = $('#pincode').val();
      var date = $('#date').val();
      var time = $('#time').val();
      var address = street + ' ' + city;

      var withoutSpaceName = name.replace(/ /g, '').length; 
      var withoutSpacephone = phone.replace(/ /g, '').length; 
      var withoutSpaceCity = city.replace(/ /g, '').length; 
      var withoutSpacePincode = pincode.replace(/ /g, '').length; 
      var withoutSpaceDate = date.replace(/ /g, '').length; 
      var withoutSpaceTime = time.replace(/ /g, '').length; 
      var withoutSpaceStreet = street.replace(/ /g, '').length; 
        if(withoutSpaceName>0 && withoutSpacephone>0 && withoutSpaceStreet>0 && withoutSpaceTime>0 && withoutSpaceDate>0 && withoutSpaceCity>0 && withoutSpacePincode>0){
          $('#paymentLoader').removeClass('d-none');
          $.ajax({
            method:'POST',
            url:`/checkout/placeCashOrder`,
            data:{name,phone,products,amount,price_after_discount,pincode,address,"_token":"{{csrf_token()}}"},
            encode  : true
          }).then(response=>{
              $('#paymentLoader').addClass('d-none');
               window.location=response.url;     
              
          }).fail(error=>{
              console.log('error',error);
          });
        }else{
          modal2.style.display = "block";
        }

    });

  var validateForm = function(){
    var street = $('#street').val();
    var name = $('#name').val();
    var phone = $('#phone').val();
    var city = $('#city').val();
    var pincode = $('#pincode').val();
    var date = $('#date').val();
    var time = $('#time').val();
    var address = street + ' ' + city;

    var withoutSpaceName = name.replace(/ /g, '').length; 
    var withoutSpacephone = phone.replace(/ /g, '').length; 
    var withoutSpaceCity = city.replace(/ /g, '').length; 
    var withoutSpacePincode = pincode.replace(/ /g, '').length; 
    var withoutSpaceDate = date.replace(/ /g, '').length; 
    var withoutSpaceTime = time.replace(/ /g, '').length; 
    var withoutSpaceStreet = street.replace(/ /g, '').length; 
      if(withoutSpaceName>0 && withoutSpacephone>0 && withoutSpaceStreet>0 && withoutSpaceTime>0 && withoutSpaceDate>0 && withoutSpaceCity>0 && withoutSpacePincode>0){
        return true;
      }else{
        return false;
      }
  }


   
    
</script>

@stop