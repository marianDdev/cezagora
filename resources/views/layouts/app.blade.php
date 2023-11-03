<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <link rel="icon" type="image/png" sizes="32x32" href="{{ url('/images/favicon-32x32.png') }}">

        <title>CezAgora</title>

        @vite(['resources/css/app.css','resources/js/app.js'])
        @livewireStyles
    </head>
    <body>
        @include('layouts.navigation')
        <main>
            {{ $slot }}
        </main>
        @include('layouts.footer')
        @livewireScripts
    </body>
</html>
