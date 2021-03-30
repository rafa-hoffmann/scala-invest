<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
        @livewireStyles

        <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('client.layouts.navigation')

            <!-- Page Heading -->
            <header class="bg-white shadow">
                <div class="mx-auto py-6 px-4 sm:px-6 lg:px-8 flex flex-row justify-between">
                    @yield('header')
                    @if (session()->has('message'))
                            <div id="alert" class="text-white p-2 border-0 rounded-full bg-green-500 flex flex-row">
                                <span class="flex-1 nline-block align-middle mr-8">
                                    {{ session('message') }}
                                </span>
                                <button class="justify-end" onclick="document.getElementById('alert').remove();">
                                    <span>×</span>
                                </button>
                            </div>
                    @endif
                </div>
            </header>


            <!-- Page Content -->
            <main>
                @yield('content')
            </main>
        </div>
        @livewireScripts
    </body>
</html>
