const body = document.querySelector("body"),
    modeToggle = body.querySelector(".mode-toggle");
sidebar = body.querySelector("nav");
sidebarToggle = body.querySelector(".sidebar-toggle");

modeToggle.addEventListener("click", () => {
    body.classList.toggle("dark");
});

sidebarToggle.addEventListener("click", () => {
    sidebar.classList.toggle("close");
});


// document.querySelector(".btntambah").addEventListener("click", function () {
//     document.querySelector(".popup").classList.add("active");
// });

// document.querySelector(".kembali-btn").addEventListener("click", function () {
//     document.querySelector(".popup").classList.remove("active");
// });

// $(window).load(function () {
//     $('#exampleModal').modal('show');
// });