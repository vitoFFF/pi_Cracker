document.querySelector('form').addEventListener('submit', async function(event) {
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
        let html = `<p class="matched-words">Number of matched words for  "${searchTerm}": <span class="matchedWordsCount">${matchedWordsCount}</span>/${totalWordsCount}</p>`;
        
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

