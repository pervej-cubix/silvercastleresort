function formatDate(dateStr) {
    const date = parseDateFromDDMMYYYY(dateStr);
    const options = { weekday: "short", month: "short", day: "numeric" };
    return date.toLocaleDateString(undefined, options);
}

function parseDateFromDDMMYYYY(dateStr) {
    const [day, month, year] = dateStr.split("-").map(Number);
    return new Date(year, month - 1, day); // Month is 0-indexed in JS
}

function calculateNights(checkin, checkout) {
    const checkinDate = parseDateFromDDMMYYYY(checkin);
    const checkoutDate = parseDateFromDDMMYYYY(checkout);
    const timeDiff = checkoutDate - checkinDate;
    return Math.ceil(timeDiff / (1000 * 60 * 60 * 24));
}

// ==== Search Reservation ======
document.addEventListener("DOMContentLoaded", function () {
    const addRoomButtons = document.querySelectorAll(".add-room-btn");
    const checkin = document.getElementById("checkin");
    const checkout = document.getElementById("checkout");

    // Reusable function to fetch and populate availability
    async function fetchAndPopulateAvailability(button) {
        const card = button.closest(".itemAccummo");

        if (!checkin.value || !checkout.value) return;

        const roomType = button.getAttribute("data-roomtype")?.trim();
        if (!roomType) return;

        const roomCountInput = card.querySelector('select[name*="count"]');
        const guestFieldsContainer = card.querySelector(".dynamic-guests");

        // Clear any previously rendered fields
        guestFieldsContainer.innerHTML = "";

        const requestData = {
            checkin: checkin.value,
            checkout: checkout.value,
            // roomTypes: [{ roomType }],
        };

        console.log(requestData, "ppp");

        try {
            const response = await fetch(window.reservationCheck, {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": window.csrfToken,
                },
                body: JSON.stringify(requestData),
            });

            const { data } = await response.json();
            const available = data.hasOwnProperty(roomType)
                ? data[roomType]
                : 0;

            roomCountInput.innerHTML = "";

            if (available > 0) {
                const defaultOpt = document.createElement("option");
                defaultOpt.value = "";
                defaultOpt.textContent = "Select number of rooms";
                roomCountInput.appendChild(defaultOpt);

                for (let i = 1; i <= available; i++) {
                    const opt = document.createElement("option");
                    opt.value = i;
                    opt.textContent = i;
                    roomCountInput.appendChild(opt);
                }
            } else {
                const opt = document.createElement("option");
                opt.value = 0;
                opt.textContent = "No rooms available";
                roomCountInput.appendChild(opt);
            }

            // Attach change listener for dynamic fields
            roomCountInput.addEventListener("change", function () {
                const roomCount = parseInt(this.value);
                guestFieldsContainer.innerHTML = ""; // clear existing fields

                if (roomCount > 0) {
                    for (let i = 1; i <= roomCount; i++) {
                        const roomGroup = document.createElement("div");
                        roomGroup.classList.add(
                            "mb-1",
                            "border",
                            "p-2",
                            "rounded"
                        );

                        roomGroup.innerHTML = `
                        <div class="row g-1 align-items-center mb-1">
                            <div class="col-12 col-sm-2">
                                <h6 class="mb-0">R${i}</h6>
                            </div>
                            <div class="col-12 col-sm-5">
                                <input type="number" class="form-control form-control-sm" placeholder="Adults" 
                                    name="roomtypes[${roomType}][room${i}][adults]" 
                                    min="1" max="3" required>
                            </div>
                            <div class="col-12 col-sm-5">
                                <input type="number" class="form-control form-control-sm" placeholder="Children"
                                    name="roomtypes[${roomType}][room${i}][children]" 
                                    min="0" max="2">
                            </div>
                        </div>
                    `;

                        guestFieldsContainer.appendChild(roomGroup);
                    }
                }
            });
        } catch (err) {
            console.error("API Error:", err);
        }
    }

    // Event listener for Add Room button
    addRoomButtons.forEach((button) => {
        button.addEventListener("click", async () => {
            if (!checkin.value || !checkout.value) {
                alert("Please select both Check-in and Check-out dates first.");
                return;
            }

            await fetchAndPopulateAvailability(button);

            // Toggle form visibility
            const targetId = button.getAttribute("data-target");
            const form = document.querySelector(targetId);
            if (form.classList.contains("d-none")) {
                form.classList.remove("d-none");
                button.textContent = "Cancel";
            } else {
                form.classList.add("d-none");
                button.textContent = "Add Room";
            }
        });
    });

    // Update availability on checkin/checkout change
    [checkin, checkout].forEach((input) => {
        input.addEventListener("change", () => {
            addRoomButtons.forEach((button) => {
                const form = document.querySelector(
                    button.getAttribute("data-target")
                );
                if (!form.classList.contains("d-none")) {
                    fetchAndPopulateAvailability(button);
                }
            });
        });
    });
});

// Reservation Details
let confirmedRooms = [];
// Open Right Side Panel
document.addEventListener("DOMContentLoaded", function () {
    const panel = document.getElementById("guest-details-panel");
    const toggleBtn = document.getElementById("toggle-panel");
    const closeBtn = document.getElementById("close-panel");
    const checkin = document.getElementById("checkin");
    const checkout = document.getElementById("checkout");

    let isPanelOpen = false;

    document.querySelectorAll(".confirm-room-btn").forEach((button) => {
        button.addEventListener("click", function () {
            panel.classList.add("show");
            toggleBtn.style.right = "400px";
            isPanelOpen = true;
        });
    });

    closeBtn.addEventListener("click", function () {
        panel.classList.remove("show");
        toggleBtn.style.right = "0";
        isPanelOpen = false;
    });

    toggleBtn.addEventListener("click", function () {
        if (!checkin.value || !checkout.value) {
            alert("Please select both Check-in and Check-out dates first.");
            return;
        }

        isPanelOpen = !isPanelOpen;

        if (isPanelOpen) {
            panel.classList.add("show");
            toggleBtn.style.right = "400px"; // slide with panel
        } else {
            panel.classList.remove("show");
            toggleBtn.style.right = "0";
        }
    });
});

// Show duration of stay in right side panel
document.addEventListener("DOMContentLoaded", function () {
    const checkin = document.getElementById("checkin");
    const checkout = document.getElementById("checkout");
    const durationHeading = document.getElementById("duration_heading"); // make sure this exists in your HTML

    function updateDurationInfo() {
        if (checkin.value && checkout.value) {
            const nights = calculateNights(checkin.value, checkout.value);

            durationHeading.innerHTML = `
      <div class="row align-items-center g-2 flex-wrap mb-2 mt-4 mb-5">
        <div class="col-auto">
          <span class="badge rounded-pill bg-primary px-3 py-2" style="font-size: 16px;">
            ${formatDate(checkin.value)}
          </span>
        </div>
        <div class="col-auto">
          <span class="badge rounded-pill bg-warning text-dark px-3 py-2" style="font-size: 16px;">
            <strong>${nights}</strong> Night${nights > 1 ? "s" : ""}
          </span>
        </div>
        <div class="col-auto">
          <span class="badge rounded-pill bg-success px-3 py-2" style="font-size: 16px;">
            ${formatDate(checkout.value)}
          </span>
        </div>
      </div>
    `;
        } else {
            durationHeading.innerHTML = ""; // Clear if either date is missing
        }
    }

    checkin.addEventListener("change", updateDurationInfo);
    checkout.addEventListener("change", updateDurationInfo);
});

// ==== After confirm or Add Room ====
document.addEventListener("DOMContentLoaded", function () {
    const confirmButtons = document.querySelectorAll(".confirm-room-btn");
    const checkin = document.getElementById("checkin");
    const checkout = document.getElementById("checkout");
    const showAddedRoom = document.querySelector(".show_added_room");

    confirmButtons.forEach((button) => {
        button.addEventListener("click", () => {
            const formId = button.getAttribute("data-form-id");
            const form = document.getElementById(formId);
            if (!form) return;

            const roomType = form.querySelector('input[name*="[type]"]').value;
            const roomCount = parseInt(
                form.querySelector('select[name*="[count]"]').value || 0
            );
            const checkinDate = checkin.value;
            const checkoutDate = checkout.value;

            const roomDetails = [];
            let totalPeople = 0;

            for (let i = 1; i <= roomCount; i++) {
                const adultInput = form.querySelector(
                    `input[name="roomtypes[${roomType}][room${i}][adults]"]`
                );
                const childInput = form.querySelector(
                    `input[name="roomtypes[${roomType}][room${i}][children]"]`
                );

                const adults = parseInt(adultInput?.value || 0);
                const children = parseInt(childInput?.value || 0);

                // ✅ Require at least 1 adult per room
                if (adults < 1) {
                    alert(`Room ${i}: Must have at least 1 adult.`);
                    return;
                }

                const roomTotal = adults + children;
                totalPeople += roomTotal;

                // ✅ Maximum total guests across all rooms is 5
                // if (totalPeople > 5) {
                //     alert(
                //         "Total number of guests (adults + children) across all rooms must not exceed 5."
                //     );
                //     return;
                // }

                roomDetails.push({
                    roomType,
                    room: i,
                    adults,
                    children,
                });
            }

            let group = confirmedRooms.find(
                (r) => r.checkin === checkinDate && r.checkout === checkoutDate
            );

            if (!group) {
                group = {
                    id: Date.now(),
                    checkin: checkinDate,
                    checkout: checkoutDate,
                    roomTypes: [],
                    rooms: [],
                };
                confirmedRooms.push(group);
            }

            // Replace any previous data of the same room type
            group.roomTypes = group.roomTypes.filter(
                (rt) => rt.roomType !== roomType
            );
            group.rooms = group.rooms.filter((r) => r.roomType !== roomType);

            group.roomTypes.push({
                roomType,
                no_of_room: roomCount,
            });

            group.rooms.push(...roomDetails);

            // Disable confirm button after confirmation
            button.disabled = true;

            renderConfirmedRooms();

            // Collapse form
            form.classList.add("d-none");

            // Change corresponding Add Room button text to "Add Room"
            const toggleBtn = document.querySelector(
                `.add-room-btn[data-target="#${formId}"]`
            );
            if (toggleBtn) toggleBtn.textContent = "Add Room";
        });
    });

    function renderConfirmedRooms() {
        showAddedRoom.innerHTML = "";

        confirmedRooms.forEach((roomGroup) => {
            const div = document.createElement("div");
            div.className = "border p-2 mb-2 rounded bg-light";

            let roomHTML = "";
            roomGroup.roomTypes.forEach((rt) => {
                const matchingRooms = roomGroup.rooms.filter(
                    (r) => r.roomType === rt.roomType
                );
                const totalAdults = matchingRooms.reduce(
                    (sum, r) => sum + r.adults,
                    0
                );
                const totalChildren = matchingRooms.reduce(
                    (sum, r) => sum + r.children,
                    0
                );

                roomHTML += `
          <div class="card mb-3 shadow-sm">
            <div class="card-body">
              <div class="d-flex justify-content-between align-items-center mb-2">
                <h5 class="mb-0" style="font-size: 17px;"><strong>Room Type:</strong> ${rt.roomType}</h5>
                <span class="badge bg-secondary">Rooms: ${rt.no_of_room}</span>
              </div>

              <table class="table table-sm table-bordered mb-3">
                <thead class="table-light">
                  <tr>
                    <th>Adults</th>
                    <th>Children</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>${totalAdults}</td>
                    <td>${totalChildren}</td>
                    <td>
                      <div class="d-flex gap-1">
                        <button class="btn btn-sm btn-danger" onclick="removeRoom(${roomGroup.id}, '${rt.roomType}')">
                          <i class="fa-solid fa-xmark"></i>
                        </button>
                        <button class="btn btn-sm btn-primary" onclick="editRoom(${roomGroup.id}, '${rt.roomType}')">
                          <i class="fa-solid fa-pen-to-square"></i>
                        </button>
                      </div>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        `;
            });

            div.innerHTML = roomHTML;
            showAddedRoom.appendChild(div);
        });
    }

    window.removeRoom = function (groupId, roomType) {
        const group = confirmedRooms.find((g) => g.id === groupId);
        if (!group) return;

        // Remove the roomType and rooms
        group.roomTypes = group.roomTypes.filter(
            (rt) => rt.roomType !== roomType
        );
        group.rooms = group.rooms.filter((r) => r.roomType !== roomType);

        // If no more roomTypes, remove the entire group
        if (group.roomTypes.length === 0) {
            confirmedRooms = confirmedRooms.filter((g) => g.id !== groupId);
        }

        // Enable the confirm button again for the corresponding form
        const form = document
            .querySelector(`input[value="${roomType}"]`)
            ?.closest(".room-form");

        if (form) {
            const confirmBtn = form.querySelector(
                `.confirm-room-btn[data-form-id="${form.id}"]`
            );
            if (confirmBtn) confirmBtn.disabled = false;
        }

        renderConfirmedRooms();
    };

    window.editRoom = function (groupId, roomType) {
        const group = confirmedRooms.find((g) => g.id === groupId);
        if (!group) return;

        const form = document
            .querySelector(`input[value="${roomType}"]`)
            ?.closest(".room-form");
        if (!form) return;

        form.classList.remove("d-none");
        form.scrollIntoView({ behavior: "smooth" });

        const roomCount =
            group.roomTypes.find((rt) => rt.roomType === roomType)
                ?.no_of_room || 0;
        const countSelect = form.querySelector(`select[name*="[count]"]`);
        countSelect.value = roomCount;

        const matchingRooms = group.rooms.filter(
            (r) => r.roomType === roomType
        );
        for (let i = 1; i <= roomCount; i++) {
            const adult = form.querySelector(
                `input[name="roomtypes[${roomType}][room${i}][adults]"]`
            );
            const child = form.querySelector(
                `input[name="roomtypes[${roomType}][room${i}][children]"]`
            );
            if (adult) adult.value = matchingRooms[i - 1]?.adults ?? "";
            if (child) child.value = matchingRooms[i - 1]?.children ?? "";
        }

        // Enable the corresponding confirm button again
        const confirmBtn = document.querySelector(
            `.confirm-room-btn[data-form-id="${form.id}"]`
        );
        if (confirmBtn) confirmBtn.disabled = false;

        group.roomTypes = group.roomTypes.filter(
            (rt) => rt.roomType !== roomType
        );
        group.rooms = group.rooms.filter((r) => r.roomType !== roomType);

        if (group.roomTypes.length === 0) {
            confirmedRooms = confirmedRooms.filter((g) => g.id !== groupId);
        }

        renderConfirmedRooms();
    };
});

// Guest Details information
document.addEventListener("DOMContentLoaded", function () {
    document
        .getElementById("personal-form")
        .addEventListener("submit", function (e) {
            e.preventDefault();

            if (!validateRoomSelection()) return;

            const guestDetails = {
                fullName: document
                    .getElementById("personal-full-name")
                    .value.trim(),
                email: document.getElementById("personal-email").value.trim(),
                phone: document.getElementById("personal-phone").value.trim(),
                country: document.getElementById("personal-country").value,
                address: document
                    .getElementById("personal-address")
                    .value.trim(),
                requests: document
                    .getElementById("personal-requests")
                    .value.trim(),
            };

            saveGuestDetails("personal", guestDetails);
        });

    document
        .getElementById("business-form")
        .addEventListener("submit", function (e) {
            e.preventDefault();

            if (!validateRoomSelection()) return;

            const guestDetails = {
                fullName: document
                    .getElementById("business-full-name")
                    .value.trim(),
                companyName: document
                    .getElementById("company-name")
                    .value.trim(),
                email: document.getElementById("business-email").value.trim(),
                phone: document.getElementById("business-phone").value.trim(),
                country: document.getElementById("business-country").value,
                address: document
                    .getElementById("business-address")
                    .value.trim(),
                requests: document
                    .getElementById("business-requests")
                    .value.trim(),
            };

            saveGuestDetails("business", guestDetails);
        });

    function validateRoomSelection() {
        if (
            confirmedRooms.length === 0 ||
            confirmedRooms[0].roomTypes.length === 0 ||
            confirmedRooms[0].rooms.length === 0
        ) {
            alert("Please select room type and rooms before proceeding.");
            return false;
        }
        return true;
    }

    function saveGuestDetails(type, details) {
        if (confirmedRooms.length === 0) {
            confirmedRooms.push({
                id: Date.now(),
                roomTypes: [],
                rooms: [],
                guestType: type,
                guestDetails: details,
            });
        } else {
            confirmedRooms[0].guestType = type;
            confirmedRooms[0].guestDetails = details;
        }

        console.log("Confirmed Room Guest Details:", confirmedRooms);
        alert("Guest information saved successfully!");
    }
});
