
<!doctype html >
<html lang="en" class="h-100">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('/') }}/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('/') }}/css/style.css">
    <link rel="stylesheet" href="{{ asset('/') }}/css/all.css">
    <link rel="stylesheet" href="{{ asset('/') }}/css/dropify.min.css">

    <title>SHOPPING BAZAR</title>
  </head>
  <body class="d-flex flex-column h-100">
    <header class="" id="header">
        <nav class="navbar navbar-expand-sm navbar-light fixed-top " style="background-color:#ff5722d9!important;">
            <div class="container">
                <a class="navbar-brand font-weight-bold text-primary" href="#"><img src="{{asset('/')}}/images/logo.ico" style="width:50px;height:50px;" alt=""/>SHOPPING BAZAR</a>
                <div class="collapse navbar-collapse" id="menuBar">
                    <ul class="navbar-nav ml-auto">
                        
                        <li class="nav-item">
                            <a class="nav-link text-light" href="{{route('/')}}">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-light" href="myShop.php">Shop </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-light" href="#">Hot Deal </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-light" href="#">Upcomming </a>
                        </li>
                        @guest
                        <li class="nav-item btn-group">
                            <a class="btn btn-primary px-3" href="{{ route('login') }}" id="logIn">LogIn</a>
                            @if (Route::has('register'))
                            <a class="btn btn-info px-2" href="{{ route('register') }}">Register</a>
                            @endif
                        </li>
                        @else
                            <li class="nav-item btn btn-primary btn-sm dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <button class="dropdown-item btn btn-secondary btn-sm" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </button>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                       
                    </ul>


                    
                </div>

  
            </div>
        </nav>

    </header>

    <main class=""  style="margin-top:100px ">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-2">
                    @if(Auth::user()->email_verified_at !=null)
                    @include('backend.sidebar')
                    @endif
                </div>
                <div class="col-sm-10">
                    @yield('content')
                </div>
            </div>
        </div>
        
    </main>

        <footer class="footer alert  text-center alert-secondary alert mt-auto py-3 mb-0">
            <div class="container">
                <span class="text-muted">&copy roydebbrota@gmail.com</span>
            </div>
        </footer>
              <!-- axios  -->
        <script src="{{ asset('/') }}/js/axios.min.js"></script>
        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="{{ asset('/') }}/js/jquery-3.4.1.js"></script>
        <script src="{{ asset('/') }}/js/popper.min.js"></script>
        <script src="{{ asset('/') }}/js/bootstrap.min.js"></script>
        <script src="{{ asset('/') }}/js/dropify.min.js"></script>
        <script>
          $('.image').on('change',function(e){
            //get the file name
            var fileName = e.target.files[0].name;
            //replace the "Choose a file" label
            $(this).next('.custom-file-label').html(fileName);
        });
        </script>
        @stack('scripts')
        
        
      </body>
    </html>