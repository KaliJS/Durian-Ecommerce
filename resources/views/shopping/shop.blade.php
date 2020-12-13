@extends('layouts.index')


@section('content')

    
	<div class="hero-wrap hero-bread" style="background-image: url({{url('uploads/banners/'.$header->image)}});">
      <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
          <div class="col-md-9 ftco-animate text-center">
          	<p class="breadcrumbs"><span class="mr-2"><a href="{{url('/')}}">Home</a></span> <span>Products</span></p>
            <h1 class="mb-0 bread">Products</h1>
          </div>
        </div>
      </div>
    </div>

    <section class="ftco-section">

      <div class="container">
        <div class="row justify-content-center mb-3 pb-3">
          <div class="col-md-12 heading-section text-center ftco-animate">
              <h3 class="mb-4">
                  @if(isset($category))
                    {{$category->name}}
                    @else
                    All Products
                  @endif
              </h3>
            </div>
        </div>      
      </div>

    	<div class="container">
    		
    		<div class="row">

    			
    			@foreach($products as $product)
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
    						<h3><a href="{{url('/product/'.$product->slug)}}">{{$product->name}}</a></h3>
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
    		<div class="row mt-5">
	          <div class="col text-center">

	            <div class="block-27">

	            	{{ $products->links('vendor.pagination.custom') }}

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
   

@stop