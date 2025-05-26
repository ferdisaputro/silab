<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" >
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <style>
            .background-login {
                background-image: url('{{ asset('assets/images/gedung-jti.jpg') }}');
                background-size: cover;
                background-position: center;
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                z-index: 10;
            }

            .background-login::after {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                backdrop-filter: blur(5px);
                background-color: rgba(0, 0, 0, 0.5);
            }
        </style>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased text-gray-900">
        <div class="flex flex-col items-center min-h-screen pt-6 bg-gray-100 sm:justify-center sm:pt-0 dark:bg-gray-900 relative">
            <div class="background-login"></div>

            <div class="w-full relative z-20 px-6 py-4 mt-6 overflow-hidden bg-white shadow-md sm:max-w-md dark:bg-gray-800 sm:rounded-lg">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
