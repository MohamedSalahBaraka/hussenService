<!DOCTYPE html>
<html lang="en" dir="rtl">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="{{ asset('css/bootstrap.rtl.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
    <title>{{ config('app.name', 'Laravel') }}</title>
    @yield('css')
</head>
<?php
use Illuminate\Support\Facades\Auth;
use App\Models\Notification;
?>

<body>
    <div class="container">
        <header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom">
            <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none">
                <img class="bi me-2" width="40" height="32" src="{{ asset('images/R.png') }}" alt=""
                    width="720" />
                <span class="fs-4">{{ config('app.name', 'Laravel') }}</span>
            </a>

            <ul class="nav nav-pills">

                @guest('admin')
                        @guest()
                        <li class="nav-item">
                            <a class="text-muted nav-link" href="{{ route('services') }}">
                                الخدمات
                            </a>
                        </li>
                            <li class="nav-item ">
                                <a class="text-muted nav-link" href="{{ route('login') }}" role="button">
                                    سجل دخولك
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a class="text-muted nav-link" href="{{ route('register.User.show') }}" role="button">
                                    انشئ حساباً
                                </a>
                            </li>
                        @endguest
                @endguest
                @auth
                @if (auth()->user()->type == 'user')
                <li class="nav-item">
                    <a class="text-muted nav-link" href="{{ route('services') }}">
                        الخدمات
                    </a>
                </li>
                @endif
                    <li class="nav-item dropdown">
                        <a class="text-muted nav-link" href="# " role="button" data-bs-toggle="dropdown">
                            <svg class="bi" width="24" height="24" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 448 512">
                                <!--! Font Awesome Pro 6.2.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                                <path
                                    d="M224 256c70.7 0 128-57.3 128-128S294.7 0 224 0S96 57.3 96 128s57.3 128 128 128zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512H418.3c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304H178.3z" />
                            </svg>
                        </a>
                        <ul class="dropdown-menu position-absoulte gap-1 p-2 rounded-3 mx-0 shadow w-220px">
                            <li>
                                <a class="dropdown-item rounded-2" @if (auth()->user()->type == 'user')
                                    href="{{ route('user.profile') }}"
                                    @else
                                    href="{{ route('provider.profile') }}"
                                @endif >الصفحة الشخصية</a>
                            </li>
                            <li>
                                <a class="dropdown-item rounded-2" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">تسجيل
                                    خروج</a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </li>
                @endauth
                @auth('admin')
                    <li class="nav-item dropdown">
                        <a class="text-muted nav-link" href="# " role="button" data-bs-toggle="dropdown">
                            <svg class="bi" width="24" height="24" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 448 512">
                                <!--! Font Awesome Pro 6.2.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                                <path
                                    d="M224 256c70.7 0 128-57.3 128-128S294.7 0 224 0S96 57.3 96 128s57.3 128 128 128zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512H418.3c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304H178.3z" />
                            </svg>
                        </a>
                        <ul class="dropdown-menu position-absoulte gap-1 p-2 rounded-3 mx-0 shadow w-220px">
                            <li>
                                <a class="dropdown-item rounded-2" href="{{ route('admin.profile') }}">الصفحة
                                    الشخصية</a>
                            </li>
                            <li>
                                <a class="dropdown-item rounded-2" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">تسجيل
                                    خروج</a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </li>
                @endauth

                @auth
                    <?php

                    $notifications = Notification::where('user_id', Auth::id())
                        ->where('status', 0)
                        ->get();
                    ?>
                    <li class="nav-item dropdown">
                        <a class="text-muted nav-link {{ $notifications->count() != 0 ? 'notify' : '' }}"
                            count="{{ $notifications->count() }}" href="#" role="button"
                            data-bs-toggle="dropdown">
                            <svg class="bi" width="24" height="24" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 320 512">
                                <!--! Font Awesome Pro 6.2.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                                <path
                                    d="M224 0c-17.7 0-32 14.3-32 32V51.2C119 66 64 130.6 64 208v18.8c0 47-17.3 92.4-48.5 127.6l-7.4 8.3c-8.4 9.4-10.4 22.9-5.3 34.4S19.4 416 32 416H416c12.6 0 24-7.4 29.2-18.9s3.1-25-5.3-34.4l-7.4-8.3C401.3 319.2 384 273.9 384 226.8V208c0-77.4-55-142-128-156.8V32c0-17.7-14.3-32-32-32zm45.3 493.3c12-12 18.7-28.3 18.7-45.3H224 160c0 17 6.7 33.3 18.7 45.3s28.3 18.7 45.3 18.7s33.3-6.7 45.3-18.7z" />
                            </svg>
                        </a>
                        <ul class="dropdown-menu position-absoulte gap-1 p-2 rounded-3 mx-0 shadow w-220px">
                            @foreach ($notifications as $notification)
                                <li>
                                    <a class="dropdown-item rounded-2" href="#">{{ $notification->content }}</a>
                                </li>
                            @endforeach

                        </ul>
                    </li>
                @endauth
                <li class="nav-item">
                    <button class="btn text-muted" onclick="history.back()">
                        <svg class="bi" width="34" height="24" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                            <!--! Font Awesome Pro 6.2.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                            <path
                                d="M177.5 98c-8.8-3.8-19-2-26 4.6l-144 136C2.7 243.1 0 249.4 0 256s2.7 12.9 7.5 17.4l144 136c7 6.6 17.2 8.4 26 4.6s14.5-12.5 14.5-22l0-88 288 0c17.7 0 32-14.3 32-32l0-32c0-17.7-14.3-32-32-32l-288 0 0-88c0-9.6-5.7-18.2-14.5-22z" />
                        </svg>
                    </button>
                </li>
            </ul>
        </header>
    </div>
    <div class="container">
        @yield('content')
    </div>
    <div class="container">
        <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
            <div class="col-md-4 d-flex align-items-center">
                <a href="/" class="mb-3 me-2 mb-md-0 text-muted text-decoration-none lh-1">
                    <svg class="bi" width="30" height="24">
                        <use xlink:href="#bootstrap" />
                    </svg>
                </a>
                <span class="mb-3 mb-md-0 text-muted">&copy; 2022 {{ config('app.name', 'Laravel') }}</span>
            </div>

            <ul class="nav col-md-4 justify-content-end list-unstyled d-flex">
                <li class="ms-3">
                    <a class="text-muted" href="#">
                        <svg class="bi" width="24" height="24" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 512 512">
                            <!--! Font Awesome Pro 6.2.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                            <path
                                d="M459.37 151.716c.325 4.548.325 9.097.325 13.645 0 138.72-105.583 298.558-298.558 298.558-59.452 0-114.68-17.219-161.137-47.106 8.447.974 16.568 1.299 25.34 1.299 49.055 0 94.213-16.568 130.274-44.832-46.132-.975-84.792-31.188-98.112-72.772 6.498.974 12.995 1.624 19.818 1.624 9.421 0 18.843-1.3 27.614-3.573-48.081-9.747-84.143-51.98-84.143-102.985v-1.299c13.969 7.797 30.214 12.67 47.431 13.319-28.264-18.843-46.781-51.005-46.781-87.391 0-19.492 5.197-37.36 14.294-52.954 51.655 63.675 129.3 105.258 216.365 109.807-1.624-7.797-2.599-15.918-2.599-24.04 0-57.828 46.782-104.934 104.934-104.934 30.213 0 57.502 12.67 76.67 33.137 23.715-4.548 46.456-13.32 66.599-25.34-7.798 24.366-24.366 44.833-46.132 57.827 21.117-2.273 41.584-8.122 60.426-16.243-14.292 20.791-32.161 39.308-52.628 54.253z" />
                        </svg>
                    </a>
                </li>
                <li class="ms-3">
                    <a class="text-muted" href="#">
                        <svg class="bi" width="24" height="24" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 448 512">
                            <!--! Font Awesome Pro 6.2.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                            <path
                                d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.1s-34.4 58-36.2 93.9c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.7 102.7-9 132.1z" />
                        </svg>
                    </a>
                </li>
                <li class="ms-3">
                    <a class="text-muted" href="#">
                        <svg class="bi" width="24" height="24" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 320 512">
                            <!--! Font Awesome Pro 6.2.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                            <path
                                d="M279.14 288l14.22-92.66h-88.91v-60.13c0-25.35 12.42-50.06 52.24-50.06h40.42V6.26S260.43 0 225.36 0c-73.22 0-121.08 44.38-121.08 124.72v70.62H22.89V288h81.39v224h100.17V288z" />
                        </svg>
                    </a>
                </li>
            </ul>
        </footer>
    </div>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script>
        $('.notify').on('click', function() {
            $.ajax({
                type: 'GET',
                url: '{{ URL::route('user.notification') }}',
                success: function(data) {
                    console.log('ok')
                }
            });
        });
    </script>
    @yield('js')
</body>

</html>
