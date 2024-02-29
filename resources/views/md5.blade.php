<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Hash Cracker</title>
   
    <link rel="stylesheet" href="{{ asset('css/stylesmd5.css') }}">
    <style>
        /* Additional CSS for spacing */
        .copy-button {
            margin-top: 1px; /* Adjust the margin as needed */
        }
    </style>
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
    <h1>Hash Generator</h1>

    <form id="hashForm">
        <input type="text" id="hashToCrack" placeholder="Enter string to generate HASH">
        <select id="hashFormat">
            <option value="MD5">MD5</option>
            <option value="SHA-1">SHA-1</option>
            <option value="SHA-256">SHA-256</option>
            <option value="SHA-384">SHA-384</option>
            <option value="SHA-512">SHA-512</option>
            <option value="SHA-3">SHA-3</option>
            <option value="RIPEMD-160">RIPEMD-160</option>
            <option value="base64">Base64</option> <!-- Added base64 option -->
            <!-- Add more hash format options here -->
        </select>
        <button type="submit">Generate Hash</button>
    </form>

    <br>
    <br>
    <br>

    <div id="result"></div>

</div>

<!-- Include CryptoJS library -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.1.1/crypto-js.min.js"></script>

<script>
    document.getElementById('hashForm').addEventListener('submit', function(event) {
        event.preventDefault();

        // Get the input value
        var input = document.getElementById('hashToCrack').value;
        
        // Get the selected hash format
        var hashFormat = document.getElementById('hashFormat').value;

        // Generate hash based on selected format
        var hash;
        switch(hashFormat) {
            case 'MD5':
                hash = CryptoJS.MD5(input).toString();
                break;
            case 'SHA-1':
                hash = CryptoJS.SHA1(input).toString();
                break;
            case 'SHA-256':
                hash = CryptoJS.SHA256(input).toString();
                break;
            case 'SHA-384':
                hash = CryptoJS.SHA384(input).toString();
                break;
            case 'SHA-512':
                hash = CryptoJS.SHA512(input).toString();
                break;
            case 'SHA-3':
                hash = CryptoJS.SHA3(input).toString();
                break;
            case 'RIPEMD-160':
                hash = CryptoJS.RIPEMD160(input).toString();
                break;
            case 'base64':
                hash = btoa(input); // Convert input string to base64
                break;
            // Add more cases for other hash formats if needed
            default:
                hash = 'Invalid hash format';
        }

        // Display the result
        var resultDiv = document.getElementById('result');
        resultDiv.innerHTML = '<p>' + hashFormat + ' Hash: ' + hash + '</p>';

        // Create "Copy Hash" button
        var copyButton = document.createElement('button');
        copyButton.textContent = 'Copy Hash';
        copyButton.className = 'copy-button'; // Add a class for styling
        copyButton.addEventListener('click', function() {
            // Copy hash to clipboard
            var tempInput = document.createElement('input');
            tempInput.value = hash;
            document.body.appendChild(tempInput);
            tempInput.select();
            document.execCommand('copy');
            document.body.removeChild(tempInput);
        });

        // Insert button after result text
        var pElement = resultDiv.querySelector('p');
        pElement.appendChild(copyButton);
    });
</script>

</body>
</html>
