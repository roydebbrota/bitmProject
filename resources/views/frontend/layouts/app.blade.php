
<!doctype html >
<html lang="en" class="h-100">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('/') }}/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('/') }}/css/style.css">
    <link rel="stylesheet" href="{{ asset('/') }}/css/all.css">
    <link rel="stylesheet" href="{{ asset('/') }}/css/jquery-ui.css">
    <link rel="stylesheet" href="{{ asset('/') }}/css/bootstrap-theme.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.css">
    

    <title>@yield('title')</title>
  </head>
  <body class="d-flex flex-column h-100">
    <header class="" id="header">
        <nav class="navbar navbar-expand-sm navbar-light fixed-top " style="background-color:#ff5722d9!important;">
            <div class="container">
                <a class="navbar-brand font-weight-bold text-primary" href="#"><img src="images/logo.ico" style="width:50px;height:50px;" alt=""/>SHOPPING BAZAR</a>
                <div class="collapse navbar-collapse" id="menuBar">
                    <ul class="navbar-nav ml-auto">
                        
                        <li class="nav-item">
                            <a class="nav-link text-light" href="{{Auth::user()?url('/home') :url('/')}}">{{Auth::user()?'Dashboard' :'Home'}} </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-light" href="#">Shop </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-light" href="#">Hot Deal </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link text-light p-1 mr-2" href="#" data-toggle="dropdown">
                                <button class="btn btn-primary"><i class="fas fa-{{Session::has('cartProductList') && count(session('cartProductList'))>0 ? 'cart-plus' : 'shopping-cart'}} "></i><span class="badge badge-light">{{Session::has('cartProductList') ? count(session('cartProductList')) : 0 }} </span>
                                </button>
                            </a>
                            @if(Session::has('cartProductList') && count(session('cartProductList'))>0)

                            <a class="dropdown-menu dropdown-menu-right w-250 text-decoration-none" href="{{url('shop/product/cart-details')}}" style="min-width: 250px">
                                <ul class="list-group list-group-flush">
                                    @php 
                                        $grandTotal =0;
                                    @endphp
                                    @foreach(collect(session('cartProductList')) as $cartData)
                                        <li class="list-group-item p-1">
                                            <table class="table table-sm table-borderless mb-0">
                                                <tr>
                                                    <td rowspan="2" class="align-middle">
                                                        <img src="{{$cartData['image'] ? asset('/').'../storage/app/'.$cartData['image'] : asset('/').'images/user/user.jpg'}}" width="50">
                                                    </td>
                                                    <td colspan="3" class="text-center">
                                                        {{$cartData['name']}}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <span class="text-muted small">Qty</span><br>
                                                        {{$cartData['quantity']}}
                                                    </td>
                                                    <td>
                                                        <span class="text-muted small">Price</span><br>
                                                        {{$cartData['price']}}
                                                    </td>
                                                    <td>
                                                        <span class="text-muted small">T.Price</span><br>
                                                        {{$total = $cartData['price']*$cartData['quantity']}}
                                                    </td>
                                                </tr>
                                            </table>
                                        </li>
                                        @php 
                                        $grandTotal +=$total;
                                    @endphp
                                    @endforeach
                                    <li class="list-group-item text-right">
                                        Grand Total = {{$grandTotal}}/-BDT
                                    </li>
                                </ul>
                            </a>
                            @endif
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
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

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


    <main class=""  style="margin-top:75px ">
        @yield('content')
    </main>
        <footer class="footer alert  text-center alert-secondary alert mt-auto py-3 mb-0">
            <div class="container">
                <span class="text-muted">&copy Place sticky footer content here.</span>
            </div>
        </footer>

        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
        <script src="{{ asset('/') }}/js/jquery-3.4.1.js"></script>
        <script src="{{ asset('/') }}/js/popper.min.js"></script>
        <script src="{{ asset('/') }}/js/bootstrap.min.js"></script>
        <script src="{{ asset('/') }}/js/jquery.bootstrap.newsbox.min.js"></script>
        <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.js"></script>

        @stack('customJs')

        <script type="text/javascript">
            $(function () {
            $(".demo").bootstrapNews({
            newsPerPage: 4,
            navigation:true,
            autoplay:true,
            direction:'up',// up or down
            animationSpeed:'normal',
            newsTickerInterval: 4000,//4 secs
            pauseOnHover:true,
            onStop:null,
            onPause:null,
            onReset:null,
            onPrev:null,
            onNext:null,
            onToDo:null
            });
            });
            </script>

        <script src="{{ asset('/') }}/js/jquery-ui.js"></script>
        @stack('scripts')
      </body>
    </html>