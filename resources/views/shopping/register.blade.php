@extends('layouts.index')
<style type="text/css">
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  padding-top: 100px; /* Location of the box */
  left: 0;
  top: 0;
  width: 70%; /* Full width */
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


@section('content')


    <section class="ftco-section">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-xl-7 ftco-animate">
            <form action="#" class="billing-form">
              <h3 class="mb-4 billing-heading">Billing Details</h3>
              <div class="row align-items-end">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="firstname">Firt Name</label>
                    <input type="text" class="form-control" placeholder="">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="lastname">Last Name</label>
                    <input type="text" class="form-control" placeholder="">
                  </div>
                </div>
                <div class="w-100"></div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="country">State / Country</label>
                    <div class="select-wrap">
                      <div class="icon"><span class="ion-ios-arrow-down"></span></div>
                      <select name="" id="" class="form-control">
                        <option value="">France</option>
                        <option value="">Italy</option>
                        <option value="">Philippines</option>
                        <option value="">South Korea</option>
                        <option value="">Hongkong</option>
                        <option value="">Japan</option>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="w-100"></div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="streetaddress">Street Address</label>
                    <input type="text" class="form-control" placeholder="House number and street name">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <input type="text" class="form-control" placeholder="Appartment, suite, unit etc: (optional)">
                  </div>
                </div>
                <div class="w-100"></div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="towncity">Town / City</label>
                    <input type="text" class="form-control" placeholder="">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="postcodezip">Postcode / ZIP *</label>
                    <input type="text" class="form-control" placeholder="">
                  </div>
                </div>
                <div class="w-100"></div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="phone">Phone</label>
                    <input type="text" class="form-control" placeholder="">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="emailaddress">Email Address</label>
                    <input type="text" class="form-control" placeholder="">
                  </div>
                </div>
                <div class="w-100"></div>
                <div class="col-md-12">
                  <div class="form-group mt-4">
                    <div class="radio">
                      <label class="mr-3"><input type="radio" name="optradio"> Create an Account? </label>
                      <label><input type="radio" name="optradio"> Ship to different address</label>
                    </div>
                  </div>
                </div>
              </div>
            </form><!-- END -->
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
          var btn = document.getElementById("myBtn");

          // Get the <span> element that closes the modal
          var span = document.getElementsByClassName("close")[0];

          // When the user clicks the button, open the modal 
          btn.onclick = function() {
            modal.style.display = "block";
          }

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
                    url:`addToCart`,
                    data:{selected_product_id,selected_variant_id,selected_quantity,todo,selected_selling_price,"_token":"{{csrf_token()}}"},
                    encode  : true
                }).then(response=>{
                    if(response){
                      alert(response);
                         // $(el).parent().parent().css('background','tomato');
                         // $(el).parent().parent().fadeOut(function(){
                         //    $(this).remove();
                         // });            
                    }
                }).fail(error=>{
                    console.log('error',error);
                });
              
            });

            
        </script>

@stop