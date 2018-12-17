<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="app-url" content="{{ config('app.url') }}">
    <meta name="user" content="Auth::user()">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBUfSNPQxoqKs722OOHHhoPU5U_VOQf3gQ&libraries=places" defer></script>
    <script src="{{ asset('js/admin.js') }}" defer></script>

    <!-- Styles -->
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
</head>
<body>
<div id="app">
    <vue-progress-bar></vue-progress-bar>
    <main class="main">
        <div class="sidebar__menu">
            <div class="sidebar__mini"></div>
            <sidebar-menu></sidebar-menu>
        </div>
        @include ('realtor::layouts.partials.admin._navigation')
        <div class="main__container">
            <div class="wrapper--fluid">
                @yield('content')
            </div>
        </div>
    </main>
</div><!-- #app -->


</body>
</html>
