<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Vegefoods - Free Bootstrap 4 Template by Colorlib</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lora:400,400i,700,700i&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Amatic+SC:400,700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link rel="stylesheet" href="{{asset('/shopping/css/open-iconic-bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('/shopping/css/animate.css')}}">
    
    <link rel="stylesheet" href="{{asset('/shopping/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('/shopping/css/owl.theme.default.min.css')}}">
    <link rel="stylesheet" href="{{asset('/shopping/css/magnific-popup.css')}}">

    <link rel="stylesheet" href="{{asset('/shopping/css/aos.css')}}">

    <link rel="stylesheet" href="{{asset('/shopping/css/ionicons.min.css')}}">

    <link rel="stylesheet" href="{{asset('/shopping/css/bootstrap-datepicker.css')}}">
    <link rel="stylesheet" href="{{asset('/shopping/css/jquery.timepicker.css')}}">

    
    <link rel="stylesheet" href="{{asset('/shopping/css/flaticon.css')}}">
    <link rel="stylesheet" href="{{asset('/shopping/css/icomoon.css')}}">
    <link rel="stylesheet" href="{{asset('/shopping/css/style.css')}}">

    <link rel="stylesheet" href="{{asset('/slider/css/main.css')}}">

    @yield('css')

  </head>
  <body class="goto-here">
    <div class="py-1 bg-primary">
      <div class="container">
        <div class="row no-gutters d-flex align-items-start align-items-center px-md-0">
          <div class="col-lg-12 d-block">
            <div class="row d-flex">
              <div class="col-md pr-4 d-flex topper align-items-center">
                <div class="icon mr-2 d-flex justify-content-center align-items-center"><span class="icon-phone2"></span></div>
                <span class="text">+ 1235 2355 98</span>
              </div>
              <div class="col-md pr-4 d-flex topper align-items-center">
                <div class="icon mr-2 d-flex justify-content-center align-items-center"><span class="icon-paper-plane"></span></div>
                <span class="text">youremail@email.com</span>
              </div>
              <div class="col-md-5 pr-4 d-flex topper align-items-center text-lg-right">
                <span class="text">3-5 Business days delivery &amp; Free Returns</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

        @include('includes.shopping.header')

    
        
          

            <div class="my-3">
              @if ($message = Session::get('success'))
                  <div class="alert alert-success text-center">
                      <p class="mb-0">{{ $message }}</p>
                  </div>
              @endif
              @if ($message = Session::get('error'))
                  <div class="alert alert-danger text-center">
                      <p class="mb-0">{{ $message }}</p>
                  </div>
              @endif


              @if($errors->any())
                {!! implode('', $errors->all('<div class="alert alert-danger">:message</div>')) !!}
              @endif
            </div>



            @yield('content')
          

        <!--Footer-->

        @include('includes.shopping.footer')


      <!-- End Footer-->
    

  <!-- loader -->
  <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>


  <script src="{{asset('/shopping/js/jquery.min.js')}}"></script>
  <script src="{{asset('/shopping/js/jquery-migrate-3.0.1.min.js')}}"></script>
  <script src="{{asset('/shopping/js/popper.min.js')}}"></script>
  <script src="{{asset('/shopping/js/bootstrap.min.js')}}"></script>
  <script src="{{asset('/shopping/js/jquery.easing.1.3.js')}}"></script>
  <script src="{{asset('/shopping/js/jquery.waypoints.min.js')}}"></script>
  <script src="{{asset('/shopping/js/jquery.stellar.min.js')}}"></script>
  <script src="{{asset('/shopping/js/owl.carousel.min.js')}}"></script>
  <script src="{{asset('/shopping/js/jquery.magnific-popup.min.js')}}"></script>
  <script src="{{asset('/shopping/js/aos.js')}}"></script>
  <script src="{{asset('/shopping/js/jquery.animateNumber.min.js')}}"></script>
  <script src="{{asset('/shopping/js/bootstrap-datepicker.js')}}"></script>
  <script src="{{asset('/shopping/js/scrollax.min.js')}}"></script>
  <script src="{{asset('/shopping/js/main.js')}}"></script>

  <script src="{{asset('/slider/scripts/zoom-image.js')}}"></script>
  <script src="{{asset('/slider/scripts/main.js')}}"></script>

  @yield('js')
    
  </body>
</html>
