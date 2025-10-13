// Please see documentation at https://learn.microsoft.com/aspnet/core/client-side/bundling-and-minification
// for details on configuring this project to bundle and minify static web assets.

// Write your JavaScript code.
document.addEventListener("DOMContentLoaded", function () {
    const tableRows = document.querySelectorAll("table tr");

    tableRows.forEach(row => {
        row.addEventListener("mouseenter", function () {
            this.style.backgroundColor = "#e1bee7"; // Mov pal
            this.style.transition = "background-color 0.3s ease";
        });

        row.addEventListener("mouseleave", function () {
            this.style.backgroundColor = "";
        });
    });
});


