<!DOCTYPE html>
<html lang="en">

<nav>
    <ul>
      <li><a href="/">Home</a></li>
      <li><a href="{{ url('/crack') }}">Cracker</a></li>

      <li><a href="/wordlist">Wordlists</a></li>
      <li><a href="/hush">Hushing</a></li>
      
      <li><a href="#login">Login</a></li>
    </ul>
  </nav>
  <!-- Rest of the HTML remains unchanged -->
  
  <head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PiNormality</title>
  <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>


<div class="container">
    <h1 style="color: #542a81;font-family: Arial, sans-serif;">Password Explorer</h1>
    <br>
    <form>
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
     
    </div>


  </div>

  <script src="{{ asset('js/script.js') }}"></script>

</body>
</html>
