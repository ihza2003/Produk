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

$err = "";
$sukses = "";
if (isset($_SESSION['sukses'])) {
    $sukses = $_SESSION['sukses'];
    unset($_SESSION['sukses']);
}

function query($query)
{
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

if (isset($_POST["tambah"])) {
    global $err;
    global $sukses;
    global $con;

    // ambil data dalam tiap elemen
    $nama = htmlspecialchars($_POST["Nama_Surah"]);
    $ayat = htmlspecialchars($_POST["Ayat"]);
    $Tanggal = htmlspecialchars($_POST["Tanggal_t"]);
    $Keterangan = htmlspecialchars($_POST["Keterangan_t"]);

    // Query inser data
    $query = "INSERT INTO tadarus (Nama_Surah, Ayat, Tanggal_t, Keterangan_t) VALUES ('$nama', '$ayat', '$Tanggal', '$Keterangan')";
    $result = mysqli_query($con, $query);

    // Memeriksa apakah data berhasil disimpan
    if ($result) {
        $_SESSION['sukses'] = "Data Berhasil Ditambahkan";
        header("Location: Tadarus.php");
        exit;
    } else {
        $err = "Data gagal Ditambahkan !!";
    }
}

?>

<body>

    <div class="row g-0">
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
                    <a class="nav-link dropdown-toggle rounded active" href="#" id="navbarDropdown" data-bs-toggle="dropdown" aria-expanded="false" role="button"><i class="fa-solid me-1 fa-file-contract"></i><span>Laporan</span></a>

                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="Sholat.php">Sholat Wajib</a></li>
                        <li><a class="dropdown-item" href="Sunnah.php">Sholat Sunnah</a></li>
                        <li><a class="dropdown-item" href="Tadarus.php">Tadarus</a></li>
                        <li><a class="dropdown-item" href="Murojaah.php">Murojaah</a></li>
                        <li><a class="dropdown-item" href="#">Hafalan Baru</a></li>
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
            <div class="header shadow  px-3 py-4 d-flex justify-content-between align-items-center">
                <h5 class="content m-0 d-flex ">Laporan Tadarus</h5>
                <div class="dropdown">
                    <button class="btn p-0" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                        <div class="akun d-flex align-items-center">
                            <a class="m-0 me-2 user text-decoration-none"><?= $nama_user ?></a>
                            <img src="img/profile.jpg" class="rounded-circle" width="40" height="40" alt="profile">
                        </div>
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        <li><a class="dropdown-item" href="#">Profil</a></li>
                        <li><a class="dropdown-item" href="#">Logout</a></li>
                    </ul>
                </div>
            </div>
            <!-- End Content 1 -->
            <section class="wajib flex-grow-1">

                <!-- modal tambah data -->
                <div class="modal fade" id="tambahLaporanModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title text-center">Tambah Laporan</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="" method="POST">
                                    <div class="mb-3">
                                        <label for="nama" class="form-label">Nama Surah</label>
                                        <input type="text" class="form-control" id="nama" name="Nama_Surah" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="Ayat" class="form-label">Ayat Surah</label>
                                        <input type="text" class="form-control" id="Ayat" name="Ayat" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="tanggal">Masukkan tanggal:</label>
                                        <input type="date" class="form-control" id="tanggal" name="Tanggal_t" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="keterangan">Keterangan</label>
                                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="Keterangan_t" required></textarea>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" name="tambah" class="btn btn-primary">Laporkan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end modal -->

                <div class="card px-3 py-2 m-3 shadow">

                    <div class="card-body">
                        <button type="submit" name="sholat" class="btn btn-primary my-3" data-bs-target="#tambahLaporanModal" data-bs-toggle="modal">Tambah Laporan</button>
                        <?php
                        if ($sukses) { ?>
                            <div class="alert alert-success d-flex justify-content-between align-items-center" role="alert">
                                <?php echo $sukses ?>
                                <button type="button" class="btn-close float-end" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php } ?>
                        <?php
                        if ($err) { ?>
                            <div class="alert alert-danger d-flex justify-content-between align-items-center" role="alert">
                                <?php echo $err ?>
                                <button type="button" class="btn-close float-end" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php } ?>


                        <?php $hasil = mysqli_query($con, 'SELECT * FROM tadarus'); ?>
                        <?php
                        if (mysqli_num_rows($hasil) == 0) : ?>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Tanggal</th>
                                        <th scope="col">Nama Surah</th>
                                        <th scope="col">Ayat</th>
                                        <th scope="col">Keterangan</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td colspan="5">
                                            <p class="text-center fst-italic">Belum ada data Laporan</p>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        <?php else : ?>
                            <?php $i = 1; ?>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Tanggal</th>
                                        <th scope="col">Nama Surah</th>
                                        <th scope="col">Ayat</th>
                                        <th scope="col">Keterangan</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while ($row = mysqli_fetch_assoc($hasil)) :
                                    ?>
                                        <tr>
                                            <td><?= $i; ?></td>
                                            <td><?= $row["Tanggal_t"]; ?></td>
                                            <td><?= $row["Nama_Surah"]; ?></td>
                                            <td><?= $row["Ayat"]; ?></td>
                                            <td><?= $row["Keterangan_t"]; ?></td>
                                            <td>
                                                <!-- <a href="ubah.php?id=<?= $row["id"]; ?>" type="button" class="btn btn-success"><i class="bi bi-pencil"></i></a> -->
                                                <a href="#" data-bs-target="#updateLaporanModal<?= $i ?>" data-bs-toggle="modal" class="btn btn-success"><i class="bi bi-pencil"></i></a>
                                                <a href="#" type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#hapusModal<?= $i ?>"><i class="bi bi-trash3"></i></a>
                                            </td>
                                        </tr>
                                        <!-- Modal Update Data -->
                                        <div class="modal fade" id="updateLaporanModal<?= $i ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title text-center">Update Laporan</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="ubaht.php" method="POST">
                                                            <!-- [id] adalah nama id dapat dari kolom table yang bernama id karena i variabel sendiri -->
                                                            <input type="hidden" name="id" value="<?= $row["id"] ?>">
                                                            <div class="mb-3">
                                                                <label for="nama" class="form-label">Nama Surah</label>
                                                                <input type="text" class="form-control" id="nama" name="Nama_Surah" value="<?= $row['Nama_Surah'] ?>" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="Ayat" class="form-label">Ayat Surah</label>
                                                                <input type="text" class="form-control" id="Ayat" name="Ayat" value="<?= $row['Ayat'] ?>" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="tanggal">Masukkan tanggal:</label>
                                                                <input type="date" class="form-control" id="tanggal" name="Tanggal_t" value="<?= $row['Tanggal_t'] ?>" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="keterangan">Keterangan</label>
                                                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="Keterangan_t" required><?= $row['Keterangan_t'] ?></textarea>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                <button type="submit" name="update" class="btn btn-primary">Update Laporan</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End modal Update data -->
                                        <!-- Konfirmasi hapus Modal -->
                                        <div class="modal fade" id="hapusModal<?= $i ?>" tabindex="-1" aria-labelledby="hapusModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="logoutModalLabel">Konfirmasi Hapus</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Apakah Anda yakin ingin Menghapus?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                        <a href="hapus_t.php?id=<?= $row['id'] ?>" class="btn btn-danger">Hapus</a>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php $i++; ?>
                                    <?php endwhile; ?>
                                </tbody>
                            </table>
                        <?php endif; ?>
                    </div>
                </div>
            </section>
            <footer class="footer mt-auto">
                <div class="text-center p-3">
                    © 2024 Copyright: MentoringIbadah
                </div>
            </footer>
        </div>
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

</body>

</html>