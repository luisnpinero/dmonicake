<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Luis Piñero">
    <link rel="icon" type="image/png" href="https://i.postimg.cc/Gtrdvvrj/2.png">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') - {{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    @yield('css.store')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/mystyles.css') }}" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
    @yield('css')

</head>

<body>
    <div id="app" style="min-height: 92.7vh">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}"></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        <li>
                            <a title="Carrito" class="nav-link" href="{{ route('carts.index') }}">
                                @inject('cartService', 'App\Services\CartService')
                                <i class="fas fa-shopping-cart fas-icon-light"></i>({{ $cartService->countProducts() }}) Carrito
                            </a>
                        </li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        <li class="nav-item active">
                            <a class="nav-link" href="{{ route('root') }}">Home
                                <span class="sr-only">(current)</span>
                            </a>
                        </li>
                        
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('aboutus')}}">Acerca de</a>
                        </li>
                        
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('store.index')}}">Tienda</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{url('contact')}}">Contacto</a>
                        </li>
                        
                        @guest
                        @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @endif
                        
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Registrate') }}</a>
                            </li>
                        @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->first_name }}
                                </a>
                                
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('profile.index')}}">
                                        Perfil
                                    </a>
                                    @if (optional(auth()->user())->isAdmin())
                                    <a class="dropdown-item" href="{{ route('dashboard.index')}}">
                                        Admin Panel
                                    </a>
                                    @endif
                                    
                                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
            
        <main class="pb-4">
            {{-- <div class="container-fluid">
                @if (session()->has('success'))
                <div class="alert alert-success mt-4">
                    {{ session()->get('success') }}
                </div>
                @endif
                
                @if (isset($errors) && $errors->any())
                <div class="alert alert-danger mt-4">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
            </div> --}}
            
            @yield('content')
        </main>

    </div>
</body>

    <footer class="mt-6 py-4 bg-white">
        <div class="container">
            <p class="m-0 text-center text-white">Copyright &copy; Luis Piñero 2021</p>
        </div>
    <!-- /.container -->
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    @yield('script')        
</html>
