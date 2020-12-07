@extends('layouts.index')


@section('content')

    
	<div class="hero-wrap hero-bread" style="background-image: url({{url('uploads/banners/'.$header->image)}});">
      <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
          <div class="col-md-9 ftco-animate text-center">
          	<p class="breadcrumbs"><span class="mr-2"><a href="{{url('/')}}">Home</a></span> <span>Home</span></p>
            <h1 class="mb-0 bread">Categories</h1>
          </div>
        </div>
      </div>
    </div>

    <div class="container">
        <div class="row justify-content-center mb-3 pb-3">
          <div class="col-md-12 heading-section text-center ftco-animate">
              <h3 class="my-4">
                  All Categories
              </h3>
            </div>
        </div>      
      </div>
    
    <section class="ftco-section ftco-category ftco-no-pt">
      <div class="container">
        <div class="row">
          
          @foreach($categories as $category)
          <div class="col-md-4">
            <div class="category-wrap ftco-animate img mb-4 d-flex align-items-end" style="background-image: url({{url('uploads/categories/'.$category->image)}});">
              <div class="text px-3 py-1">
                <h2 class="mb-0"><a href="{{url('/category/'.$category->slug)}}">{{$category->name}}</a></h2>
              </div>    
            </div>
          </div>
          @endforeach
            
        </div>
      </div>
    </section>
		
   

@stop