<script>
// Debounce timers and abort controllers
let fromDebounceTimer = null;
let toDebounceTimer = null;
let fromAbortController = null;
let toAbortController = null;

async function searchLocation(query, suggestionBox, inputBox, isFrom = true) {

    if (query.length < 2) {
        suggestionBox.innerHTML = "";
        suggestionBox.style.display = "none";
        return;
    }

    // Show loading message
    suggestionBox.innerHTML = "<div style='padding: 10px; color: #999;'>Loading...</div>";
    suggestionBox.style.display = "block";

    try {
        // Cancel previous request if it's still running
        if (isFrom && fromAbortController) {
            fromAbortController.abort();
        } else if (!isFrom && toAbortController) {
            toAbortController.abort();
        }

        // Create new abort controller for this request
        const abortController = new AbortController();
        if (isFrom) {
            fromAbortController = abortController;
        } else {
            toAbortController = abortController;
        }

        const response = await fetch(
            `https://nominatim.openstreetmap.org/search?format=json&addressdetails=1&countrycodes=in&limit=5&q=${encodeURIComponent(query)}`,
            { signal: abortController.signal }
        );

        if (!response.ok) {
            console.error('API Error:', response.status);
            suggestionBox.innerHTML = "";
            suggestionBox.style.display = "none";
            return;
        }

        const data = await response.json();

        suggestionBox.innerHTML = "";

        if (data.length === 0) {
            suggestionBox.style.display = "none";
            return;
        }

        data.forEach(place => {
            const div = document.createElement("div");
            div.innerText = place.display_name;

            div.onclick = function () {
                inputBox.value = place.display_name;
                suggestionBox.innerHTML = "";
                suggestionBox.style.display = "none";
            };

            suggestionBox.appendChild(div);
        });

        suggestionBox.style.display = "block";
    } catch (error) {
        if (error.name !== 'AbortError') {
            console.error('Search error:', error);
            suggestionBox.innerHTML = "";
            suggestionBox.style.display = "none";
        }
    }
}

// Wait for DOM to be ready
document.addEventListener('DOMContentLoaded', function() {
    const fromLocation = document.getElementById("from_location");
    const toLocation = document.getElementById("to_location");

    if (fromLocation) {
        fromLocation.addEventListener("input", function () {
            clearTimeout(fromDebounceTimer);
            fromDebounceTimer = setTimeout(() => {
                searchLocation(this.value,
                    document.getElementById("from_suggestions"),
                    this,
                    true
                );
            }, 300); // Reduced to 300ms for faster response
        });
    }

    if (toLocation) {
        toLocation.addEventListener("input", function () {
            clearTimeout(toDebounceTimer);
            toDebounceTimer = setTimeout(() => {
                searchLocation(this.value,
                    document.getElementById("to_suggestions"),
                    this,
                    false
                );
            }, 300); // Reduced to 300ms for faster response
        });
    }
});
</script>
