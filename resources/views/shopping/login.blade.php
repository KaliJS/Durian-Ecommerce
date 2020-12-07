@extends('layouts.index')
<style type="text/css">

</style>


@section('content')





   
    <section class="ftco-section contact-section bg-light py-5">
      <div class="container">
        <div class="row block-9">
          <div class="col-md-6 d-flex mx-auto">


            <form action="#" class="bg-white p-5 contact-form">
              
              <div class="form-group">
                <input type="email" class="form-control" placeholder="Your Email">
              </div>
              <div class="form-group">
                <input type="password" class="form-control" placeholder="Password">
              </div>
             
              <div class="form-group">
                <button type="submit" class="btn btn-primary py-2 px-3">Login</button>
              </div>

              <div class="pt-3">
                <a class="" href="{{url('/register')}}">Do not account?</a>
              </div>

            </form>

            


          </div>         
        </div>
      </div>
    </section>
   

  

@stop


@section('js')


@stop