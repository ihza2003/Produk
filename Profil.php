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

// Inisialisasi variabel untuk pesan kesalahan dan sukses
$err = "";
$success = "";

// Ambil data pengguna dari database
$query = "SELECT * FROM user_tb WHERE nama = '$nama_user'";
$result = mysqli_query($con, $query);
$user = mysqli_fetch_assoc($result);

// Proses update profil
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST["nama"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];

    // Validasi data
    if (empty($nama) || empty($email)) {
        $err = "Nama dan Email tidak boleh kosong!";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $err = "Email tidak valid!";
    } elseif ($password != $confirm_password) {
        $err = "Password dan Konfirmasi Password tidak sesuai!";
    } else {
        // Hash password baru jika diisi
        if (!empty($password)) {
            $password = password_hash($password, PASSWORD_DEFAULT);
            $query = "UPDATE user_tb SET nama='$nama', email='$email', password='$password' WHERE nama='$nama_user'";
        } else {
            $query = "UPDATE user_tb SET nama='$nama', email='$email' WHERE nama='$nama_user'";
        }

        if (mysqli_query($con, $query)) {
            $_SESSION["nama"] = $nama; // Update sesi dengan nama baru
            $success = "Profil berhasil diupdate!";

            $user['nama'] = $nama;
            $user['email'] = $email;
        } else {
            $err = "Gagal mengupdate profil: " . mysqli_error($con);
        }
    }
}

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
                    <a class="nav-link dropdown-toggle rounded " href="#" id="navbarDropdown" data-bs-toggle="dropdown" aria-expanded="false" role="button"><i class="fa-solid me-1 fa-file-contract"></i><span>Laporan</span></a>

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
                    <a class="nav-link rounded active" href="Profil.php"><i class="me-1 bi bi-person-circle"></i><span>Profil</span></a>
                </li>
                <li class="nav-item  mx-3">
                    <a class="nav-link rounded" href="#" data-bs-toggle="modal" data-bs-target="#logoutModal"><i class="me-1 bi bi-box-arrow-left"></i><span>Keluar</span></a>
                </li>
            </ul>
            <!-- end nav vertikal -->
        </div>
        <div class="col-10 g-0 d-flex flex-column">
            <!-- Content 1 -->
            <header class="header shadow  px-3 py-4 d-flex justify-content-between align-items-center">
                <h5 class="content m-0 d-flex ">Pengaturan Profil</h5>
                <div class="dropdown">
                    <button class="btn p-0" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                        <div class="akun d-flex align-items-center">
                            <a class="m-0 me-2 user text-decoration-none"><?= htmlspecialchars($user['nama']) ?></a>
                            <img src="img/profile.jpg" class="rounded-circle" width="40" height="40" alt="profile">
                        </div>
                    </button>

                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        <li><a class="dropdown-item" href="#">Profil</a></li>
                    </ul>

                </div>
            </header>
            <!-- End Content 1 -->

            <!-- main content -->

            <div class="card mt-3 w-75 mx-auto shadow">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 py-2">
                            <div class="card">
                                <div class="card-body">
                                    <?php if ($err) : ?>
                                        <div class="alert alert-danger d-flex justify-content-between align-items-center" role="alert">
                                            <?= htmlspecialchars($err) ?>
                                            <button type="button" class="btn-close float-end" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>
                                    <?php elseif ($success) : ?>
                                        <div class="alert alert-success d-flex justify-content-between align-items-center" role="alert">
                                            <?php echo htmlspecialchars($success) ?>
                                            <button type="button" class="btn-close float-end" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>
                                    <?php endif; ?>
                                    <h5 class="card-title text-center">Pengaturan Profil</h5>
                                    <div class="d-flex justify-content-center ">
                                        <img src="img/profile.jpg" class="rounded-circle" width="80" height="80" alt="profile">
                                    </div>

                                    <form action="" method="POST">
                                        <div class="mb-3 py-2">
                                            <label for="nama" class="form-label">Nama</label>
                                            <input type="text" class="form-control" id="nama" name="nama" value="<?= htmlspecialchars($user['nama']) ?>">
                                        </div>
                                        <div class="mb-3 py-2">
                                            <label for="email" class="form-label">Email</label>
                                            <input type="email" class="form-control" id="email" name="email" value="<?= htmlspecialchars($user['email']) ?>">
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3 py-2">
                                                    <label for="password" class="form-label">Password</label>
                                                    <input type="password" class="form-control" id="password" name="password" placeholder="********">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3 py-2">
                                                    <label for="confirm_password" class="form-label">Konfirmasi Password</label>
                                                    <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="********">
                                                </div>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary my-1">Ubah Profil</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
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

        <!-- Option 1: Bootstrap Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

        <!-- Option 2: Separate Popper and Bootstrap JS -->
        <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
</body>

</html>