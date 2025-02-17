document.addEventListener("DOMContentLoaded", () => {
    const bigScreenTrigger = document.getElementById("big-screen-contact-trigger");
    const smallScreenTrigger = document.getElementById("small-screen-contact-trigger");
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
        if (dropdown.style.display === "none" || dropdown.style.display === "") {
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
