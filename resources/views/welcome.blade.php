<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PiCracker</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}"> <!-- Assuming styles.css is in the public directory -->
    <style>
        /* Centering the input field */
        .centered-input {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        /* Navbar style */
        nav {
            display: flex;
            justify-content: space-between;
           
            position: fixed;
            background-color: #212529;
            padding: 0.5rem;
            box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
        }

        .dropdown {
            position: relative;
            display: inline-block;
            border-radius: 5px; /* Border radius */
        }

        .dropdown-content {
    display: none;
    position: absolute;
    background-color: #333; /* Dark background color */
    color: blue; /* Light text color */
    min-width: 160px;
    box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
    z-index: 1;
    border-radius: 15px; /* Border radius */
    padding: 10px;
    top: 45px; /* Adjust the value to move the panel downward */
}

.dropdown:hover .dropdown-content,
.dropdown:focus .dropdown-content,
.dropdown-content:hover,
.dropdown-content:focus {
    display: block;
}


        .dropdown-content a {
            color: white; /* Change text color to white */
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }

        .dropdown-content a:hover {
            background-color: blue;
            
        }
        .dropdown-content label {
            color: orange; /* Change label text color to white */
        }


        .dropbtn {
            color: #abff4f; /* Change this to the desired text color */
            background-color: transparent; /* Add this line to make the button transparent */
            border: none; /* Add this line to remove the border */
            cursor: pointer;
            font-weight: bold; /* Add this line to make the text bold */
        }
    </style>
</head>

<body>
    <nav>
        <div class="dropdown">
            <button class="dropbtn">Choose Matrix Style</button>
            <div class="dropdown-content">
                <input type="range" min="5" max="30" value="25" id="sizeSlider" oninput="changeSize(this.value)">
                <label for="sizeSlider">Adjust Size</label>
                <a href="#" onclick="changeCharArray('custom')">Custom</a>
                <a href="#" onclick="changeCharArray('planets')">Planets</a>
                <a href="#" onclick="changeCharArray('random')">Random</a>
                <a href="#" onclick="changeCharArray('animals')">Animals</a>
                <a href="#" onclick="changeCharArray('food')">Food</a>
                <a href="#" onclick="changeCharArray('sport')">Sport</a>
                <a href="#" onclick="changeCharArray('transport')">Transport</a>
            </div>
        </div>

        <!-- Other Navbar items -->
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

    <!-- Canvas for Matrix Animation -->
    <canvas id="canv"></canvas>

    <script>
        const canvas = document.getElementById('canv');
        const ctx = canvas.getContext('2d');

        let w, h, cols;
        const ypos = [];
        let selectedArray = 'custom'; // Default selected characters array

        function resizeCanvas() {
            w = canvas.width = window.innerWidth; // Set canvas width to window width
            h = canvas.height = window.innerHeight; // Set canvas height to window height
            cols = Math.floor(w / 20) + 1;
            ypos.length = cols;
            ypos.fill(0);
        }

        function init() {
            resizeCanvas();
            window.addEventListener('resize', resizeCanvas); // Update canvas size on window resize

            ctx.fillStyle = 'rgba(0, 0, 0, 0.1)';
            ctx.fillRect(0, 0, w, h);

            setInterval(matrix, 50);
        }

        function matrix() {
            ctx.fillStyle = 'rgba(0, 0, 0, 0.1)';
            ctx.fillRect(0, 0, w, h);

            ctx.fillStyle = '#0f0';
            ctx.font = `${fontSize}px monospace`; // Adjust the font size here

            const charArray = getCharArray(); // Get the selected characters array
            ypos.forEach((y, ind) => {
                const text = charArray[Math.floor(Math.random() * charArray.length)]; // Select a random character from the selected array
                const x = ind * 20;
                ctx.fillText(text, x, y);
                if (y > 100 + Math.random() * 10000) ypos[ind] = 0;
                else ypos[ind] = y + 20;
            });
        }

        // Function to get the selected characters array
        function getCharArray() {
            switch (selectedArray) {
                case 'custom':
                    return custom;
                case 'planets':
                    return planets;
                case 'random':
                    return random;
                case 'animals':
                    return animals;
                case 'food':
                    return food;
                case 'sport':
                    return sport;
                case 'transport':
                    return transport;
                default:
                    return custom;
            }
        }

        // Function to change the selected characters array
        function changeCharArray(arrayName) {
            selectedArray = arrayName;
        }

        // Function to change font size based on slider value
        function changeSize(value) {
            fontSize = parseInt(value);
        }

        // Custom characters array
        const custom = ['❤', '☀', '$', '⭐', '⚡', '⚛', '⚘', '⚔', '✨', '❄'];
        const planets = ['🪐', '🌌', '🌠', '🌟', '☄️', '💫', '🌍', '🌎', '🌏', '🌕'];
        const random = ['🌈 ', '🌀', '🌟', '🌌 ', '🎇', '🎆', '🎑', '🪐', '🌠', '🎨'];
        const animals = ['🐯', '🦁', '🐻', '🐺', '🦊', '🐱', '🐶', '🐮', '🐷', '🐸'];
        const food = ['🍕', '🍔', '🍟', '🍣', '🍦', '🍩', '🍪', '🍫', '🍉', '🍇'];
        const sport = ['⚽', '🏀', '🏈', '⚾', '🎾', '🏐', '🏓', '🏸', '🏒', '🥊'];
        const transport = ['🔫', '🗡️', '⚔️', '🪓', '🛡️', '🏹', '🗡️', '🪓', '🪃', '🛠️'];

        let fontSize = 15; // Initial font size

        // Initialize
        init();
    </script>
</body>

</html>
