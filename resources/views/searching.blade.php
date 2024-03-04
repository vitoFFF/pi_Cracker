<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PiCracker</title>
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
        <h1 style="color: #542a81;font-family: Arial, sans-serif;">PiCracker</h1>
        <br>
        <form id="searchForm">
            <select id="fileSelect">
                <option value="wordlists/wparockyou.txt">WpaRockyou</option>
                <option value="wordlists/rockyou.txt">Rockyou</option>
                <option value="wordlists/Johnpassword.txt">John</option>
                <option value="wordlists/american-english.txt">American English</option>
                <!-- Add more options for additional files -->
            </select>
            <input type="text" id="searchTerm" placeholder="Enter your Password">
            
            <label for="exactMatch">Exact Match</label>
            <input type="checkbox" id="exactMatch">
            <button type="submit">Submit</button>
        </form>

        <br>
        <br>
        <br>
        <div class="info-panel">
            <!-- Content goes here -->
        </div>
    </div>

   

    <script src="{{ asset('js/script.js') }}"></script> <!-- Assuming script.js is in the public directory -->
</body>

</html>
