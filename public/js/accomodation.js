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

const gridContainer = document.querySelector(".grid-images");
const gridImagesData = JSON.parse(gridContainer.dataset.images || "[]");
let images = document.querySelectorAll(".grid-images .item");
let currentIndex = 0; // Track the current image index

document.addEventListener("DOMContentLoaded", () => {
    let images = document.querySelectorAll(".grid-images .item");
    let totalImages = images.length;
    let currentIndex = 0;

    if (totalImages === 0) {
        console.error(
            "No images found in .grid-images. Make sure the elements exist."
        );
        return;
    }

    function showImages(startIndex) {
        if (!images || images.length === 0) {
            console.error("Images array is empty or not defined");
            return;
        }

        images.forEach((img) =>
            img.classList.remove(
                "visible",
                "left",
                "upper_right",
                "lower_right"
            )
        );
        images[startIndex % totalImages].classList.add("visible");

        if (window.innerWidth > 576) {
            images[startIndex % totalImages].classList.add("visible", "left");
            images[(startIndex + 1) % totalImages].classList.add(
                "visible",
                "upper_right"
            );
            images[(startIndex + 2) % totalImages].classList.add(
                "visible",
                "lower_right"
            );
        }

        let counter = document.querySelector(".image-counter");
        if (counter) {
            let currentImage = (startIndex % totalImages) + 1;
            counter.textContent = `${currentImage}/${totalImages}`;
        }
    }

    function isSmallScreen() {
        return window.innerWidth <= 576;
    }

    function changeImage(direction) {
        currentIndex = (currentIndex + direction + totalImages) % totalImages;
        showImages(currentIndex);
    }

    function addNavigationControls() {
        let rightArrow = document.querySelector(".right-arrow");
        let leftArrow = document.querySelector(".left-arrow");

        if (rightArrow && leftArrow) {
            rightArrow.addEventListener("click", () => changeImage(1));
            leftArrow.addEventListener("click", () => changeImage(-1));
        } else {
            console.error(
                "Right or left arrow button not found. Make sure they exist in the DOM."
            );
        }
    }

    function addSwipeFunctionality() {
        let touchStartX = 0;
        let touchEndX = 0;
        const gridContainer = document.querySelector(".grid-images");

        if (!gridContainer) {
            console.error("Grid container not found");
            return;
        }

        gridContainer.addEventListener("touchstart", (e) => {
            touchStartX = e.changedTouches[0].screenX;
        });

        gridContainer.addEventListener("touchend", (e) => {
            touchEndX = e.changedTouches[0].screenX;
            handleSwipe();
        });

        function handleSwipe() {
            if (touchEndX < touchStartX - 50) {
                changeImage(1); // Swipe left
            } else if (touchEndX > touchStartX + 50) {
                changeImage(-1); // Swipe right
            }
        }
    }

    showImages(currentIndex);
    addNavigationControls();

    if (isSmallScreen()) {
        addSwipeFunctionality();
    }

    window.addEventListener("resize", () => {
        if (isSmallScreen()) {
            addSwipeFunctionality();
        }
    });
});

document.addEventListener("DOMContentLoaded", () => {
    // Select all room elements
    const roomElements = document.querySelectorAll(".property-room-items");

    if (roomElements.length === 0) {
        console.warn("No rooms found.");
        return;
    }

    roomElements.forEach((roomElement, index) => {
        let imagesData = JSON.parse(roomElement.dataset.images || "[]");
        if (!imagesData || imagesData.length === 0) return;

        let currentIndex = 0;
        let totalImages = imagesData.length;
        const imageContainers = roomElement.querySelectorAll(".photo-item");
        const counter = roomElement.querySelector(".room-image-counter");

        function showRoomImages(startIndex) {
            if (!imageContainers || imageContainers.length === 0) return;

            // Remove 'visible' class from all `.photo-item` divs
            imageContainers.forEach((container) =>
                container.classList.remove("visible")
            );

            // Apply 'visible' class to the current `.photo-item`
            imageContainers[startIndex % totalImages].classList.add("visible");

            if (counter) {
                counter.textContent = `${
                    (startIndex % totalImages) + 1
                }/${totalImages}`;
            }
        }

        showRoomImages(currentIndex);

        // Navigation Button Handlers
        const rightArrow = roomElement.querySelector(".room-right-arrow");
        const leftArrow = roomElement.querySelector(".room-left-arrow");

        if (rightArrow) {
            rightArrow.addEventListener("click", () => {
                currentIndex = (currentIndex + 1) % totalImages;
                showRoomImages(currentIndex);
            });
        }

        if (leftArrow) {
            leftArrow.addEventListener("click", () => {
                currentIndex = (currentIndex - 1 + totalImages) % totalImages;
                showRoomImages(currentIndex);
            });
        }

        // Swipe Functionality for Mobile Users
        let touchStartX = 0;
        let touchEndX = 0;

        roomElement.addEventListener("touchstart", (e) => {
            touchStartX = e.changedTouches[0].screenX;
        });

        roomElement.addEventListener("touchend", (e) => {
            touchEndX = e.changedTouches[0].screenX;
            handleRoomSwipe();
        });

        function handleRoomSwipe() {
            if (touchEndX < touchStartX - 50) {
                // Swipe left → Next image
                currentIndex = (currentIndex + 1) % totalImages;
            } else if (touchEndX > touchStartX + 50) {
                // Swipe right → Previous image
                currentIndex = (currentIndex - 1 + totalImages) % totalImages;
            }
            showRoomImages(currentIndex);
        }
    });
});

// fullscreeen
document.addEventListener("DOMContentLoaded", function () {
    let allImages = [];
    let imageSources = [];
    let currentImageIndex = 0;

    const modal = document.getElementById("image-full-modal");
    const modalImage = document.querySelector(".modal-full-image");
    const closeModal = document.querySelector(".close-full-modal");
    const leftArrowModal = document.querySelector(".left-arrow-full-modal");
    const rightArrowModal = document.querySelector(".right-arrow-full-modal");

    // Function to collect images dynamically
    function gatherImages() {
        allImages = [];
        imageSources = [];

        document.querySelectorAll(".grid-images .item img, .property-room-items .photo-item img")
            .forEach((img) => {
                allImages.push(img);
                imageSources.push(img.src);
            });
    }

    // Function to open modal
    function openModal(index) {
        modal.classList.add("show");
        modalImage.src = imageSources[index];
        currentImageIndex = index;
        document.addEventListener("keydown", handleKeyNavigation);
    }

    // Function to close modal
    function closeImageModal() {
        modal.classList.remove("show");
        document.removeEventListener("keydown", handleKeyNavigation);
    }

    // Function to navigate images
    function navigateLeft() {
        currentImageIndex = (currentImageIndex - 1 + imageSources.length) % imageSources.length;
        modalImage.src = imageSources[currentImageIndex];
    }

    function navigateRight() {
        currentImageIndex = (currentImageIndex + 1) % imageSources.length;
        modalImage.src = imageSources[currentImageIndex];
    }

    // Event Handlers
    closeModal.addEventListener("click", closeImageModal);
    modal.addEventListener("click", (e) => e.target === modal && closeImageModal());
    leftArrowModal.addEventListener("click", navigateLeft);
    rightArrowModal.addEventListener("click", navigateRight);

    // Keyboard Navigation
    function handleKeyNavigation(e) {
        if (e.key === "ArrowLeft") navigateLeft();
        if (e.key === "ArrowRight") navigateRight();
        if (e.key === "Escape") closeImageModal();
    }

    // Swipe functionality for mobile
    let touchStartX = 0, touchEndX = 0;

    modal.addEventListener("touchstart", (e) => (touchStartX = e.changedTouches[0].screenX));
    modal.addEventListener("touchend", (e) => {
        touchEndX = e.changedTouches[0].screenX;
        if (touchEndX < touchStartX - 50) navigateRight();
        if (touchEndX > touchStartX + 50) navigateLeft();
    });

    // Add event listeners to all images to open them in fullscreen
    function addImageListeners() {
        allImages.forEach((img, index) => {
            img.addEventListener("click", () => openModal(index));
        });
    }

    // Initialize image handling
    function initializeImageHandling() {
        gatherImages();
        addImageListeners();
    }

    // Run initial setup
    initializeImageHandling();
});


// Here for the right section accordion
document
    .querySelectorAll(".USPSection-module__accordionHeader")
    .forEach((header) => {
        header.addEventListener("click", () => {
            const accordionItem = header.closest(".accordion-item"); // Get the clicked accordion item
            const content = accordionItem.querySelector(".accordion-content"); // Get its content section
            const chevronIcon = header.querySelector(".chevron-icon"); // Get the chevron icon

            // Close all other accordion items
            document.querySelectorAll(".accordion-item").forEach((item) => {
                if (item !== accordionItem) {
                    item.classList.remove("open"); // Close the other item
                    item.querySelector(".accordion-content").style.display =
                        "none"; // Hide its content
                    item.querySelector(".chevron-icon").classList.remove(
                        "rotate"
                    ); // Reset its chevron
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

document.addEventListener("DOMContentLoaded", function () {
    const nestfindModal = document.getElementById("nestfind-modal");
    const closeButton = document.querySelector(".close-button");

    // Function to open modal
    function openModal() {
        nestfindModal.classList.add("active");
    }

    // Function to close modal
    closeButton.addEventListener("click", function () {
        nestfindModal.classList.remove("active");
    });

    // Close modal if clicked outside
    window.addEventListener("click", function (event) {
        if (event.target === nestfindModal) {
            nestfindModal.classList.remove("active");
        }
    });

    // Handle 'Enquire Now' button click (General Enquiry)
    document
        .getElementById("enquire-now-btn")
        .addEventListener("click", function () {
            document.getElementById("room-id").value = ""; // No specific room
            openModal();
        });

    // Handle 'Book Now' buttons for specific rooms
    document.querySelectorAll(".book-now-btn").forEach((button) => {
        button.addEventListener("click", function () {
            const roomItem = this.closest(".room-length-item");

            if (roomItem) {
                const roomId = roomItem.getAttribute("data-room-id"); // Fetch room ID
                document.getElementById("room-id").value = roomId; // Set in form

                openModal();
            }
        });
    });
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
