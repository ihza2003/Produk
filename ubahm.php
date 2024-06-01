<?php
session_start();
require('db/db.php');

if (isset($_POST["update"])) {
    global $err;
    global $sukses;
    global $con;
    $id = $_POST["id"];
    $nama = htmlspecialchars($_POST["Nama_M"]);
    $ayat = htmlspecialchars($_POST["Ayat_m"]);
    $Tanggal = htmlspecialchars($_POST["Tanggal_m"]);
    $Keterangan = htmlspecialchars($_POST["Keterangan_m"]);

    $query = "UPDATE murajaah SET Nama_M = '$nama', Ayat_m = '$ayat', Tanggal_m = '$Tanggal', Keterangan_m = '$Keterangan' WHERE id = $id";
    $result = mysqli_query($con, $query);

    if ($result) {
        $_SESSION['sukses'] = "Data Berhasil DiUpdate";
        header("Location: Murojaah.php");
        exit;
    } else {
        $err = "Data gagal Diupdate !!";
    }
}
