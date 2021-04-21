<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

        <style>
            button:focus {
                outline: 0;
            }

            .navbar .dropdown-menu .form-control {
                width: 200px;
            }

            /* Sticky footer styles
-------------------------------------------------- */

.footer {
  position: position: fixed;;
  bottom: 0;
  width: 100%;
  height: 60px; /* Set the fixed height of the footer here */
  line-height: 60px; /* Vertically center the text there */
  background-color: rgb(248,249,250);
}


/* Custom page CSS
-------------------------------------------------- */
/* Not required for template or sticky footer method. */


            
        </style>

        @livewireStyles
    </head>
    <body style="background-color: rgb(243,244,246);">

        <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top shadow-sm" role="navigation">
            <div class="container">
                <a class="navbar-brand" href="/">
                    <img src="{{ asset('images/ider.png') }}" alt="" height="50">
                </a>
                <button class="navbar-toggler border-0" type="button" data-toggle="collapse" data-target="#exCollapsingNavbar">
                    &#9776;
                </button>
                <div class="collapse navbar-collapse" id="exCollapsingNavbar">
                    {{-- <ul class="nav navbar-nav">
                        <li class="nav-item"><a href="#" class="nav-link">About</a></li>
                        <li class="nav-item"><a href="#" class="nav-link">Link</a></li>
                        <li class="nav-item"><a href="#" class="nav-link">Service</a></li>
                        <li class="nav-item"><a href="#" class="nav-link">More</a></li>
                    </ul> --}}
                    <ul class="nav navbar-nav flex-row justify-content-between ml-auto">
                        @if (Route::has('login'))
                            {{-- <li class="nav-item order-2 order-md-1"><a href="#" class="nav-link" title="settings"><i class="fa fa-cog fa-fw fa-lg"></i></a></li> --}}
                            <li class="dropdown order-1">
                                {{-- <button type="button" id="dropdownMenu1" data-toggle="dropdown" class="btn btn-outline-secondary dropdown-toggle">Ingresar <span class="caret"></span></button> --}}
                                @auth
                                    
                                    <a href="{{ route('admin.home') }}" class="btn btn-light">
                                        Dashboard
                                    </a>
                                @else
                                    

                                    <a href="{{ route('login') }}" class="btn btn-light">
                                        Ingresar
                                    </a>
                                @endauth
                                
                                {{-- <ul class="dropdown-menu dropdown-menu-right mt-2">
                                <li class="px-3 py-2">
                                    <form class="form" role="form">
                                            <div class="form-group">
                                                <input id="emailInput" placeholder="Email" class="form-control form-control-sm" type="text" required="">
                                            </div>
                                            <div class="form-group">
                                                <input id="passwordInput" placeholder="Password" class="form-control form-control-sm" type="text" required="">
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-primary btn-block">Login</button>
                                            </div>
                                            <div class="form-group text-center">
                                                <small><a href="#" data-toggle="modal" data-target="#modalPassword">Forgot password?</a></small>
                                            </div>
                                        </form>
                                    </li>
                                </ul> --}}
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>
        

        <livewire:table.table name="guest" :model="$file">

        <footer class="footer">
            <div class="container text-center">
                <p style="font-size: 11px; color: rgb(102,102,102)" class="font-weight-normal">IDER Loreto - 2021</p>
            </div>
        </footer>
        @livewireScripts
        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    </body>
</html>
