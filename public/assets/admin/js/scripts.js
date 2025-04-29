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
