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

    @auth
    <script>
        document.getElementById('searchForm').addEventListener('submit', async function(event) {
            // Prevent the default form submission
            event.preventDefault();

            // Get the search term from the input field
            const searchTerm = document.getElementById('searchTerm').value.toLowerCase();

            // Get the selected file from the dropdown menu
            const selectedFile = document.getElementById('fileSelect').value;

            // Get the exact match checkbox state
            const exactMatch = document.getElementById('exactMatch').checked;

            try {
                // Fetch the content of the selected file
                const response = await fetch(selectedFile);
                const text = await response.text();

                // Split the text into an array of words
                const words = text.split('\n');

                // Initialize variables to store matched words and their count
                let matchedWords = [];
                let matchedWordsCount = 0;

                // Iterate through the words and perform the search
                for (const word of words) {
                    // Perform case-insensitive search
                    const wordLower = word.toLowerCase();

                    // Check for exact match or partial match based on checkbox state
                    if ((exactMatch && wordLower === searchTerm) || (!exactMatch && wordLower.includes(searchTerm))) {
                        // Increment matched words count
                        matchedWordsCount++;

                        // Push the matched word to the array
                        matchedWords.push(word);
                    }
                }

                // Count the total number of words in the file
                const totalWordsCount = words.length;

                // Create HTML content for displaying matched words and count
                let html = `<p class="matched-words">Number of matched words: <span class="matchedWordsCount">${matchedWordsCount}</span>/${totalWordsCount}</p>`;
                html += `<ul>`;

                // Loop through the matched words and add them to the HTML content
                matchedWords.forEach(word => {
                    // Colorize the matched letters within the word
                    const coloredWord = word.replace(new RegExp(searchTerm, 'gi'), match => `<span class="highlight">${match}</span>`);
                    html += `<li>${coloredWord}</li>`;
                });

                html += `</ul>`;

                // Display the matched words and count inside the info-panel
                document.querySelector('.info-panel').innerHTML = html;

                
            } catch (error) {
                console.error('Error fetching or processing file:', error);
            }
            
        });
    </script>
    @endauth

    <script src="{{ asset('js/script.js') }}"></script> <!-- Assuming script.js is in the public directory -->
</body>

</html>
