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
