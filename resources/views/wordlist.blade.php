<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RockYou</title>
    <link rel="stylesheet" href="{{ asset('css/wordliststyles.css') }}"> <!-- Assuming styles.css is in the public directory -->
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

<!-- Include jQuery library -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<div>
    <h2>Choose a Wordlist</h2>
    <form action="/process-wordlist" method="POST">
        @csrf
        <select name="wordlist">
            <option value="">Select a Wordlist</option>
            @foreach (glob(public_path('wordlists/*.txt')) as $file)
                @php
                    $fileName = basename($file);
                @endphp
                <option value="{{ $fileName }}">{{ $fileName }}</option>
            @endforeach
        </select>
        <button type="submit">Submit</button>
    </form>
</div>

<div>
    @if(isset($wordlistContent))
        <h2>Wordlist Content</h2>
        <pre>{{ $wordlistContent }}</pre>
    @endif
</div>

</body>
</html>
