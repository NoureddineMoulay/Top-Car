'use strict';

/**
 * navbar toggle
 */

const overlay = document.querySelector("[data-overlay]");
const navbar = document.querySelector("[data-navbar]");
const navToggleBtn = document.querySelector("[data-nav-toggle-btn]");
const navbarLinks = document.querySelectorAll("[data-nav-link]");

const navToggleFunc = function () {
  navToggleBtn.classList.toggle("active");
  navbar.classList.toggle("active");
  overlay.classList.toggle("active");
}

navToggleBtn.addEventListener("click", navToggleFunc);
overlay.addEventListener("click", navToggleFunc);

for (let i = 0; i < navbarLinks.length; i++) {
  navbarLinks[i].addEventListener("click", navToggleFunc);
}


// notification drop down //





document.addEventListener('DOMContentLoaded', function() {
    const bellIcon = document.querySelector('.notifications .fa-bell');
    const dropdown = document.querySelector('.notification-dropdown');

    if (bellIcon && dropdown) {
        // Toggle the dropdown when the bell icon is clicked
        bellIcon.addEventListener('click', function(event) {
            dropdown.classList.toggle('show');
            event.stopPropagation(); // Prevent click event from bubbling up to window
        });

        // Close the dropdown if the user clicks outside of it
        window.addEventListener('click', function(event) {
            if (!bellIcon.contains(event.target) && !dropdown.contains(event.target)) {
                dropdown.classList.remove('show');

                // Mark notifications as read when closing the dropdown
                fetch("{{ route('notifications.markAsRead') }}", {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json'
                    }
                })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json(); // Parse the JSON
                    })
                    .then(data => {
                        console.log('Response:', data); // Log the response
                        if (data.success) {
                            const bell = document.querySelector('.has-notifications');
                            if (bell) {
                                bell.classList.remove('has-notifications');
                            }
                            const notificationCount = document.querySelector('.notification-count');
                            if (notificationCount) {
                                notificationCount.style.display = 'none';
                            }
                        } else {
                            throw new Error('Marking notifications as read failed');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
            }
        });
    } else {
        console.error('Bell icon or dropdown not found');
    }
});









/**
 * header active on scroll
 */

const header = document.querySelector("[data-header]");

window.addEventListener("scroll", function () {
  window.scrollY >= 10 ? header.classList.add("active")
    : header.classList.remove("active");
});
/**
 * Tutorial: https://getbutterfly.com/fast-and-accessible-javascript-client-logo-carousel/
 */

/*
const carouselContainer = document.getElementById('carouselContainer');

// Clone the carousel content to create a continuous loop
const carouselItems = carouselContainer.innerHTML;
carouselContainer.innerHTML += carouselItems;

// Set up animation
let scrollLeft = 0;
const scrollSpeed = 1; // Adjust the scroll speed as needed

function animateCarousel() {
    scrollLeft += scrollSpeed;
    if (scrollLeft >= carouselContainer.scrollWidth / 2) {
        scrollLeft = 0;
    }
    carouselContainer.style.transform = `translateX(-${scrollLeft}px)`;
}
 Adjust this interval to control the scroll speed (in milliseconds)
const interval = 20;
setInterval(animateCarousel, interval);
/**/

const carouselContainer = document.getElementById('carouselContainer');

// Clone the carousel content to create a continuous loop
const carouselItems = carouselContainer.innerHTML;
carouselContainer.innerHTML += carouselItems;

// Set up animation
let scrollLeft = 0;
const scrollSpeed = 4; // Adjust the scroll speed as needed

function animateCarousel(timestamp) {
    if (!lastTimestamp) {
        lastTimestamp = timestamp;
    }

    const deltaTime = timestamp - lastTimestamp;
    lastTimestamp = timestamp;

    scrollLeft += scrollSpeed * deltaTime / 60; // Normalize speed
    if (scrollLeft >= carouselContainer.scrollWidth / 2) {
        scrollLeft = 0;
    }
    carouselContainer.style.transform = `translateX(-${scrollLeft}px)`;

    requestAnimationFrame(animateCarousel);
}

let lastTimestamp = null;
requestAnimationFrame(animateCarousel);


