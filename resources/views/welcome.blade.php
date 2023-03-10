<!DOCTYPE html>
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
        <div class="container-fluid">
            {{-- header --}}
            <header>
                <div class="container-fluid ms_nav_welcome">
                    {{-- logo pagina --}}
                    <div class="ms_ctn_logo d-flex justify-content-start align-items-center">
                        <div class="ms_slot_logo me-1">
                            <img src="/storage/logo-boolbnb.png" alt="logo_boolbnb">
                        </div>
                        <div class="ms_slot_boolbnb_title d-none d-md-block">
                            <h1>bollbnb</h1>
                        </div>
                    </div>

                    {{-- serach bar --}}
                    <div>
                        
                    </div>

                    {{-- link login e dashboard --}}
                    <div>
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
            </header>

            {{-- main --}}
            <welcome-main> </welcome-main>

            {{-- footer --}}
            <welcome-footer> </welcome-footer>
        </div>
    </body>
</html>
