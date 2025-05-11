function openMenu() {
    document.getElementById("fullscreenMenu").classList.add("open");
}

function closeMenu() {
    document.getElementById("fullscreenMenu").classList.remove("open");
}

/**For home page */
// window.addEventListener("scroll", function () {
//     const bookNowButton = document.querySelector(".booknowHome");
//     const menuButton = document.querySelector(".menu-button-home");

//     if (window.scrollY > 500) {
//         // Change 50 to the scroll threshold you want
//         bookNowButton.classList.add("scroll-active");
//         menuButton.classList.add("scroll-active");
//     } else {
//         bookNowButton.classList.remove("scroll-active");
//         menuButton.classList.remove("scroll-active");
//     }
// });

// Offer show //

function toggleOfferImg(event) {
    event.preventDefault(); // Prevent default anchor behavior
    const offerImg = event.currentTarget.querySelector(".offerImg");
    offerImg.classList.toggle("active"); // Toggle the 'active' class
}

// g-captcha
// document.addEventListener("DOMContentLoaded", function () {
//     document.querySelector("form").addEventListener("submit", function (event) {
//         event.preventDefault(); // Prevent default reload

//         if (grecaptcha.getResponse() === "") {
//             alert("Please complete the reCAPTCHA.");
//             return false;
//         }

//         this.submit(); // If reCAPTCHA is completed, submit form
//     });
// });

// flatpicker
const checkin = flatpickr("#checkin", {
    dateFormat: "d-m-Y",
    minuteIncrement: 1,
    minDate: new Date(),
    onChange: function (selectedDates) {
        const selectedCheckin = selectedDates[0];
        checkout.set("minDate", selectedCheckin); // allow same day or later
    },
});

const checkout = flatpickr("#checkout", {
    dateFormat: "d-m-Y",
    minuteIncrement: 2,
    minDate: new Date(),
});

// close header menu from anywherer
document.addEventListener("click", function (event) {
    const menu = document.getElementById("fullscreenMenu");
    const content = menu.querySelector(".overlay");
    const isOpen = menu.classList.contains("open");

    // If menu is open AND click is outside the overlay content
    if (isOpen && !content.contains(event.target)) {
        menu.classList.remove("open");
    }
});

let tooltipTriggerList = Array.from(
    document.querySelectorAll('[data-bs-toggle="tooltip"]')
);
tooltipTriggerList.forEach(function (tooltipTriggerEl) {
    new bootstrap.Tooltip(tooltipTriggerEl);
});
