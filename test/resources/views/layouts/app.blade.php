<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!--App CSS -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">      
    <link rel="stylesheet" href="{{asset('css/underline_effect.css') }}">   
    <!-- -->
    <!-- App js -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- UIkit CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.7.0/dist/css/uikit.min.css" />

    <!-- UIkit JS -->
    <script src="https://cdn.jsdelivr.net/npm/uikit@3.7.0/dist/js/uikit.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/uikit@3.7.0/dist/js/uikit-icons.min.js"></script>
    
</head>
<body>
    <div id="app" >    
        @include('layouts.menu')       
        <main>
            @yield('content')
        </main>
    </div>
</body>
</html>
