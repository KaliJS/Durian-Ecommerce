@extends('layouts.index')


@section('content')


<section class="ftco-section ftco-cart py-3">
  <div class="container">
    <div class="text-success">
      <h4 class="mb-3 mx-auto text-center" style="margin-top: -5px;padding: 5px;">
          <i class="fa fa-check-circle mr-2 text-success"></i>
          <span class="text-success">Order Completed Successfully.</span>
      </h4>
    </div>

    <div class="row">
      <div class="col-md-12 ftco-animate">
        <div class="cart-list">
            <table class="table">
              <thead class="thead-primary">
                <tr class="text-center">
                  
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
                      
                      
                      <td class="image-prod"><div class="img" style="background-image: url({{url('uploads/products/'.$value['image'])}});"></div></td>
                      
                      <td class="product-name">
                        <h3>{{$value['product_name']}}</h3>
                      </td>
                      
                      <td class="price">${{$value['variant_price']}}</td>
                      
                      <td class="quantity">
                        <div class="input-group mb-3">
                            
                            <input type="text" id="quantity-{{$key}}" name="quantity" class="form-control input-number" value="{{$value['quantity']}}" min="1" max="100" readonly>
                
                        </div>
                      </td>
                      
                      <td class="total-{{$key}}">${{$value['subtotal']}}</td>
                    </tr>
              @endforeach

              
                
              </tbody>
            </table>
          </div>
      </div>
    </div>

    <div class="row">



      <div class="col-lg-4 mt-5 cart-wrap ftco-animate">
        <div class="cart-total mb-3">
          <h3>Order Details</h3>
          
          <hr>
          <p class="d-flex total-price">
            <span>Order Id</span>
            <span id="final_price">{{$order->id}}</span>
          </p>
          <p class="d-flex total-price">
            <span>Amount</span>
            <span id="final_price">${{$order->final_price}}</span>
          </p>
          <p class="d-flex total-price">
            <span>Payment Type</span>
            <span id="final_price">{{ucwords($order->payment_method)}}</span>
          </p>
          
          <p class="d-flex total-price">
            <span>Date and Time</span>
            <span id="final_price">{{date("j F Y g:i A",strtotime($order->created_at))}}</span>
          </p>
        </div>
        
      </div>

      <div class="col-lg-4 mt-5 cart-wrap ftco-animate">
        <div class="cart-total mb-3">
          <h3>Shipping Details</h3>
          
          <hr>
          <p class="d-flex total-price">
            <span>Name</span>
            <span id="final_price">{{Auth::user()->name}}</span>
          </p>
          <p class="d-flex total-price">
            <span>Phone No.</span>
            <span id="final_price">{{Auth::user()->phone}}</span>
          </p>
          <p class="d-flex total-price">
            <span>Address</span>
            <span id="final_price">{{$order->address}}</span>
          </p>
        </div>
        
      </div>

    </div>

  </div>
</section>



 
@stop