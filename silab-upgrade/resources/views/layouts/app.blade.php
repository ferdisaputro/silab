<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />


    <link rel="stylesheet" href="{{ asset('/assets/css/bootstrap.min.css') }}" />
    {{-- <link rel="stylesheet" href="/assets/css/plugins.min.css" /> --}}
    <link rel="stylesheet" href="{{ asset('/assets/css/kaiadmin.min.css') }}" />

    {{-- icons --}}
    <link href="/assets/icons/fontawesome/css/fontawesome.css" rel="stylesheet" />
    <link href="/assets/icons/fontawesome/css/brands.css" rel="stylesheet" />
    <link href="/assets/icons/fontawesome/css/solid.css" rel="stylesheet" />

    {{-- DataTable --}}
    <link href="/assets/datatable/datatables.min.css" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
  </head>
  <body>
    <div class="wrapper">
        <livewire:layout.sidebar />

        <div class="main-panel">
            <livewire:layout.navbar />

            {{-- Page Content --}}
            <main class="container">
                <div class="p-5">
                    {{ $slot }}
                </div>
            </main>
        </div>

        <!--   Core JS Files   -->
        <script src="/assets/js/core/popper.min.js" wire:ignore></script>
        <script src="/assets/js/core/bootstrap.min.js" wire:ignore></script>
        <script src="/assets/js/core/jquery-3.7.1.min.js" wire:ignore></script>

        <!-- jQuery Scrollbar -->
        <script src="/assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js" wire:ignore></script>

        {{-- DataTable --}}
        <script src="/assets/datatable/datatables.min.js" wire:ignore></script>

        <!-- Bootstrap Notify -->
        <script src="/assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js" wire:ignore></script>

        <script src="/assets/js/kaiadmin.min.js" wire:ignore></script>

        {{-- <script src="{{ mix('js/app.js') }}"></script> --}}
        {{-- <script>
            $(document).ready(function() {
                Swal.fire({title: 'test ajah', icon: 'success'})
            })
        </script> --}}

        @stack('scripts')
    </div>
  </body>
</html>
