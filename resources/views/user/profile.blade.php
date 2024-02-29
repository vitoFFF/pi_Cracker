<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}"> <!-- Assuming styles.css is in the public directory -->
</head>

<body>
    <nav>
    <ul>
            <li><a href="{{ url('/') }}">Home</a></li>
            <li><a href="/crack">Cracker</a></li>
            <li><a href="/search">Searching</a></li>
            <li><a href="/wordlist">Wordlists</a></li>
            <li><a href="/hush">Hushing</a></li>

            <li><a href="/profile">Profile</a></li>
            @guest
            <li><a href="{{ route('login') }}">Login</a></li>
            @else
            <li><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a></li>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
            @endguest
        </ul>
    </nav>

    <div class="container">
        <h1 style="color: #542a81;font-family: Arial, sans-serif;">User Profile</h1>
        <br>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">User Profile</div>
                    <div class="card-body">
                        <p>Name: {{ Auth::user()->name }}</p>
                        <p>Email: {{ Auth::user()->email }}</p>
                        <!-- Add more user information as needed -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/script.js') }}"></script> <!-- Assuming script.js is in the public directory -->
</body>

</html>
