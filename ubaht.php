<?php
session_start();
require('db/db.php');

if (isset($_POST["update"])) {
    global $err;
    global $sukses;
    global $con;
    $id = $_POST["id"];
    $nama = htmlspecialchars($_POST["Nama_Surah"]);
    $ayat = htmlspecialchars($_POST["Ayat"]);
    $Tanggal = htmlspecialchars($_POST["Tanggal_t"]);
    $Keterangan = htmlspecialchars($_POST["Keterangan_t"]);

    $query = "UPDATE tadarus SET Nama_Surah = '$nama', Ayat = '$ayat', Tanggal_t = '$Tanggal', Keterangan_t = '$Keterangan' WHERE id = $id";
    $result = mysqli_query($con, $query);

    if ($result) {
        $_SESSION['sukses'] = "Data Berhasil DiUpdate";
        header("Location: Tadarus.php");
        exit;
    } else {
        $err = "Data gagal Diupdate !!";
    }
}
