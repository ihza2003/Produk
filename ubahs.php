<?php
session_start();
require('db/db.php');

if (isset($_POST["update"])) {
    global $err;
    global $sukses;
    global $con;
    $id = $_POST["id"];
    $nama = htmlspecialchars($_POST["Nama_Sunnah"]);
    $Tanggal = htmlspecialchars($_POST["Tanggal_Sunnah"]);
    $Keterangan = htmlspecialchars($_POST["Keterangan_s"]);

    $query = "UPDATE sunnah SET Nama_Sunnah = '$nama', Tanggal_Sunnah = '$Tanggal', Keterangan_s = '$Keterangan' WHERE id = $id";
    $result = mysqli_query($con, $query);

    if ($result) {
        $_SESSION['sukses'] = "Data Berhasil DiUpdate";
        header("Location: Sunnah.php");
        exit;
    } else {
        $err = "Data gagal Diupdate !!";
    }
}
