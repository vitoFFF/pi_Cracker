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

<div class="container">
    <h1>RockYou</h1>

    <table>
        <thead>
            <tr>
                <th>N</th>
                <th>Words</th>
            </tr>
        </thead>
        <tbody id="wordlistBody">
            <!-- Wordlist content will be added here dynamically -->
        </tbody>
    </table>
</div>

<!-- Include jQuery library -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
  $(document).ready(function() {
    // Fetch the contents of the wparockyou.txt file
    $.get("wordlists/wparockyou.txt", function(data) {
        // Split the data into an array of words
        var words = data.split('\n');

        // Define the starting index
        var startIndex = 500; // Adjust this value as needed

        // Iterate over the words starting from the startIndex
        for (var i = startIndex; i < startIndex + 1500 && i < words.length; i++) {
            $('#wordlistBody').append('<tr><td>' + (i + 1) + '</td><td>' + words[i] + '</td></tr>');
        }
    });
});

</script>

</body>
</html>
