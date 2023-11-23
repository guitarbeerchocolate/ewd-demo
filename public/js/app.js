const searchInput = document.getElementById("search-input");
const suggestionsContainer = document.getElementById("suggestions-container");
const braveContainer = document.getElementById("brave-container");
const selectedSuggestion = document.getElementById("selected-suggestion");

// Function to fetch and display suggestions
async function fetchSuggestions(query) {
    try {
        // Make an AJAX request to fetch suggestions
        const response = await fetch(`/api/suggestions?query=${query}`);
        const data = await response.json();

        // Clear previous suggestions
        suggestionsContainer.innerHTML = "";

        // Display suggestions
        data.suggestions.forEach((suggestion) => {
            const suggestionElement = document.createElement("div");
            suggestionElement.textContent = suggestion.title;
            suggestionElement.classList.add("suggestion");
            suggestionsContainer.appendChild(suggestionElement);

            // Add a click event listener to fill the input field with the selected suggestion
            suggestionElement.addEventListener("click", () => {
                searchInput.value = suggestion.title;
                suggestionsContainer.innerHTML = "";
            });
        });
    } catch (error) {
        console.error("Error fetching suggestions:", error);
    }
}

// Function to fetch and display suggestions
async function fetchBraveResults(query) {
    try {
        // Make an AJAX request to fetch suggestions
        const response = await fetch(`/api/brave-results?query=${query}`);
        const data = await response.json();

        // Clear previous suggestions
        braveContainer.innerHTML = "";

        // Display suggestions
        const braveResponse = await fetch(`/api/brave-results?query=${query}`);

        [...data.web.results.slice(0, 10)].forEach((searchResult) => {
            const braveDiv = document.createElement("div");
            const braveElement = document.createElement("a");
            braveElement.text = searchResult.title;
            braveElement.href = searchResult.url;
            braveElement.target = "_blank";
            braveDiv.className =
                "bg-slate-800 text-white p-2 hover:bg-blue-500";
            braveDiv.appendChild(braveElement);
            braveContainer.appendChild(braveDiv);
        });
    } catch (error) {
        console.error("Error fetching suggestions:", error);
    }
}

// Event listener for input changes
searchInput.addEventListener("input", () => {
    const query = searchInput.value;

    // Show suggestions only when the query length is at least 3 characters
    if (query.length >= 3) {
        fetchSuggestions(query);
    } else {
        suggestionsContainer.innerHTML = "";
    }
});

// Event listener for suggestion clicks
suggestionsContainer.addEventListener("click", (e) => {
    if (e.target.classList.contains("suggestion")) {
        const suggestionText = e.target.textContent;
        selectedSuggestion.textContent = suggestionText;
        suggestionsContainer.innerHTML = "";
    }
});

// Function to run when the element becomes populated
const handlePopulated = () => {
    fetchBraveResults(selectedSuggestion.textContent);
    // You can replace the above line with your desired actions
};

// Create a MutationObserver instance
const observer = new MutationObserver((mutationsList) => {
    for (const mutation of mutationsList) {
        // Check if the target node (selectedSuggestion) has added nodes (child nodes)
        if (
            mutation.type === "childList" &&
            selectedSuggestion.textContent.trim() !== ""
        ) {
            // Call the handler function when populated
            handlePopulated();
        }
    }
});

// Configure the observer to look for changes in child nodes
const observerConfig = { childList: true };

// Start observing the target node
observer.observe(selectedSuggestion, observerConfig);
