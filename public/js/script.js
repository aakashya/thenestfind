document.addEventListener("DOMContentLoaded", () => {
    const bigScreenTrigger = document.getElementById(
        "big-screen-contact-trigger"
    );
    const smallScreenTrigger = document.getElementById(
        "small-screen-contact-trigger"
    );
    const popper = document.getElementById("contact-popper");

    // Common function to toggle visibility
    const togglePopper = () => {
        if (popper.style.display === "none" || popper.style.display === "") {
            popper.style.display = "block";
        } else {
            popper.style.display = "none";
        }
    };

    // Add event listeners for both triggers
    bigScreenTrigger.addEventListener("click", togglePopper);
    smallScreenTrigger.addEventListener("click", togglePopper);

    // Optional: Close the popper when clicking outside
    document.addEventListener("click", (e) => {
        if (
            !popper.contains(e.target) &&
            !bigScreenTrigger.contains(e.target) &&
            !smallScreenTrigger.contains(e.target)
        ) {
            popper.style.display = "none";
        }
    });
});

document.addEventListener("DOMContentLoaded", () => {
    const trigger = document.getElementById("hamburger-trigger");
    const dropdown = document.getElementById("hamburger-dropdown");

    trigger.addEventListener("click", () => {
        // Toggle the display of the dropdown
        if (
            dropdown.style.display === "none" ||
            dropdown.style.display === ""
        ) {
            dropdown.style.display = "block";
        } else {
            dropdown.style.display = "none";
        }
    });

    // Optional: Close the dropdown when clicking outside
    document.addEventListener("click", (e) => {
        if (!trigger.contains(e.target) && !dropdown.contains(e.target)) {
            dropdown.style.display = "none";
        }
    });
});

document.addEventListener("DOMContentLoaded", function () {
    const searchInput = document.querySelector(".search-input");
    const searchResults = document.querySelector(".search-results");
    const searchItems = document.querySelectorAll(".search-item");

    // Show the dropdown when clicking on the search input
    searchInput.addEventListener("click", function () {
        searchResults.classList.add("active");
    });

    // Hide the dropdown when clicking outside the search bar
    document.addEventListener("click", function (event) {
        if (
            !searchInput.contains(event.target) &&
            !searchResults.contains(event.target)
        ) {
            searchResults.classList.remove("active");
        }
    });

    // Filter results based on the search input (allowing multiple words)
    searchInput.addEventListener("input", function () {
        const searchValue = searchInput.value.toLowerCase().trim();
        const searchWords = searchValue.split(" "); // Split input into individual words
        let hasResults = false;

        searchItems.forEach(function (item) {
            const locationName = item
                .querySelector(".location-name")
                .textContent.toLowerCase();
            const locationAddress = item
                .querySelector(".location-address")
                .textContent.toLowerCase();

            // Split location name and address into individual words
            const nameWords = locationName.split(" ");
            const addressWords = locationAddress.split(" ");

            // Check if every word in the search input matches a word in the name or address
            const matchesName = searchWords.every((searchWord) =>
                nameWords.some((word) => word.startsWith(searchWord))
            );

            const matchesAddress = searchWords.every((searchWord) =>
                addressWords.some((word) => word.startsWith(searchWord))
            );

            // Show item if there is a match
            if (matchesName || matchesAddress) {
                item.style.display = "flex";
                hasResults = true;
            } else {
                item.style.display = "none";
            }
        });

        // Show dropdown only if there are matching results
        if (hasResults) {
            searchResults.classList.add("active");
        } else {
            searchResults.classList.remove("active");
        }
    });
});

// Data: Cities for each country
const countryCities = {
    UK: [
        "London",
        "Leeds",
        "Manchester",
        "Birmingham",
        "Brighton",
        "Edinburgh",
        "Belfast",
        "Bristol",
        "Cardiff",
        "Coventry",
        "Exeter",
        "Glasgow",
        "Liverpool",
        "New Castle",
        "Nottingham",
        "Sheffield",
        "Southampton",
        "York",
    ],
    Ireland: ["Dublin"],
    US: [
        "New York",
        "Los Angeles",
        "Chicago",
        "Austin",
        "Washington DC",
        "Houston",
        "Boston",
        "San Francisco",
        "Dallas",
        "Philadephia",
        "Miami",
        "Minneapolis",
    ],
    Australia: ["Sydney", "Melbourne", "Brisbane", "Canberra", "Perth", "Gold Coast", "Adelaide"],
};

document.addEventListener("DOMContentLoaded", () => {
    const countriesContainer = document.getElementById("countries-container");
    const cityElements = document.querySelectorAll(".city");

    function displayCities(country) {
        // Hide all cities
        cityElements.forEach((city) => {
            city.classList.remove("active");
            // Show only cities matching the selected country
            if (city.getAttribute("data-country") === country) {
                city.classList.add("active");
            }
        });
    }

    // Add event listeners for country buttons
    countriesContainer.addEventListener("click", (event) => {
        const clickedCountry = event.target.closest(".country-head");
        if (!clickedCountry) return;

        const country = clickedCountry.getAttribute("data-country");

        // Update the active state of the buttons
        document.querySelectorAll(".country-head").forEach((el) => el.classList.remove("active"));
        clickedCountry.classList.add("active");

        // Display cities for the selected country
        displayCities(country);
    });

    // Initialize the default state
    displayCities("UK"); // Default to UK
    document.querySelector('.country-head[data-country="UK"]').classList.add("active");
});

document.addEventListener("DOMContentLoaded", () => {
    const citiesToMark = [
        "Belfast",
        "Bristol",
        "Cardiff",
        "Coventry",
        "Exeter",
        "Glasgow",
        "Liverpool",
        "New Castle",
        "Nottingham",
        "Southampton",
        "York",
        "New York",
        "Los Angeles",
        "Chicago",
        "Austin",
        "Washington DC",
        "Houston",
        "Boston",
        "San Francisco",
        "Dallas",
        "Philadephia",
        "Miami",
        "Minneapolis",
        "Sydney",
        "Melbourne",
        "Brisbane",
        "Canberra",
        "Perth",
        "Gold Coast",
        "Adelaide",
    ]; // List of cities for 'Coming Soon'

    document.querySelectorAll(".city").forEach((city) => {
        const cityName = city.querySelector(".city-name").textContent.trim();

        if (citiesToMark.includes(cityName)) {
            const overlay = document.createElement("div");
            overlay.className = "coming-soon-overlay";
            overlay.textContent = "Coming Soon";

            city.appendChild(overlay); // Append overlay directly to .city
            city.classList.add("coming-soon"); // Add the "coming-soon" class for CSS styling
        }
    });
});