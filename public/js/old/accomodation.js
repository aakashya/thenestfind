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

let images = document.querySelectorAll(".grid-images .item");
let totalImages = images.length;
let currentIndex = 0; // Track the current image index

// Function to show images (for all screen sizes)
function showImages(startIndex) {
    images.forEach((img) => img.classList.remove("visible", "left", "upper_right", "lower_right"));

    images[startIndex % totalImages].classList.add("visible"); // Show the current image
    if (!isSmallScreen()) {
        // For larger screens, show three images as before
        images[startIndex % totalImages].classList.add("visible", "left");
        images[(startIndex + 1) % totalImages].classList.add("visible", "upper_right");
        images[(startIndex + 2) % totalImages].classList.add("visible", "lower_right");
    }

    // Update the counter dynamically
    let counter = document.querySelector(".image-counter");
    let currentImage = (startIndex % totalImages) + 1;
    counter.textContent = `${currentImage}/${totalImages}`;
}

// Detect if it's a small screen
function isSmallScreen() {
    return window.innerWidth <= 576;
}

// Initial display of images
showImages(currentIndex);

// Desktop Arrow Navigation
document.querySelector(".right-arrow").addEventListener("click", function () {
    currentIndex = (currentIndex + 1) % totalImages; // Move forward by 1
    showImages(currentIndex);
});

document.querySelector(".left-arrow").addEventListener("click", function () {
    currentIndex = (currentIndex - 1 + totalImages) % totalImages; // Move backward by 1
    showImages(currentIndex);
});

// Add swipe functionality for mobile users
function addSwipeFunctionality() {
    let touchStartX = 0;
    let touchEndX = 0;

    const gridContainer = document.querySelector(".grid-images");

    // When touch starts
    gridContainer.addEventListener("touchstart", function (e) {
        touchStartX = e.changedTouches[0].screenX;
    });

    // When touch ends
    gridContainer.addEventListener("touchend", function (e) {
        touchEndX = e.changedTouches[0].screenX;
        handleSwipe();
    });

    // Handle swipe direction
    function handleSwipe() {
        if (touchEndX < touchStartX - 50) {
            // Swiped left
            currentIndex = (currentIndex + 1) % totalImages; // Move forward by 1
        } else if (touchEndX > touchStartX + 50) {
            // Swiped right
            currentIndex = (currentIndex - 1 + totalImages) % totalImages; // Move backward by 1
        }
        showImages(currentIndex);
    }
}

// Initialize swipe functionality only on small screens
if (isSmallScreen()) {
    addSwipeFunctionality();
}

// Window resize event to re-check screen size
window.addEventListener("resize", function () {
    if (isSmallScreen()) {
        addSwipeFunctionality();
    }
});

// Function to handle room image rotation for multiple rooms
function setupRoom(roomClass) {
    const roomElement = document.querySelector(`.${roomClass}`);
    const images = roomElement.querySelectorAll(".photo-item");
    const totalImages = images.length;
    let currentIndex = 0; // Track the current image index

    // Function to show the current set of images
    function showImages(startIndex) {
        // Hide all images
        images.forEach((img) => img.classList.remove("visible"));

        // Show the current image
        images[startIndex % totalImages].classList.add("visible");

        // Update the counter dynamically
        const counter = roomElement.querySelector(".room-image-counter");
        const currentImage = (startIndex % totalImages) + 1;
        counter.textContent = `${currentImage}/${totalImages}`;
    }

    // Initial display of images
    showImages(currentIndex);

    // Right arrow event for desktop and larger screens
    const rightArrow = roomElement.querySelector(".room-right-arrow");
    const leftArrow = roomElement.querySelector(".room-left-arrow");

    if (rightArrow) {
        rightArrow.addEventListener("click", function () {
            currentIndex = (currentIndex + 1) % totalImages; // Move forward by 1
            showImages(currentIndex);
        });
    }

    // Left arrow event for desktop and larger screens
    if (leftArrow) {
        leftArrow.addEventListener("click", function () {
            currentIndex = (currentIndex - 1 + totalImages) % totalImages; // Move backward by 1
            showImages(currentIndex);
        });
    }

    // Add swipe functionality for mobile users
    let touchStartX = 0;
    let touchEndX = 0;

    roomElement.addEventListener("touchstart", function (e) {
        touchStartX = e.changedTouches[0].screenX;
    });

    roomElement.addEventListener("touchend", function (e) {
        touchEndX = e.changedTouches[0].screenX;
        handleRoomSwipe();
    });

    function handleRoomSwipe() {
        if (touchEndX < touchStartX - 50) {
            currentIndex = (currentIndex + 1) % totalImages; // Swipe left, go to next image
        } else if (touchEndX > touchStartX + 50) {
            currentIndex = (currentIndex - 1 + totalImages) % totalImages; // Swipe right, go to previous image
        }
        showImages(currentIndex);
    }
}

// Function to safely call setupRoom
function safeSetupRoom(roomClass) {
    const roomElement = document.querySelector(`.${roomClass}`);
    if (roomElement) {
        setupRoom(roomClass);
    } else {
        console.warn(`Room element with class '${roomClass}' does not exist.`);
    }
}

// Set up for all rooms using safeSetupRoom
safeSetupRoom("room1"); // For room 1
safeSetupRoom("room2"); // For room 2
safeSetupRoom("room3"); // For room 3
safeSetupRoom("room4"); // If room4 doesn't exist, it won't throw an error
safeSetupRoom("room5");
safeSetupRoom("room6");
safeSetupRoom("room7");

// Fullscreen functionality starts here

// Select all images across all grids (main and room grids)
let allImages = [];
let imageSources = [];
let currentImageIndex = 0;

// Collect images from the main grid and all rooms
function gatherImages() {
    allImages = [];
    imageSources = [];

    // Gather images from the main grid
    let mainGridImages = document.querySelectorAll(".grid-images .item img");
    mainGridImages.forEach((img) => {
        allImages.push(img);
        imageSources.push(img.src);
    });

    // Gather images from all rooms
    let roomImages = document.querySelectorAll(".property-room-items .photo-item img");
    roomImages.forEach((img) => {
        allImages.push(img);
        imageSources.push(img.src);
    });
}

// Call the function initially to gather all images
gatherImages();

// Fullscreen modal elements
const modal = document.getElementById("image-full-modal");
const modalImage = document.querySelector(".modal-full-image");
const closeModal = document.querySelector(".close-full-modal");
const leftArrowModal = document.querySelector(".left-arrow-full-modal");
const rightArrowModal = document.querySelector(".right-arrow-full-modal");

// Function to open the modal
function openModal(index) {
    modal.classList.add("show");
    modalImage.src = imageSources[index];
    currentImageIndex = index;

    // Add event listener for keyboard navigation
    document.addEventListener("keydown", handleKeyNavigation);
}

// Function to close the modal
function closeImageModal() {
    modal.classList.remove("show");

    // Remove the keydown event listener when the modal is closed
    document.removeEventListener("keydown", handleKeyNavigation);
}

// Close modal when the close button is clicked
closeModal.addEventListener("click", closeImageModal);

// Close modal when clicking on the background (outside the image)
modal.addEventListener("click", (e) => {
    if (e.target === modal) {
        closeImageModal();
    }
});

// Function to navigate to the previous image
function navigateLeft() {
    currentImageIndex = (currentImageIndex - 1 + imageSources.length) % imageSources.length;
    modalImage.src = imageSources[currentImageIndex];
}

// Function to navigate to the next image
function navigateRight() {
    currentImageIndex = (currentImageIndex + 1) % imageSources.length;
    modalImage.src = imageSources[currentImageIndex];
}

// Left and right arrow button navigation
leftArrowModal.addEventListener("click", navigateLeft);
rightArrowModal.addEventListener("click", navigateRight);

// Add event listeners to all images to open them in fullscreen
function addImageListeners() {
    allImages.forEach((img, index) => {
        img.addEventListener("click", () => {
            openModal(index);
        });
    });
}

// Initial image listener setup
addImageListeners();

// Reinitialize image gathering and listeners when needed (for example, if you add more rooms dynamically)
function reinitializeImageHandling() {
    gatherImages();
    addImageListeners();
}

// Swipe functionality for mobile users in fullscreen mode
let touchStartX = 0;
let touchEndX = 0;

modal.addEventListener("touchstart", function (e) {
    touchStartX = e.changedTouches[0].screenX;
});

modal.addEventListener("touchend", function (e) {
    touchEndX = e.changedTouches[0].screenX;
    handleSwipe();
});

function handleSwipe() {
    if (touchEndX < touchStartX - 50) {
        navigateRight(); // Swipe left (next image)
    } else if (touchEndX > touchStartX + 50) {
        navigateLeft(); // Swipe right (previous image)
    }
}

// Function to handle keyboard navigation
function handleKeyNavigation(e) {
    if (e.key === "ArrowLeft") {
        navigateLeft(); // Left arrow key
    } else if (e.key === "ArrowRight") {
        navigateRight(); // Right arrow key
    }
}

// Here for the right section accordion
document.querySelectorAll(".USPSection-module__accordionHeader").forEach((header) => {
    header.addEventListener("click", () => {
        const accordionItem = header.closest(".accordion-item"); // Get the clicked accordion item
        const content = accordionItem.querySelector(".accordion-content"); // Get its content section
        const chevronIcon = header.querySelector(".chevron-icon"); // Get the chevron icon

        // Close all other accordion items
        document.querySelectorAll(".accordion-item").forEach((item) => {
            if (item !== accordionItem) {
                item.classList.remove("open"); // Close the other item
                item.querySelector(".accordion-content").style.display = "none"; // Hide its content
                item.querySelector(".chevron-icon").classList.remove("rotate"); // Reset its chevron
            }
        });

        // Toggle the clicked accordion item
        if (accordionItem.classList.contains("open")) {
            accordionItem.classList.remove("open");
            content.style.display = "none"; // Hide the content
            chevronIcon.classList.remove("rotate"); // Reset the chevron
        } else {
            accordionItem.classList.add("open");
            content.style.display = "block"; // Show the content
            chevronIcon.classList.add("rotate"); // Rotate the chevron
        }
    });
});

// Select the modal and the buttons
const nestfindModal = document.getElementById("nestfind-modal");
// Remove this line as the button now has 'enquire-now-btn' id
// const openModalButton = document.getElementById("open-modal-button");

const closeButton = document.querySelector(".close-button");

// Function to open the modal for 'Enquire Now' button
document.getElementById("enquire-now-btn").addEventListener("click", function () {
    nestfindModal.classList.add("active"); // Add 'active' class to show the modal
});

// Function to close the modal when the 'X' button is clicked
closeButton.addEventListener("click", function () {
    nestfindModal.classList.remove("active"); // Remove 'active' class to hide the modal
});

// Function to close the modal if the user clicks outside the modal content
window.addEventListener("click", function (event) {
    if (event.target === nestfindModal) {
        nestfindModal.classList.remove("active");
    }
});

// For Book Now buttons
document.querySelectorAll(".book-now-btn").forEach((button) => {
    button.addEventListener("click", function () {
        const roomItem = this.closest(".room-length-item");

        // Check if we have a valid room item
        if (roomItem) {
            const duration = roomItem.querySelector(".duration-time p").textContent.trim();
            const price = roomItem.querySelector(".price-value").textContent.trim();

            // Find the nearest room-details container
            const roomDetails = this.closest(".room-length").previousElementSibling;

            if (roomDetails && roomDetails.querySelector("h3")) {
                const roomName = roomDetails.querySelector("h3").textContent.trim();

                // Get accommodation name from the property header
                const accommodationName = document.querySelector(".property-head-name h1").textContent.trim();

                // Set form hidden input values
                document.getElementById("room-duration").value = duration;
                document.getElementById("room-price").value = price;
                document.getElementById("accommodation-name").value = accommodationName;
                document.getElementById("room-name").value = roomName;

                // Open the modal
                nestfindModal.classList.add("active");
            } else {
                console.error("Room details not found for the clicked Book Now button");
            }
        }
    });
});

// For Enquire Now button
document.getElementById("enquire-now-btn").addEventListener("click", function () {
    // Set form hidden input values to empty or N/A
    document.getElementById("room-duration").value = "N/A";
    document.getElementById("room-price").value = "N/A";
    document.getElementById("accommodation-name").value = "N/A";
    document.getElementById("room-name").value = "N/A";

    // Open the modal
    nestfindModal.classList.add("active");
});


// readmore
// document.querySelectorAll('.property-about-body').forEach(function(descriptionContainer) {
//     const description = descriptionContainer.querySelector('.description');
//     const button = descriptionContainer.querySelector('.read-more-btn');
  
//     button.addEventListener('click', function() {
//       if (description.style.maxHeight === '80px') {
//         description.style.maxHeight = 'none';  // Expand
//         button.textContent = 'Show Less';  // Change button text
//       } else {
//         description.style.maxHeight = '80px';  // Collapse
//         button.textContent = 'Show More';  // Revert button text
//       }
//     });
//   });
// document.querySelectorAll('.property-about-body').forEach(function(descriptionContainer) {
//     const description = descriptionContainer.querySelector('.description');
//     const button = descriptionContainer.querySelector('.read-more-btn');
  
//     // Set initial state for the description
//     description.style.maxHeight = '80px';
  
//     button.addEventListener('click', function() {
//       if (description.style.maxHeight === '80px' || description.style.maxHeight === '') {
//         description.style.maxHeight = 'none';  // Expand the description
//         button.textContent = 'Show Less';      // Change button text
//       } else {
//         description.style.maxHeight = '80px';  // Collapse the description
//         button.textContent = 'Show More';      // Revert button text
//       }
//     });
//   });
  
  