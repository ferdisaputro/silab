<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        {{-- <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet"> --}}

        {{-- icons --}}
        <link href="/assets/icons/fontawesome/css/fontawesome.css" rel="stylesheet" />
        <link href="/assets/icons/fontawesome/css/brands.css" rel="stylesheet" />
        <link href="/assets/icons/fontawesome/css/solid.css" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased text-primaryDark dark:text-white font-roboto">
        <div class="flex min-h-screen bg-primaryWhite dark:bg-gray-900">
            <livewire:layout.sidebar />

            <div class="flex-1 overflow-auto">
                <livewire:layout.navbar />
    
                <!-- Page Content -->
                <main class="py-12">
                    {{ $slot }}
                </main>
            </div>
        </div>

        @stack('scripts')
    </body>
</html>
