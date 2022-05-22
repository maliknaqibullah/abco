<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="icon" href="{{ URL::asset('/images/logo/favicon-32x32.png') }}" type="image/x-icon"/>

        <title>{{ config('app.name', 'ABCO ') }} > @stack('pagetitle')</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
        @yield('custom_css')
        @livewireStyles

        <!-- Scripts -->
        <script src="{{ mix('js/app.js') }}" defer></script>


    </head>
    <body class="font-sans antialiased">
        <x-jet-banner />

        <div class="min-h-screen bg-gray-100">
            @livewire('navigation-menu')
            <main class="flex-1">
                <div class="py-6">
                    <div class="max-w-6xl mx-auto px-4 sm:px-6 md:px-8">
                        <h1 class="text-2xl font-semibold text-gray-900">
                            <!-- Page Heading -->
                            @if (isset($header))
                                <header class="bg-white shadow px-4 sm:px-6">
                                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                                            <div class="-ml-4 -mt-2 flex items-center justify-between flex-wrap sm:flex-nowrap">
                                                {{ $header }}
                                            </div>
                                    </div>
                                </header>
                            @endif
                        </h1>
                    </div>
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8 ">
                    <!-- Page Content -->
                        <main>
                            @include('layouts.message')
                            {{ $slot }}
                        </main>

                        <!-- /End replace -->
                    </div>
                </div>
            </main>
        </div>


        @stack('modals')
        @livewireScripts
        <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
        @livewireChartsScripts
    </body>
</html>
