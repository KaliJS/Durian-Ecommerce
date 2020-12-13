<!DOCTYPE html>
<html>
<head>
  <!-- Basic Page Info -->
  <meta charset="utf-8">
  <title>Admin Panel</title>

  <!-- Site favicon -->
  <link rel="apple-touch-icon" sizes="180x180" href="vendors/images/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="vendors/images/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="vendors/images/favicon-16x16.png">

  <!-- Mobile Specific Metas -->
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

  <!-- Google Font -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
  <!-- CSS -->
  <link rel="stylesheet" type="text/css" href="{{asset('/vendors/styles/core.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('/vendors/styles/icon-font.min.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('/src/plugins/datatables/css/dataTables.bootstrap4.min.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('/src/plugins/datatables/css/responsive.bootstrap4.min.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('/vendors/styles/style.css')}}">
  

  <!-- switchery css -->
  <link rel="stylesheet" type="text/css" href="{{asset('src/plugins/switchery/switchery.min.css')}}">
  <!-- bootstrap-tagsinput css -->
  <link rel="stylesheet" type="text/css" href="{{asset('src/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css')}}">
  <!-- bootstrap-touchspin css -->
  <link rel="stylesheet" type="text/css" href="{{asset('src/plugins/bootstrap-touchspin/jquery.bootstrap-touchspin.css')}}">
 



  <!-- Global site tag (gtag.js) - Google Analytics -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=UA-119386393-1"></script>
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'UA-119386393-1');
  </script>
  
</head>

@yield('css')
<body>
  <!--<div class="pre-loader">
    <div class="pre-loader-box">
      
      <div class='loader-progress' id="progress_div">
        <div class='bar' id='bar1'></div>
      </div>
      <div class='percent' id='percent1'>80%</div>
      <div class="loading-text">
        Loading...
      </div>
    </div>
  </div>-->

        @include('includes.header')

    
    

      @include('includes.sidebar')
        <div class="mobile-menu-overlay"></div>
          <div class="main-container">
            <div class="pd-ltr-20">

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

        @include('includes.footer')


      <!-- End Footer-->
    </div>
  </div>
  <!-- js -->
  <script src="{{asset('/vendors/scripts/core.js')}}"></script>
  <script src="{{asset('/vendors/scripts/script.min.js')}}"></script>
  <script src="{{asset('/vendors/scripts/process.js')}}"></script>
  <script src="{{asset('/vendors/scripts/layout-settings.js')}}"></script>
  <script src="{{asset('/src/plugins/apexcharts/apexcharts.min.js')}}"></script>
  <script src="{{asset('/src/plugins/datatables/js/jquery.dataTables.min.js')}}"></script>
  <script src="{{asset('/src/plugins/datatables/js/dataTables.bootstrap4.min.js')}}"></script>
  <script src="{{asset('/src/plugins/datatables/js/dataTables.responsive.min.js')}}"></script>
  <script src="{{asset('/src/plugins/datatables/js/responsive.bootstrap4.min.js')}}"></script>
  <script src="{{asset('/vendors/scripts/dashboard.js')}}"></script>

  <!-- switchery js -->
  <script src="{{asset('src/plugins/switchery/switchery.min.js')}}"></script>
  <!-- bootstrap-tagsinput js -->
  <script src="{{asset('src/plugins/bootstrap-tagsinput/bootstrap-tagsinput.js')}}"></script>
  <!-- bootstrap-touchspin js -->
  <script src="{{asset('src/plugins/bootstrap-touchspin/jquery.bootstrap-touchspin.js')}}"></script>
  <script src="{{asset('vendors/scripts/advanced-components.js')}}"></script>
  <!-- Datatable Setting js -->
  <script src="{{asset('vendors/scripts/datatable-setting.js')}}"></script>
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

  <script type="text/javascript">
      $(document).ready(function() {
          $('select').select2();
      });
    </script>
    @yield('js')
</body>
</html>
