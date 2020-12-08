    <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
        <div class="container">
          <a class="navbar-brand" href="{{url('/')}}">Vegefoods</a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="oi oi-menu"></span> Menu
          </button>

          <div class="collapse navbar-collapse" id="ftco-nav">
            <ul class="navbar-nav ml-auto">
              <li class="nav-item active"><a href="{{ url('/') }}" class="nav-link">Home</a></li>
              <li class="nav-item"><a href="{{ url('/shop') }}" class="nav-link">Shop</a></li>
              <li class="nav-item"><a href="{{ url('/category') }}" class="nav-link">Category</a></li>
              <li class="nav-item"><a href="#" class="nav-link">About</a></li>
              <li class="nav-item"><a href="#" class="nav-link">Contact</a></li>

              @if (Route::has('login'))
                
                  @auth
                    <li class="nav-item"><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"  class="nav-link"><i class="dw dw-logout"></i> {{ __('Logout') }}</a>
                      <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                      </form></li>
                  @else
                      <li class="nav-item"><a href="{{ route('login') }}" class="nav-link">Login</a></li>

                  @endauth
                
              @endif


              <li class="nav-item cta cta-colored"><a href="{{url('/cart')}}" class="nav-link"><span class="icon-shopping_cart" id="cart_count" style="font-size: 17px;">[{{session()->has('cart')?count(session()->get('cart')):"0"}}]</span></a></li>

            </ul>
          </div>
        </div>
      </nav>
    <!-- END nav -->

