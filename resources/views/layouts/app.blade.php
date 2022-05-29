<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/fontawesome.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/all.min.css" />

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <style>
        .nav-link {
            color: white;
        }
        .fa {
            margin-right: 4px;
        }
        .nav-link:hover {
            color: silver;
            transform: scale(1.1);
        }
    </style>

</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md bg-dark shadow-sm"> 
        <!--<nav class="navbar navbar-expand-md shadow-sm" style="background-color: #001133">-->
            <div class="container text-white">
                    Dashboard
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                      
                        @can('admin-routes')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.users.index') }}"><i class="fa fa-user"></i>{{ __('users') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.languages.index') }}"><i class="fa fa-language"></i>{{ __('languages') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.courses.index') }}"><i class="fa fa-book"></i>{{ __('courses') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.courses.purchased_courses') }}"><i class="fa fa-book"></i>{{ __('purchased courses') }}</a>
                        </li>
                        @endcan
                        @can('teacher-routes')
                       
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('teacher.quiz.index') }}"><i class="fa fa-check"></i>{{ __('quiz') }}</a>
                        </li>
                       
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('teacher.quiz.qa-create') }}"><i class="fa fa-question"></i>{{ __('questions/answers') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('teacher.lessons.index') }}"><i class="fa fa-file"></i>{{ __('lessons') }}</a>
                        </li>
                        @endcan

                        @can('user-routes')
                        @foreach (App\Models\Language::getLanguages() as $language)
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('user.quiz.language.id', $language->id) }}">{{ $language->name }}</a>
                            </li>
                        @endforeach
            
                        @endcan
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
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
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->first_name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
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
            </div>
        </nav>

        <main class="py-4" style="min-height: 100vh">
            @yield('content')
        </main>
    </div>
    @extends('layouts.footer')
</body>
</html>
