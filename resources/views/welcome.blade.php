@extends('layouts.app')
@section('content')
    <div class="header">
        <div class="cont-header container-fluid">

            {{-- link per riportare l'utente alla home page cliccando sul logo del sito --}}
            <div class="cont-home">
                <router-link class="mr-4" to='/' exact>
                    {{-- logo pagina --}}
                    <div class="ms_ctn_logo d-flex justify-content-start align-items-center">
                        <div class="ms_slot_logo me-1">
                            <img src="{{ url('/images/logo-bool.png') }}" alt="logo_boolbnb">
                        </div>
                        <div class="ms_slot_boolbnb_title d-none d-md-block principal mt-2 ms-2">
                            <h1 class="principal">BoolBnB</h1>
                        </div>
                    </div>
                </router-link>
            </div>
            <div class="cont-user">
                @guest
                    <router-link class="me-2 text-black fw-bold rounded-pill border-dark ms_btn_navbar" to='/login' exact>Login
                    </router-link>
                    <router-link to='/register' class="text-black fw-bold rounded-pill border-dark ms_btn_navbar">Register</router-link>
                @endguest
                @auth
                    <router-link to='/userApartments' class="border-dark me-3 principal ms_btn_navbar">Your Apartments</router-link>
                    <component-dashboard></component-dashboard>
                @endauth
            </div>
        </div>

    </div>

    <div class="main">
        <router-view></router-view>
    </div>
    <div class="footer">
        <welcome-footer></welcome-footer>
    </div>
@endsection
