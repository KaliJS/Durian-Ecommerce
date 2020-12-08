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
    width: 70% !important;
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
  margin: auto;
  padding: 20px;
  border: 1px solid #888;
  width: 80%;
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
</style>

@stop


@section('content')


    <!-- Trigger/Open The Modal -->


<!-- The Modal -->
<div id="myModal" class="modal" style="z-index: 999;">

  <!-- Modal content -->
  <div class="modal-content">
    
    <div class="row">
        <div class="col-12">
            <div class="modal-bg addtocart">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <div class="row">
                    <div class="col-md-3">
                    
                      @foreach(explode(',',$product->images) as $image)
                       @if ($loop->first)
                        <img src="{{ asset('uploads/products/'.$image) }}" class="img-fluid pro-img product_image" alt="">
                       @endif
                      @endforeach
                    </div>
                    <div class="align-self-center text-center col-md-9">
                        <a href="#" class="">
                            <h6 class="mb-3">
                                <i class="fa fa-check-circle mr-2"></i>Item
                                <span class="product_name">{{$product->name}}</span>
                                <span> successfully added to your Cart</span>
                            </h6>
                        </a>
                        <div class="buttons">
                            <a href="{{url('/shop')}}" class="btn btn-primary py-2 px-4 mb-1">Continue Shopping</a>
                            <a href="{{url('/cart')}}" style="margin-right: 5%;margin-left: 5%;" class="btn btn-primary py-2 px-4 mb-1">Veiw Cart</a>
                            <a href="{{url('/checkout')}}" class="btn btn-primary py-2 px-4 mb-1">Checkout</a>
                        </div>

                        
                    </div>
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
          	<p class="breadcrumbs"><span class="mr-2"><a href="{{url('/')}}">Home</a></span> <span class="mr-2"><a href="{{url('/shop')}}">Product</a></span> <span>Product Single</span></p>
            <h1 class="mb-0 bread">Product Single</h1>
          </div>
        </div>
      </div>
    </div>

    <section class="ftco-section">
    	<div class="container">
    		<div class="row">
    			<div class="col-lg-6 mb-5 ftco-animate">
    				
    				
					    
					  <div class="" href="{{ asset('uploads/products/'.$first_image) }}">
					    <img src="{{ asset('uploads/products/'.$first_image) }}" id="show-img">
					  </div>
					  <div class="small-img">
					    <img src="{{asset('/slider/images/online_icon_right@2x.png')}}" class="icon-left" alt="" id="prev-img">
					    <div class="small-container">
					      <div id="small-img-roll">
					      	@foreach(explode(',',$product->images) as $image)
					        <img src="{{ asset('uploads/products/'.$image) }}" class="show-small-img" alt="">
					        @endforeach
					      </div>
					    </div>
					    <img src="{{asset('/slider/images/online_icon_right@2x.png')}}" class="icon-right" alt="" id="next-img">
					  </div>
					


    			</div>
    			<div class="col-lg-6 product-details pl-md-5 ftco-animate">
    				<h3>{{$product->name}}</h3>
    				
    				<p class="price"><span>{{$price}}</span></p>
    				<p>{{$product->description}}</p>
						<div class="row mt-4">
							
              <div class="col-md-12">
                <div class="form-group row">
                  
                  <div class="col-sm-12 col-md-7 pt-1">
                    <select class="form-control col-12" name="unit" id="variant" required>
                      <option selected disabled>Choose Variant</option>
                      @foreach($product->variants as $v)
                        <option value="{{$v->id}}" data-selling_price="{{$v->selling_price}}" data-mrp_price="{{$v->mrp_price}}" data-in_stock="{{$v->in_stock}}" data-quantity="{{$v->quantity}}">{{$v->quantity}}{{$v->unit->short_code}}</option>
                        @endforeach
                    </select>
                  </div>
               </div>
             </div>

             <div class="cart-total d-none mb-3" id="variant-details">
                <h3>Details</h3>
                <p class="d-flex">
                  <span>Price</span>
                  <strike class="mr-2"><span id="detail-mrp-price"></span></strike>
                  <span id="detail-selling-price" class="text-dark" style="font-weight: bold;"></span>
                </p>
                
                <p class="d-flex mb-0">
                  <span>In Stock</span>
                  <span id="product_in_stock"></span>
                </p>
              
              </div>

             <div class="col-md-12">
                </div>

							<div class="w-100"></div>
							<div class="input-group col-md-6 d-flex mb-3">
	             	<span class="input-group-btn mr-2">
	                	<button type="button" class="quantity-left-minus btn"  data-type="minus" data-field="">
	                   <i class="ion-ios-remove"></i>
	                	</button>
	            		</span>
	             	<input type="text" id="quantity" name="quantity" class="form-control input-number" value="1" min="1" max="100">
	             	<span class="input-group-btn ml-2">
	                	<button type="button" class="quantity-right-plus btn" data-type="plus" data-field="">
	                     <i class="ion-ios-add"></i>
	                 </button>
	             	</span>
	          	</div>
	          	<div class="w-100"></div>
	          	
          	</div>
          	<p><a id="{{$product->id}}" class="btn btn-black text-white py-3 px-5 add_to_cart disabled">Add to Cart</a></p>
    			</div>
    		</div>
    	</div>
    </section>




    <section class="ftco-section">
    	<div class="container">
				<div class="row justify-content-center mb-3 pb-3">
          <div class="col-md-12 heading-section text-center ftco-animate">
          	<span class="subheading">Products</span>
            <h2 class="mb-4">Related Products</h2>
            <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia</p>
          </div>
        </div>   		
    	</div>
    	<div class="container">
    		<div class="row">
    			@foreach($relatedProducts as $product)
    			<div class="col-md-6 col-lg-3 ftco-animate">
    				<div class="product">

    					<a href="{{url('/product/'.$product->slug)}}" class="img-prod">
    						@foreach(explode(',',$product->images) as $image)
                    @if ($loop->first)
                    
                       <img class="img-fluid" src="{{asset('uploads/products/'.$image)}}" alt="durian">
                     
                    @endif
                 @endforeach
    						
    						<div class="overlay"></div>
    					</a>
    					<div class="text py-3 pb-4 px-3 text-center">
    						<h3><a href="#">{{$product->name}}</a></h3>
    						<div class="d-flex">
    							<div class="pricing">              
                    <p class="price">
                      <span class="price-sale">{{$product->price_range}}</span>              
                    </p>              
                  </div>
	    					</div>
	    					
    					</div>
    				</div>
    			</div>
    			@endforeach
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


                    // Get the modal
          var modal = document.getElementById("myModal");

          // Get the button that opens the modal
          //var btn = document.getElementById("myBtn");

          // Get the <span> element that closes the modal
          var span = document.getElementsByClassName("close")[0];

          // When the user clicks the button, open the modal 
          // btn.onclick = function() {
          //   modal.style.display = "block";
          // }

          // When the user clicks on <span> (x), close the modal
          span.onclick = function() {
            modal.style.display = "none";
          }

          // When the user clicks anywhere outside of the modal, close it
          window.onclick = function(event) {
            if (event.target == modal) {
              modal.style.display = "none";
            }
          }
            
          var variants = '{{$product->variants}}';

            $(document).on("click",".quantity-right-plus",function(){
              let quantity = $('#quantity').val();
              
                quantity++
                $('#quantity').val(quantity);
              
            });

            $(document).on("click",".quantity-left-minus",function(){
              let quantity = $('#quantity').val();
              if(quantity<=1){
                return;
              }else{
                quantity--;
                $('#quantity').val(quantity);
              }
            });

            let selling_price,variant_id,selectedOption,mrp_price,quantity,in_stock;

            $(document).on("change","#variant",function(){
               variant_id=$(this).val();
               selectedOption = $(this).find(":selected");
               selling_price = selectedOption.data("selling_price");
               mrp_price = selectedOption.data("mrp_price");
               quantity = selectedOption.data("quantity"); 
               in_stock = selectedOption.data("in_stock"); 
               if(in_stock == '1'){
                $('#product_in_stock').html("<p class='in_stock' style='color: #1eb659;'>Yes</p>");
                $('.add_to_cart').removeClass('disabled')
               }else{
                $('#product_in_stock').html('<p class="not_in_stock" style="color: #f24949;">Currently Not Available</p>');
               }
               
               $('#detail-mrp-price').text('$'+mrp_price);
               $('#detail-selling-price').text('$'+selling_price);

               $('#variant-details').removeClass('d-none');

            });

            $(document).on("click",".add_to_cart",function(){
              const selected_product_id = this.id;
              const selected_variant_id=$('#variant').val();
              const selected_quantity=$('#quantity').val();
              const selected_selling_price = selling_price;
              const todo = 'add';
              $.ajax({
                    method:'POST',
                    url:`updateCart`,
                    data:{selected_product_id,selected_variant_id,selected_quantity,todo,selected_selling_price,"_token":"{{csrf_token()}}"},
                    encode  : true
                }).then(response=>{
                  
                   
                      if(response){
                        modal.style.display = "block";
                        $('#cart_count').text(response);

                      }else{
                        alert('! Something went wrong, Please Try again later..');
                      }          
                    
                }).fail(error=>{
                    console.log('error',error);
                });
              
            });

            
        </script>

@stop