<!-- <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Laravel') }}</title>

        @fonts


<link rel="stylesheet" href="{{ asset('mycss/homepage.css') }}">



    </head>
    <body >
        <header>
            @if (Route::has('login'))
                <nav >
                    @auth
                        <a
                            href="{{ url('/dashboard') }}"
                        >
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}">
                            Log in
                        </a>

                        @if (Route::has('register'))
                            <a
                                href="{{ route('register') }}">                                Register
                            </a>
                        @endif
                    @endauth
                </nav>
            @endif
        </header> -->

        <!-- this is for aligning the buttons -->
        <!-- <div >    
        </div>


        @if (Route::has('login'))
            <div class="h-14.5 hidden lg:block"></div>
        @endif

     <div class="landing-page">
        <div class="glass-container">
            <div class="header-box">
                <span class="welcome-label">WELCOME TO</span>
            </div>
            
            <h1>Smart Discussion<br>Forum</h1>
            
            <p class="tagline">Grow together.</p>
            
            <p class="description">
                Smart Discussion Forum is a community-driven platform for thoughtful discussions, quality answers and meaningful connections.
            </p>
        </div>
    </div> 

    
    </body>
</html> -->


<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Smart') }} - Community Forum</title>

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&display=swap" rel="stylesheet">

        <link rel="stylesheet" href="{{ asset('css/welcome.css') }}">
    </head>
    <body class="welcome-page">
        
        <header>
            <div class="logo-container">
                <span class="logo-text">SF</span>
            </div>
            @if (Route::has('login'))
                <nav>
                    @auth
                        <a href="{{ url('/dashboard') }}">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="nav-login">Log in</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="nav-register">Register</a>
                        @endif
                    @endauth
                </nav>
            @endif
        </header>

        <div class="landing-page-hero">
            <div class="container">
                
                <div class="glass-container">
                    
                    <div class="header-box">
                        <span class="welcome-label">WELCOME TO</span>
                    </div>
                    
                    <h1>Smart Discussion<br>Forum</h1>
                    
                    <p class="tagline">Grow together.</p>
                    
                    <p class="description">
                        Smart Discussion Forum is a community-driven platform for thoughtful discussions, quality answers, and meaningful connections.
                    </p>

                    @if (Route::has('login'))
                        <div class="cta-actions">
                            @auth
                                <a href="{{ url('/dashboard') }}" class="btn btn-primary">Go to Dashboard</a>
                            @else
                                <a href="{{ route('login') }}" class="btn btn-secondary">Log In</a>
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="btn btn-primary">Get Started</a>
                                @endif
                            @endauth
                        </div>
                    @endif
                </div> 
            </div> 
            </div> 
            </body>
</html>