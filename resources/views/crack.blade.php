<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Hash Cracker</title>
   
    <link rel="stylesheet" href="{{ asset('css/stylesmd5.css') }}">
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
    <h1>π  Cracker</h1>

    <form id="hashForm">
        <input type="text" id="hashToCrack" placeholder="Enter hash to crack">
        <button type="submit">Crack Password</button>
    </form>

    <br>
    <br>
    <br>

    <div id="result"></div>

</div>

<script src="{{ asset('js/scriptmd5.js') }}"></script>

</body>
</html>
