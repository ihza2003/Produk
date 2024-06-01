<?php
session_start();
require('db/db.php');
require('head.php');

// untuk mnegecek apakah sudah login apa belum
if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}

$nama_user = $_SESSION["nama"];

?>

<body class="d-flex flex-column min-vh-100">
    <div class="row g-0 flex-grow-1">
        <div class="col-2">
            <!-- nav vertikal -->
            <ul class="nav flex-column">
                <div class="logo mx-2 my-3 px-2 border-bottom">
                    <img src="img/masjid.png" class="me-2" alt="masjid" width="65" height="70">
                    <a>SB Ibadah</a>
                </div>
                <li class="nav-item mx-3">
                    <a class="nav-link rounded" aria-current="page" href="laporan.php"><i class="me-1 fas fa-fw fa-tachometer-alt"></i>
                        <span>Dashboard</span></a>
                </li>

                <li class="nav-item dropdown  mx-3">
                    <a class="nav-link dropdown-toggle rounded" href="#" id="navbarDropdown" data-bs-toggle="dropdown" aria-expanded="false" role="button"><i class="fa-solid me-1 fa-file-contract"></i><span>Laporan</span></a>

                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="Sholat.php">Sholat Wajib</a></li>
                        <li><a class="dropdown-item" href="Sunnah.php">Sholat Sunnah</a></li>
                        <li><a class="dropdown-item" href="Tadarus.php">Tadarus</a></li>
                        <li><a class="dropdown-item" href="Murojaah.php">Murojaah</a></li>
                    </ul>
                </li>
                <li class="nav-item mx-3">
                    <a class="nav-link rounded active" href="#"><i class=" me-1 bi bi-calendar3"></i><span>Calender</span></a>
                </li>
                <li class="nav-item  mx-3">
                    <a class="nav-link rounded" href="Profil.php"><i class="me-1 bi bi-person-circle"></i><span>Profil</span></a>
                </li>
                <li class="nav-item  mx-3">
                    <a class="nav-link rounded" href="#" data-bs-toggle="modal" data-bs-target="#logoutModal"><i class="me-1 bi bi-box-arrow-left"></i><span>Keluar</span></a>
                </li>
            </ul>
            <!-- end nav vertikal -->
        </div>
        <div class="col-10 d-flex flex-column">
            <!-- Content 1 -->
            <header class="header shadow  px-3 py-4 d-flex justify-content-between align-items-center">
                <h5 class="content m-0 d-flex ">Jadwal Sholat</h5>
                <div class="dropdown">
                    <button class="btn p-0" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                        <div class="akun d-flex align-items-center">
                            <a class="m-0 me-2 user text-decoration-none"><?= $nama_user ?></a>
                            <img src="img/profile.jpg" class="rounded-circle" width="40" height="40" alt="profile">
                        </div>
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        <li><a class="dropdown-item" href="Profil.html">Profil</a></li>
                    </ul>
                </div>
            </header>
            <!-- End Content 1 -->

            <!-- main content -->
            <div class="card mt-5 w-75 mx-auto shadow">
                <div class="card-header ">
                    <h5 class="text-center">Jadwal Sholat</h5>
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Imsak
                            <span id="imsyak-time" class="badge  rounded-pill">Loading...</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Shubuh
                            <span id="shubuh-time" class="badge  rounded-pill">Loading...</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Terbit
                            <span id="terbit-time" class="badge  rounded-pill">Loading...</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Dzuhur
                            <span id="dzuhur-time" class="badge  rounded-pill">Loading...</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Ashar
                            <span id="ashr-time" class="badge rounded-pill">Loading...</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Maghrib
                            <span id="magrib-time" class="badge rounded-pill">Loading...</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Isya
                            <span id="isya-time" class="badge  rounded-pill">Loading...</span>
                        </li>
                    </ul>
                </div>
                <div class="card-footer text-muted text-center" id="footer-tanggal">

                </div>
            </div>

            <footer class="footer mt-auto">
                <div class="text-center p-3">
                    © 2024 Copyright:MentoringIbadah
                </div>
            </footer>

            <!-- Logout Modal -->
            <div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="logoutModalLabel">Konfirmasi Logout</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Apakah Anda yakin ingin logout?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <a href="logout.php" class="btn btn-danger">Logout</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end logout modal -->

            <!-- end main content -->
        </div>

        <!-- Optional JavaScript; choose one of the two! -->
        <script type="text/javascript" src="API/api.js"></script>

        <!-- Option 1: Bootstrap Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

        <!-- Option 2: Separate Popper and Bootstrap JS -->
        <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
</body>

</html>