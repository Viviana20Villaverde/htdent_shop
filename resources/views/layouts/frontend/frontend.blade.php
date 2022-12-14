<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('tituloPagina')</title>
    @include('layouts.frontend.componentes.css')

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles
</head>

<body class="font-sans antialiased">
    {{-- Sirve para crear los flash.banner --}}
    <x-jet-banner />

    <div class="min-h-screen">
        {{-- @livewire('navigation-menu') --}}

        @livewire('frontend.menu.menu-principal')


        <!-- Contenido de páignas-->
        <main>
            {{ $slot }}
        </main>

        @include('layouts.frontend.componentes.pie-pagina')

    </div>

    @include('layouts.frontend.componentes.js')
    @stack('modals')
    @livewireScripts
    @stack('script')
</body>

</html>
