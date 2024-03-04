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
            background-color: #333;
            color: white; /* Changed text color to white */
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
            z-index: 1;
            border-radius: 15px;
            padding: 10px;
            top: 65px;
        }

        .dropdown:hover .dropdown-content,
        .dropdown:focus-within .dropdown-content {
            display: block;
        }

        .dropdown-content a:hover {
            background-color: blue;
        }

        .dropdown-content a {
            color: white; /* Change text color to white */
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }

        .dropdown-content label {
            color: orange; /* Change label text color to orange */
        }

        .dropbtn {
            color: #abff4f; /* Change text color to a bright green */
            background-color: transparent; /* Add this line to make the button transparent */
            border: none; /* Add this line to remove the border */
            cursor: pointer;
            font-weight: bold; /* Add this line to make the text bold */
        }

        /* Change font color to white for the matrix characters */
        #canv {
            color: white;
        }
    </style>
</head>

<body>
    <nav>
        <div class="dropdown">
            <button  class="dropbtn">Choose Matrix Style</button>
            <div class="dropdown-content">
                <input type="range" min="5" max="30" value="25" id="sizeSlider" oninput="changeSize(this.value)">
                <label for="sizeSlider">Adjust Size</label>
                <a href="#" onclick="changeCharArray('custom')">Custom</a>
                <a href="#" onclick="changeCharArray('planets')">Planets</a>
                <a href="#" onclick="changeCharArray('random')">Random</a>
                <a href="#" onclick="changeCharArray('animals')">Animals</a>
                <a href="#" onclick="changeCharArray('food')">Food</a>
                <a href="#" onclick="changeCharArray('sport')">Sport</a>
                <a href="#" onclick="changeCharArray('math')">Math</a>
            </div>
        </div>

        <!-- Color selector dropdown -->
        <div class="dropdown">
            <button id="matrixColorDropdownBtn" class="dropbtn">Choose Matrix Color</button>
            <div class="dropdown-content" id="colorSelector">
                <a href="#" onclick="changeColor('#0f0')" style="color: #0f0;">Green</a>
                <a href="#" onclick="changeColor('#00f')" style="color: #00f;">Blue</a>
                <a href="#" onclick="changeColor('#f00')" style="color: #f00;">Red</a>
                <a href="#" onclick="changeColor('#ff0')" style="color: #ff0;">Yellow</a>
                <a href="#" onclick="changeColor('#fff')" style="color: #fff;">White</a>
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
        let matrixColor = '#0f0'; // Default matrix color

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

            ctx.fillStyle = matrixColor; // Use selected color
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
                case 'math':
                    return math;
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

        // Function to change the matrix color
        function changeColor(color) {
            matrixColor = color;
        }

        // Custom characters array
        const custom = ['❤', '☀', '$', '⭐', '⚡', '⚛', '⚘', '⚔', '✨', '❄'];
        const planets = ['🪐', '🌌', '🌠', '🌟', '☄️', '💫', '🌍', '🌎', '🌏', '🌕'];
        const random = ['🌈 ', '🌀', '🌟', '🌌 ', '🎇', '🎆', '🎑', '🪐', '🌠', '🎨'];
        const animals = ['🐯', '🦁', '🐻', '🐺', '🦊', '🐱', '🐶', '🐮', '🐷', '🐸'];
        const food = ['🍕', '🍔', '🍟', '🍣', '🍦', '🍩', '🍪', '🍫', '🍉', '🍇'];
        const sport = ['😂', '😍', '👩‍🎓', '👨‍🎨', '👩‍🚒', '👩‍🍳', '👩‍⚖️', '🧕', '🧔', '👩‍🔧'];
        const math = ['∑', '∫', '√', '∈', '∞', '≠', '≈', '∂', '∇', '±','∴', '⇒', '⇔', 'π', '∝', '∩','∬', '❤', '❄'];

        let fontSize = 15; // Initial font size
        // Function to change the matrix color
        function changeColor(color) {
            matrixColor = color;
            updateDropdownTextColor(color);
        }

        // Function to update the text color of the dropdown button based on the selected color
        function updateDropdownTextColor(color) {
            const dropDownButton = document.getElementById('matrixColorDropdownBtn');
            dropDownButton.style.color = color;
        }

        

        // Initialize
        init();
    </script>
</body>

</html>
