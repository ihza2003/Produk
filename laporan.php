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

// Query untuk mengambil data jumlah laporan
$sholatWajibQuery = "SELECT COUNT(id) as count FROM sholat_wajib";
$sunnahQuery = "SELECT COUNT(id) as count FROM sunnah";
$tadarusQuery = "SELECT COUNT(id) as count FROM tadarus";
$murojaahQuery = "SELECT COUNT(id) as count FROM murajaah";

$sholatWajibCount = mysqli_fetch_assoc(mysqli_query($con, $sholatWajibQuery))['count'];
$sunnahCount = mysqli_fetch_assoc(mysqli_query($con, $sunnahQuery))['count'];
$tadarusCount = mysqli_fetch_assoc(mysqli_query($con, $tadarusQuery))['count'];
$murojaahCount = mysqli_fetch_assoc(mysqli_query($con, $murojaahQuery))['count'];
?>

<body>
    <div class="row g-0 flex-grow-1">
        <div class="col-2">
            <!-- nav vertikal -->
            <ul class="nav flex-column">
                <div class="logo mx-2 my-3 px-2 border-bottom">
                    <img src="img/masjid.png" class="me-2" alt="masjid" width="65" height="70">
                    <a>SB Ibadah</a>
                </div>
                <li class="nav-item mx-3">
                    <a class="nav-link active rounded" aria-current="page" href="laporan.php"><i class="me-1 fas fa-fw fa-tachometer-alt"></i>
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
                    <a class="nav-link rounded" href="calender.php"><i class=" me-1 bi bi-calendar3"></i><span>Calender</span></a>
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
        <div class="col-10 d-flex flex-column min-vh-100">
            <!-- Content 1 -->
            <header class="header shadow  px-3 py-4 d-flex justify-content-between align-items-center">
                <h5 class="content m-0 d-flex">Selamat Datang <span class="ms-1"><?= $nama_user ?></span></h5>
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
            <!-- dikarenakan menggunakan flex colom jadinya align item fungsinya terbalik jadi menagtur horizontal bkn vertikal -->
            <!-- <div class="main d-flex flex-column align-items-center mt-5">
                <h3 class="selamat">Selamat Datang <span><?= $nama_user ?></span></h3>
                <p class="">Jangan Lupa Ibadah Hari ini Laporkan Ibadah mu 😊</p>
            </div> -->
            <!-- <div class="main d-flex flex-column justify-content-center align-items-center h-100">
                <h3 class="selamat">Selamat Datang <span><?= $nama_user ?></span></h3>
                <p class="">Jangan Lupa Ibadah Hari ini Laporkan Ibadah mu 😊</p>
            </div> -->

            <div class="container">
                <div class="row text-white justify-content-between g-1 w-100 my-3">
                    <div class="card col-3" style="width: 18rem; background-color: #a196bf;">
                        <div class="card-body">
                            <div class="card-body-icon">
                                <i class="fa-solid fa-place-of-worship"></i>
                            </div>
                            <h5 class="card-title">Laporan Sholat Wajib</h5>
                            <div class="display-5 fw-bold">
                                <?= $sholatWajibCount ?>
                            </div>
                            <a href="Sholat.php">
                                <p class="card-text text-decoration-none text-white">Lihat detail <i class="fas fa-angle-double-right"></i></p>
                            </a>
                        </div>
                    </div>
                    <div class="card col-3" style="width: 18rem; background-color: #a196bf;">
                        <div class="card-body">
                            <div class="card-body-icon" style="">
                                <i class="fa-solid fa-person-praying"></i>
                            </div>
                            <h5 class="card-title">Laporan Sholat Sunah</h5>
                            <div class="display-5 fw-bold">
                                <?= $sunnahCount ?>
                            </div>
                            <a href="Sunnah.php">
                                <p class="card-text text-white">Lihat detail <i class="fas fa-angle-double-right"></i></p>
                            </a>
                        </div>
                    </div>
                    <div class="card col-3" style="width: 18rem; background-color: #a196bf;">
                        <div class="card-body">
                            <div class="card-body-icon" style="">
                                <i class="bi bi-book"></i>
                            </div>
                            <h5 class="card-title">Laporan Tadarus</h5>
                            <div class="display-5 fw-bold">
                                <?= $tadarusCount ?>
                            </div>
                            <a href="Tadarus.php">
                                <p class="card-text text-white">Lihat detail <i class="fas fa-angle-double-right"></i></p>
                            </a>
                        </div>
                    </div>
                    <div class="card col-3" style="width: 18rem; background-color: #a196bf;">
                        <div class="card-body">
                            <div class="card-body-icon" style="">
                                <i class="fa-solid fa-book-quran"></i>
                            </div>
                            <h5 class="card-title">Laporan Murojaah</h5>
                            <div class="display-5 fw-bold">
                                <?= $murojaahCount ?>
                            </div>
                            <a href="Murojaah.php">
                                <p class="card-text text-white">Lihat detail <i class="fas fa-angle-double-right"></i></p>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Chart Section -->
            <div class="container">
                <div class="card shadow w-100 my-3">
                    <div class="card-body">
                        <div class="d-flex flex-column align-items-center" style="width: 100%; margin: 30px auto; height:400px; background-color: white;">
                            <center>Grafik Laporan Ibadah</center>
                            <canvas id="myChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <footer class="footer mt-auto">
                <div class="text-center p-3">
                    © 2024 Copyright: MentoringIbadah
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

        </div>

        <!-- Optional JavaScript; choose one of the two! -->
        <!-- Option 1: Bootstrap Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

        <!-- Option 2: Separate Popper and Bootstrap JS -->
        <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
        <!-- Chart.js -->
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

        <!-- Chart Data Script -->
        <script>
            var ctx = document.getElementById('myChart').getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Sholat Wajib', 'Sholat Sunnah', 'Tadarus', 'Murojaah'],
                    datasets: [{
                        label: 'Jumlah Laporan',
                        data: [<?= $sholatWajibCount ?>, <?= $sunnahCount ?>, <?= $tadarusCount ?>, <?= $murojaahCount ?>],
                        backgroundColor: [
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)',
                            'rgba(255, 99, 132, 0.2)'
                        ],
                        borderColor: [
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)',
                            'rgba(255, 99, 132, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    },
                    responsive: true // Tambahkan ini untuk membuat grafik responsif
                }
            });
        </script>

</body>

</html>