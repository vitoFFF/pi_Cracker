document.getElementById('hashForm').addEventListener('submit', async function(event) {
    event.preventDefault();

    // Get the hash to crack
    const hashToCrack = document.getElementById('hashToCrack').value.trim(); // Trim whitespace

    try {
        // Fetch the content of the hash file
        const response = await fetch('wordlists/wparockyouMD5.txt');
        const hashContent = await response.text();

        // Split hash content into lines and extract hashes and corresponding words
        const lines = hashContent.split('\n');
        const hashMap = {};
        lines.forEach(line => {
            const [hash, word] = line.split(':').map(part => part.trim()); // Split by ':' and trim whitespace
            hashMap[hash] = word;
        });

        // Check if the hash exists in the hash map
        const crackedPassword = hashMap[hashToCrack];

        // Display result
        const resultElement = document.getElementById('result');
        if (crackedPassword) {
            resultElement.textContent = `Cracked Password: ${crackedPassword}`;
        } else {
            resultElement.textContent = "Password not found in wordlist";
        }
    } catch (error) {
        console.error('Error fetching or processing file:', error);
    }
});
