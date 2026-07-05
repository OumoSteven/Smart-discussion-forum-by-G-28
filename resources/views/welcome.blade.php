
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Smart Discussion Forum</title>

    <style>
        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
            font-family:Arial, sans-serif;
        }

        body{
            min-height:100vh;
            background:linear-gradient(135deg,#07142c,#0a2458,#0d3475);
            color:white;
            display:flex;
            flex-direction:column;
        }

        nav{
            display:flex;
            justify-content:space-between;
            align-items:center;
            padding:25px 80px;
        }

        .logo{
            font-size:2rem;
            font-weight:bold;
        }

        .logo span{
            color:#3b82f6;
        }

        .nav-buttons{
            display:flex;
            gap:15px;
        }

        .btn{
            text-decoration:none;
            color:white;
            border:1px solid #3b82f6;
            padding:12px 30px;
            border-radius:10px;
            transition:0.3s;
        }

        .btn:hover{
            background:#3b82f6;
        }

        .hero{
            flex:1;
            display:flex;
            flex-direction:column;
            justify-content:center;
            align-items:center;
            text-align:center;
            padding:20px;
        }

        .hero h1{
            font-size:4rem;
            margin-bottom:20px;
        }

        .hero h1 span{
            color:#3b82f6;
        }

        .hero p{
            font-size:1.2rem;
            max-width:700px;
            line-height:1.8;
            color:#d1d5db;
        }
    </style>
</head>
<body>

    <nav>
        <div class="logo">
            Smart<span>Forum</span>
        </div>

        <div class="nav-buttons">
            @auth
                <a href="{{ route('dashboard') }}" class="btn">Dashboard</a>
                <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                    @csrf
                    <button type="submit" class="btn" style="background:#3b82f6;border-color:#3b82f6;cursor:pointer;">Logout</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="btn">Login</a>
                <a href="{{ route('register') }}" class="btn">Register</a>
                <a href="/about" class="btn">About</a>
            @endauth
        </div>
    </nav>

    <section class="hero">
        <h1>
            Learn Together.<br>
            <span>Discuss Better.</span><br>
            Grow Smarter.
        </h1>

        <p>
            Smart Discussion Forum is a collaborative learning platform
            where students and lecturers can share knowledge, ask questions,
            participate in discussions, and enhance their learning experience.
        </p>
    </section>

</body>
</html>
