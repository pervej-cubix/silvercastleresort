/*!
 * Start Bootstrap - SB Admin v7.0.7 (https://startbootstrap.com/template/sb-admin)
 * Copyright 2013-2023 Start Bootstrap
 * Licensed under MIT (https://github.com/StartBootstrap/startbootstrap-sb-admin/blob/master/LICENSE)
 */
//
// Scripts
//

window.addEventListener("DOMContentLoaded", (event) => {
    // Toggle the side navigation
    const sidebarToggle = document.body.querySelector("#sidebarToggle");
    if (sidebarToggle) {
        // Uncomment Below to persist sidebar toggle between refreshes
        // if (localStorage.getItem('sb|sidebar-toggle') === 'true') {
        //     document.body.classList.toggle('sb-sidenav-toggled');
        // }
        sidebarToggle.addEventListener("click", (event) => {
            event.preventDefault();
            document.body.classList.toggle("sb-sidenav-toggled");
            localStorage.setItem(
                "sb|sidebar-toggle",
                document.body.classList.contains("sb-sidenav-toggled")
            );
        });
    }
});

// ============ Available Rooms date Grid Container ==============

setTimeout(() => {
    const alert = document.getElementById("success-alert");
    if (alert) {
        const bsAlert = bootstrap.Alert.getOrCreateInstance(alert);
        bsAlert.close();
    }
}, 2000);

// reset alert
document
    .getElementById("resetRoomsForm")
    .addEventListener("submit", function (e) {
        e.preventDefault(); // Prevent immediate submission

        Swal.fire({
            title: "Are you sure?",
            text: "This will delete all available room data!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Yes, reset it!",
        }).then((result) => {
            if (result.isConfirmed) {
                this.submit(); // Submit the form if confirmed
            }
        });
    });

let currentDate = new Date();

function renderCalendar(date) {
    const calendarGrid = document.getElementById("calendar-grid");
    const monthYearLabel = document.getElementById("calendar-month-year");
    const dateInput = document.getElementById("selected-date-text");
    const modal = new bootstrap.Modal(document.getElementById("dateModal"));

    calendarGrid.innerHTML = "";

    const year = date.getFullYear();
    const month = date.getMonth();
    const firstDayOfMonth = new Date(year, month, 1).getDay();
    const daysInMonth = new Date(year, month + 1, 0).getDate();

    // Get actual current month and year
    const today = new Date();
    const currentMonth = today.getMonth();
    const currentYear = today.getFullYear();

    monthYearLabel.textContent = date.toLocaleString("default", {
        month: "long",
        year: "numeric",
    });

    let activeCell = null;

    // Add blank cells before the first day of the month
    for (let i = 0; i < firstDayOfMonth; i++) {
        const emptyCell = document.createElement("div");
        emptyCell.className = "calendar-cell";
        calendarGrid.appendChild(emptyCell);
    }

    for (let day = 1; day <= daysInMonth; day++) {
        const cell = document.createElement("div");
        cell.className = "border p-2 text-center bg-light calendar-cell";
        cell.textContent = day;

        const jsDate = new Date(year, month, day);
        const dd = String(jsDate.getDate()).padStart(2, "0");
        const mm = String(jsDate.getMonth() + 1).padStart(2, "0");
        const yy = String(jsDate.getFullYear()).slice(-2);
        const fullDate = `${dd}-${mm}-${yy}`;

        cell.setAttribute("data-date", fullDate);

        // Enable click only if we're in the real current month
        if (year === currentYear && month === currentMonth) {
            cell.style.cursor = "pointer";

            cell.addEventListener("click", () => {
                if (activeCell) activeCell.classList.remove("active-date");
                cell.classList.add("active-date");
                activeCell = cell;
                dateInput.value = fullDate;

                fetch(`/available-rooms/${fullDate}`)
                    .then((response) => response.json())
                    .then((data) => {
                        // Loop over each room_type input and set value
                        document
                            .querySelectorAll("input[name^='room_types']")
                            .forEach((input) => {
                                const roomType =
                                    input.name.match(/room_types\[(.*)\]/)[1];
                                input.value = data[roomType] ?? ""; // Fill or leave blank
                            });
                    })
                    .catch((error) => {
                        console.log(error);
                        console.error("Error fetching availability:", error);
                    });

                modal.show();
            });
        } else {
            cell.classList.add("text-muted");
            cell.style.cursor = "not-allowed";
        }

        calendarGrid.appendChild(cell);
    }
}

document.getElementById("prev-month").addEventListener("click", () => {
    currentDate.setMonth(currentDate.getMonth() - 1);
    renderCalendar(currentDate);
});

document.getElementById("next-month").addEventListener("click", () => {
    currentDate.setMonth(currentDate.getMonth() + 1);
    renderCalendar(currentDate);
});

// Initial load
renderCalendar(currentDate);

let activeCell = null; // Track currently active cell

cell.addEventListener("click", () => {
    if (activeCell) {
        activeCell.classList.remove("active-date");
    }
    cell.classList.add("active-date");
    activeCell = cell;

    modal.show();
});

//===== Available Rooms Script End ===========

// Select Only Current Month
const now = new Date();
const year = now.getFullYear();
const month = now.getMonth(); // 0-based, Jan = 0

const firstDay = new Date(year, month, 1);
const lastDay = new Date(year, month + 1, 0); // 0th day of next month = last day of current

document.addEventListener("DOMContentLoaded", function () {
    const dateInput = document.getElementById("date");
    const roomFields = document.getElementById("room-fields");

    dateInput.addEventListener("change", function () {
        if (this.value) {
            roomFields.classList.remove("d-none"); // Show the fields
        }
    });
});

// flatpickr("#date", {
//     dateFormat: "Y-m-d",
//     minDate: firstDay,
//     maxDate: lastDay,
// });

// // create available room
// flatpickr(".datepicker", {
//     minDate: "today",
//     dateFormat: "Y-m-d",
// });

// manage reservation
flatpickr("#checkin", {
    dateFormat: "Y-m-d",
    onChange: function (selectedDates, dateStr, instance) {
        // Set the minimum date of checkout as the selected checkin date + 1
        let minDate = new Date(selectedDates[0]);
        minDate.setDate(minDate.getDate() + 1);
        checkoutPicker.set("minDate", minDate);
    },
});

const checkoutPicker = flatpickr("#checkout", {
    dateFormat: "Y-m-d",
});

$(document).ready(function () {
    $("#reservation_manage").DataTable({
        paging: true,
        searching: true,
        ordering: true,
    });
});
