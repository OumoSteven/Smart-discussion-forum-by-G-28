<!-- <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title> -->

        <!-- Fonts -->
        <!-- <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" /> -->

        <!-- Scripts -->
        <!-- @vite(['resources/css/app.css', 'resources/js/app.js'])

        <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
        
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation') -->

            <!-- Page Heading -->
            <!-- @isset($header)
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset -->

            <!-- Page Content -->
            <!-- <main> -->
                <!-- {{ $slot }} -->
            <!-- </main>
        </div>
    </body>
</html> -->



<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Smart Discussion Forum') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    {{-- Keep only Javascript processing if needed, stripping default Tailwind CSS bundles --}}
    @vite(['resources/js/app.js'])

    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    
    <style>
        /* Ensuring standard baseline layout behavior without framework overrides */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            background-color: #0b0f19; /* Deep, sleek base tone */
            color: #ffffff;
            display: flex;
            min-height: 100vh;
        }
        /* Structural flex setup to keep your sidebar fixed on left and content floating on right */
        .main-content {
            flex: 1;
            padding: 2.5rem;
            margin-left: 260px; /* Aligns content area away from your overlapping sidebar */
            min-height: 100vh;
            box-sizing: border-box;
        }
    </style>
</head>
<body>

    {{-- Injects your updated navigation sidebar layout component dynamically --}}
    @include('layouts.navigation')

    @isset($header)
        <header>
            {{ $header }}
        </header>
    @endisset

    {{-- Custom Page content slots pass down perfectly inside here --}}
    <main class="main-content">
        {{ $slot }}
    </main>

</body>
</html>