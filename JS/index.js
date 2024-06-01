window.addEventListener("scroll", function () {
    var header = document.querySelector("nav");
    header.classList.toggle("navbar-scrolled", window.scrollY > 0);
});

document.addEventListener("DOMContentLoaded", function () {
    const navItems = document.querySelectorAll(".nav-link");

    navItems.forEach(function (item) {
        item.addEventListener("click", function () {
            // Hapus kelas active dari semua elemen navigasi
            navItems.forEach(function (navItem) {
                navItem.classList.remove("active");
            });

            // Tambahkan kelas active ke elemen yang diklik
            item.classList.add("active");
        });
    });
});