<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>BoolBnB</title>
        <link rel="shortcut icon" href="/storage/icons8-servizio-in-camera-32.png" type="image/png">

        <!-- Scripts -->
        @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    </head>
    <body>
        {{-- conatiner principale della pagina --}}
        <div class="container-fluid">
            {{-- header --}}
            <header>
                <div>
                    @if (Route::has('login'))
                        <div>
                            @auth
                                <a href="{{ url('/home') }}" class="text-danger">Dashboard</a>
                            @else
                                <a href="{{ route('login') }}">Log in</a>
        
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}">Register</a>
                                @endif
                            @endauth
                        </div>
                    @endif
                </div>
            </header>

            {{-- main --}}
            <welcome-main></welcome-main>

            {{-- footer --}}
            <welcome-footer></welcome-footer>
        </div>
    </body>
</html>
