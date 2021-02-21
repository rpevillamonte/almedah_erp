<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'ALMEDAH ERP') }}</title>






    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap">

    <!-- Custom Styles CDN-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pretty-checkbox@3.0/dist/pretty-checkbox.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">




    <!-- Custom Styles CSS-->
    <!--<link href="{{ asset('css/app.css')}}" rel="stylesheet">-->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/custom-sidenav.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom-inbox.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom-inventory.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom-main.css') }}">

    <!-- Select Tag w/ Search Scripts Plugin-->
    <link defer rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>



    <!-- Custom JS CDN-->
    <script src="https://www.gstatic.com/charts/loader.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>

    <!--Data Table Plugin-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css" rel="stylesheet" type="text/css">
    <link href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css">
    <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.23/js/dataTables.bootstrap4.min.js"></script>

    <!--Custom Styling-->
    <link rel="stylesheet" href="{{ asset('css/custom.css')}}">


</head>

<body>
    <div id="app" class="custom-secondary-bgcolor">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="nav-responsive m-2">
                <a href="#" class="navbar-brand">
                    <img class="img-fluid" src="{{asset('images/almedah-logo.png')}}" width="330">
                </a>
            </div>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
                <ul class="navbar-nav font-weight-bolder">
                    <!-- Authentication Links -->
                    @guest
                    @if (Route::has('login'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    @endif

                    @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                    </li>
                    @endif
                    @else

                    <li class="m-2 mr-3">
                        <ul class="navbar-nav font-weight-bolder">
                            <li class="nav-item dropdown">
                                <button class="btn btn-outline-dark" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-clipboard-list p-2"></i>
                                    Quick Access
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="/home">
                                        <!--<i class="fas fa-arrow-alt-circle-down" aria-hidden="true"></i>-->
                                        <span class="nav-labels">Home</span>
                                    </a>
                                    <a class="dropdown-item" href="/outgoing">
                                        <!--<i class="fas fa-arrow-alt-circle-down" aria-hidden="true"></i>-->
                                        <span class="nav-labels">MENU 2</span>
                                    </a>
                                </div>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item m-2">
                        <div class="dropdown bg-light position-relative notification-dropdown notification-111 d-flex align-items-center" id="notification-user">
                            <input type="hidden" id="notif_count" value="0">
                            <button class="notification-trigger bg-light" href="#notification" type="button" id="notificationButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="h2 text-dark mb-0">
                                    <i class="fas fa-bell"></i>
                                </span>
                                <span class="badge badge-light notif-count">
                                    0
                                </span>
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="notificationButton">
                                <li class="dropdown-item view-notifications">
                                    <a href="#" class="d-block text-pallete-004b23 pt-4 pb-4">
                                        <u><strong>Sample Notification</strong></u>
                                        <span class="d-inline-block ml-2"><i class="fas fa-arrow-right"></i></span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>


                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle text-dark" id="navbarDropdownMenuUser" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img class="user-avatar " src="{{ asset('storage/'.auth()->user()->profile_picture) }}" onerror='this.onerror=null;this.src="{{ auth()->user()->profile_picture }}"' width="36px" height="36px">
                            {{ auth()->user()->firstname }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('profile') }}" >
                                {{ __('Profile') }}
                            </a>
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
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

        </nav>
        <main>
            @yield('content')
        </main>
        <!--

        -->
    </div>
    <footer class="footer navbar-dark navbar-bg">
        <div class="text-center p-3 text-light" style="background-color: rgba(0, 0, 0, 0.2)">
            ALMEDAH ERP SYSTEM © 2021 COPYRIGHT
        </div>
    </footer>
</body>

</html>