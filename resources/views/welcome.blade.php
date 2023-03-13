{{-- <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>BoolBnB</title>
    <link rel="shortcut icon" href="/storage/logo-boolbnb.png" type="image/png">

        <!-- Scripts -->
        @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    </head>
    <body>
        {{-- conatiner principale della pagina --}}
        {{-- <div id="app">
            {{-- header --}}
            {{-- <header> --}}
                {{-- <section class="ms_section_welcome_header">
                    <div class="container-fluid ms_nav_welcome">
                        {{-- logo pagina --}}
                        {{-- <div class="ms_ctn_logo d-flex justify-content-start align-items-center">
                            <div class="ms_slot_logo me-1">
                                <img src="/storage/logo-boolbnb.png" alt="logo_boolbnb">
                            </div>
                            <div class="ms_slot_boolbnb_title d-none d-md-block">
                                <h1>bollbnb</h1>
                            </div>
                        </div> --}}
    
                        {{-- serach bar --}}
                        {{-- <div>
                            
                        </div> --}}
    
                        {{-- link login e dashboard --}}
                        {{-- <div>
                            @if (Route::has('login'))
                                <div>
                                    @auth
                                        <a href="{{ url('/home') }}" class="ms_link_nav_welcome">Dashboard</a>
                                    @else
                                        <a href="{{ route('login') }}" class="ms_link_nav_welcome">Accedi</a>
                
                                        @if (Route::has('register'))
                                            <a href="{{ route('register') }}" class="ms_link_nav_welcome">Registrati</a>
                                        @endif
                                    @endauth
                                </div>
                            @endif
                        </div>
                    </div>
                </section>
            </header> --}}

        {{-- main --}}
        {{-- <welcome-main> </welcome-main> --}}

                            {{-- <a href="https://laravel.bigcartel.com" class="ml-1 underline">
                                Shop
                            </a>

                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="ml-4 -mt-px w-5 h-5 text-gray-400">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                            </svg>

                            <a href="https://github.com/sponsors/taylorotwell" class="ml-1 underline">
                                Sponsor
                            </a>
                        </div> --}}
                    {{-- </div> --}}

                    {{-- <div class="ml-4 text-center text-sm text-gray-500 sm:text-right sm:ml-0">
                        Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>  --}}
@extends('layouts.app')
@section('content')

    <div class="header">
        <div class="cont-header">

            {{-- link per riportare l'utente alla home page cliccando sul logo del sito --}}
            <div class="cont-home">
                <router-link class="mr-4" to='/' exact>
                    {{-- logo pagina --}}
                    <div class="ms_ctn_logo d-flex justify-content-start align-items-center">
                        <div class="ms_slot_logo me-1">
                            <img src="/storage/logo-boolbnb.png" alt="logo_boolbnb">
                        </div>
                        <div class="ms_slot_boolbnb_title d-none d-md-block">
                            <h1>bollbnb</h1>
                        </div>
                    </div>
                </router-link>
            </div>
            <div class="cont-user">
                @guest
                    <router-link class="me-3" to='/login' exact>Login</router-link> 
                    <router-link to='/register'>Register</router-link>
                @endguest
                @auth
                    <router-link to='/userApartments' class="me-3">Your Apartments</router-link>
                    <component-dashboard></component-dashboard>
                @endauth
            </div>
        </div>
    </div>
    <div class="main">
        <router-view></router-view>
    </div>
    <div class="footer">

    </div>
    
@endsection
