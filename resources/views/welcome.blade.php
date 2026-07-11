<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <script src="https://cdn.tailwindcss.com"></script>
        
        @fonts
    </head>
    <body class="bg-gradient-to-br from-slate-950 via-indigo-950 to-slate-950 text-white min-h-screen flex flex-col justify-between">

        <header class="container mx-auto px-8 py-6 flex justify-between items-center">
            <h1 class="text-2xl font-bold tracking-wide text-indigo-400">
                Smart Discussion Forum
            </h1>

            <nav class="flex items-center gap-4">
                <a href="{{ route('about') }}" 
                   class="px-5 py-2 text-gray-300 hover:text-white hover:bg-slate-800/50 rounded-lg transition">
                    About
                </a>

                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}"
                           class="px-5 py-2 rounded-lg bg-indigo-600 hover:bg-indigo-700 transition font-medium">
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}"
                           class="px-5 py-2 border border-indigo-500/40 rounded-lg hover:bg-indigo-600/30 transition font-medium">
                            Login
                        </a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}"
                               class="px-5 py-2 bg-indigo-600 rounded-lg hover:bg-indigo-700 transition font-medium shadow-lg shadow-indigo-600/20">
                                Register
                            </a>
                        @endif
                    @endauth
                @endif
            </nav>
        </header>

        <main class="container mx-auto px-8 flex flex-col items-center justify-center text-center flex-grow py-20">
            
            <span class="px-4 py-1.5 rounded-full text-xs font-semibold tracking-wider uppercase bg-indigo-500/10 text-indigo-300 border border-indigo-500/20 mb-6">
                Now Live
            </span>

            <h1 class="text-5xl md:text-6xl font-extrabold mb-6 tracking-tight max-w-4xl leading-tight">
                Welcome to the <span class="bg-clip-text text-transparent bg-gradient-to-r from-indigo-400 to-purple-400">Smart Discussion Forum</span>
            </h1>

            <p class="text-lg md:text-xl text-slate-400 max-w-2xl mb-10 leading-relaxed">
                Collaborate with classmates, engage in meaningful discussions,
                participate in quizzes, and learn together in one intelligent platform.
            </p>

            <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}"
                           class="px-8 py-4 bg-indigo-600 rounded-xl hover:bg-indigo-700 transition font-semibold text-lg shadow-xl shadow-indigo-600/20 w-48">
                            Go to Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}"
                           class="px-8 py-4 border border-indigo-400 rounded-xl hover:bg-indigo-600/20 transition font-semibold text-lg w-48">
                            Login
                        </a>

                        @if(Route::has('register'))
                            <a href="{{ route('register') }}"
                               class="px-8 py-4 bg-indigo-600 rounded-xl hover:bg-indigo-700 transition font-semibold text-lg shadow-xl shadow-indigo-600/20 w-48">
                                Register
                            </a>
                        @endif
                    @endauth
                @endif
            </div>
        </main>

        <section id="about" class="bg-slate-950/40 border-t border-slate-900 py-12 text-center text-sm text-slate-500">
            <div class="container mx-auto px-8">
                <p>Smart Discussion Forum &copy; {{ date('Y') }}. Built for smarter collaborative learning.</p>
            </div>
        </section>

    </body>
</html>