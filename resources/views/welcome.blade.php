<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <!-- Scripts -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <!-- Styles -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
        <title>Laravel</title>
        
        @stack('scripts')
        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
            
            table,th,td{
                border: 0.5px solid;border-color:teal;
            }
            
            table,th{
                border-top: none;
                border-right: none;
                border-left: none;
            }

            td{
                border-right: none;
                border-left: none;
                border-bottom: 1px solid rgba(0, 0, 0, 0.5);
            }

            
    
            .dataTables_length{
                text-align:start !important;
            }
            .dataTables_filter{
                text-align:end !important;
            }

            .nav-link{
                color:white !important;
            }
            .nav-link.active{
                /* background-color: #0dcaf0 !important; */
                color:#0dcaf0 !important;
            }
        </style>
    </head>
    <body>
    @guest
        <div class="container d-flex align-items-center justify-content-center" style="height: 100vh;">
            <div class="row h-25 w-50">
                <div class="col-lg-6 offset-md-3">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label class="form-check-label" for="remember">
                                    {{ __('Remember Me') }}
                                </label>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">
                            {{ __('Login') }}
                        </button>
                        @if (Route::has('password.request'))
                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                            </a>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    @endguest

    @auth
    <nav class="navbar navbar-expand-lg bg-info">
        <div class="container-fluid d-flex justify-content-between">
            <button class="btn btn-light" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-border-width" viewBox="0 0 16 16">
                    <path d="M0 3.5A.5.5 0 0 1 .5 3h15a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.5.5H.5a.5.5 0 0 1-.5-.5v-2zm0 5A.5.5 0 0 1 .5 8h15a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5H.5a.5.5 0 0 1-.5-.5v-1zm0 4a.5.5 0 0 1 .5-.5h15a.5.5 0 0 1 0 1H.5a.5.5 0 0 1-.5-.5z"/>
                </svg>
            </button>

            <button type="button" class="btn btn-light" data-bs-toggle="modal" data-bs-target="#exampleModal">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-power" viewBox="0 0 16 16">
                    <path d="M7.5 1v7h1V1h-1z"/>
                    <path d="M3 8.812a4.999 4.999 0 0 1 2.578-4.375l-.485-.874A6 6 0 1 0 11 3.616l-.501.865A5 5 0 1 1 3 8.812z"/>
                </svg>
            </button>
        </div>
    </nav>

    {{-- <x-alert content="Yakin Mau Keluar?" :route="route('logout')" id="exampleModal" size="sm" /> --}}
    
    <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
        <div class="offcanvas-header" style="background-color:#04293A;">
            <h5 class="offcanvas-title" id="offcanvasExampleLabel">Menus</h5>
            <button type="button" data-bs-dismiss="offcanvas" aria-label="Close">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
                  </svg>
            </button>
        </div>
        <div class="offcanvas-body" style="background-color:#04293A;">
            <ul class="navbar-nav justify-content-end flex-grow-1 pe-3" style="color:white;">
                <li class="nav-item">
                  <a class="active nav-link" aria-current="page" href="{{ route('welcome') }}">Home</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="">Master Data</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('transaksi.index') }}">Transaksi</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="">Pesanan</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="">Laporan</a>
                </li>
            </ul>
        </div>
    </div>

    @yield('content')

    @endauth

    </body>
</html>
