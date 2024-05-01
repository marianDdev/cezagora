<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <link rel="icon" type="image/x-icon" href="{{ url('/favicon.ico') }}">

        <meta name="description" content="Marketplace dedicated to the cosmetics industry where manufacturers can easily find suppliers for ingredients, raw materials, packaging, testing laboratories, private label, formulation services, marketing services.">

        @if(env('APP_ENV') === 'staging')
            <meta name="robots" content="noindex, nofollow">
        @endif

        @if(env('APP_ENV') === 'production')
            <meta name="robots" content="index, follow">
        @endif

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
