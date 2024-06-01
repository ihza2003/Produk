<?php
session_start();
require 'db/db.php';
$err = "";

// untuk mnegecek apakah sudah login apa belum
if (isset($_SESSION["login"])) {
    header("Location: laporan.php");
    exit;
}

if (isset($_POST["login"])) {
    // Memanggil fungsi register untuk memproses data pendaftaran
    login($_POST);
}

function login($data)
{
    global $err;
    global $con;

    $username = $data["nama"];
    $password = $data["password"];

    $result = mysqli_query($con, "SELECT * FROM user_tb WHERE nama = '$username'");


    // cek username
    if (mysqli_num_rows($result)) {

        // cek Password
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row["password"])) {
            // set session
            $_SESSION["login"] = true;
            $_SESSION["nama"] = $row["nama"]; // Simpan nama pengguna dalam sesi
            header("Location: laporan.php");
            exit;
        } else {
            $err = "Username / Password salah !!";
        }
    }
    $err = "Username / Password salah !!";
}

?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="img/masjid.png">

    <!-- style sendiri -->
    <link rel="stylesheet" href="CSS/form.css">

    <!-- Bootstrap CSS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />

    <title>Mentoring Ibadah</title>
</head>

<body>
    <section class=" gradient-form">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <!-- form Login -->
                <div class="col-xl-10">
                    <div class="card rounded-4 text-black shadow-lg">
                        <div class="row g-0">
                            <div class="col-lg-6">
                                <div class="card-body p-md-5 mx-md-4">
                                    <div class="">
                                        <div class="text-center">
                                            <h1 class=" header mt-3 mb-5 pb-1 fw-bold">Masuk</h1>
                                        </div>

                                        <?php
                                        if ($err) { ?>
                                            <div class="alert alert-danger d-flex justify-content-between align-items-center" role="alert">
                                                <?php echo $err ?>
                                                <button type="button" class="btn-close float-end" data-bs-dismiss="alert" aria-label="Close"></button>
                                            </div>

                                        <?php } ?>

                                        <form action="" method="POST">
                                            <div class="form-outline mb-4">
                                                <input type="text" id="form2Example11" class="form-control" placeholder="Nama" name="nama" />
                                            </div>

                                            <div class="form-outline mb-2">
                                                <input type="password" id="form2Example22" class="form-control" placeholder="Password" name="password" />
                                            </div>

                                            <div class="text-end pt-1 mb-4 pb-1">
                                                <a class="text-muted" href="#!">Forgot password?</a>
                                            </div>

                                            <div class="text-center pt-1 mb-5 pb-2">
                                                <button class="btn btn-lgn text-white fw-bolder mt-4" type="submit" name="login">Login</button>

                                            </div>

                                            <div class="d-flex align-items-center justify-content-center pb-2">
                                                <p class="mb-0 me-2">Belum Memiliki Akun ?
                                                    <a href="register.php" class="mb-0 me-2 fw-bolder">Daftar</a>
                                                </p>

                                            </div>
                                            <a href="index.php" class="d-flex justify-content-center text-decoration-none">Kembali</a>

                                        </form>

                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <img src="img/ibadah.jpg" class="img-fluid h-100 rounded-4" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
    <!-- Script to display success message -->
    <script>
        // Check if there's a success message in the URL
        const urlParams = new URLSearchParams(window.location.search);
        const successMessage = urlParams.get('success');
        // If success message exists, display it
        if (successMessage === 'register') {
            alert('Anda berhasil register');
        }
    </script>
</body>

</html>