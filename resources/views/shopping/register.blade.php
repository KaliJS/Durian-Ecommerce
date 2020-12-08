@extends('layouts.index')
@section('css')

<style type="text/css">
    .mouse-icon{
        display: none;
    }
</style>

@stop

@section('content')


    <section class="ftco-section py-4">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-xl-7 ftco-animate">
            <form class="billing-form" action="{{route('register.store')}}" method="POST">
              @csrf
              <h3 class="mb-4 billing-heading">Register</h3>
              <div class="row align-items-end">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="firstname">First Name</label>
                    <input type="text" name="firstname" class="form-control" placeholder="First Name" required>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="lastname">Last Name</label>
                    <input type="text" name="lastname" class="form-control" placeholder="Last Name" required>
                  </div>
                </div>

                <div class="w-100"></div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="firstname">Email Address</label>
                    <input type="email" name="email" class="form-control" placeholder="Email" required>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="lastname">Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Password" required>
                  </div>
                </div>
               
                <div class="w-100"></div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="streetaddress">Street Address</label>
                    <input type="text" class="form-control" name="address1" placeholder="House number and street name" required>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <input type="text" class="form-control" name="address2" placeholder="Appartment, unit etc: (optional)">
                  </div>
                </div>
                <div class="w-100"></div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="towncity">Town / City</label>
                    <input type="text" name="city" class="form-control" placeholder="Town / City" required>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="postcodezip">Postcode / ZIP *</label>
                    <input type="number" name="pincode" class="form-control" placeholder="Postcode" required>
                  </div>
                </div>
                <div class="w-100"></div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="phone">Phone</label>
                    <input type="number" name="phone" class="form-control" placeholder="Phone" required>
                  </div>
                </div>
                
                <div class="w-100"></div>
                <button type="submit" class="btn btn-primary">
                    Register
                </button>
              </div>
            </form><!-- END -->
          </div>
          
        </div>
      </div>
    </section>
  

@stop


@section('js')

        <script type="text/javascript">


            
        </script>

@stop