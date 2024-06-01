<?php
session_start();
require('db/db.php');

if (isset($_POST["update"])) {
    global $err;
    global $sukses;
    global $con;
    $id = $_POST["id"];
    $nama = htmlspecialchars($_POST["Nama_Wajib"]);
    $Tanggal = htmlspecialchars($_POST["Tanggal"]);
    $Keterangan = htmlspecialchars($_POST["Keterangan"]);

    $query = "UPDATE sholat_wajib SET Nama_Wajib = '$nama', Tanggal = '$Tanggal', Keterangan = '$Keterangan' WHERE id = $id";
    $result = mysqli_query($con, $query);

    if ($result) {
        $_SESSION['sukses'] = "Data Berhasil DiUpdate";
        header("Location: Sholat.php");
        exit;
    } else {
        $err = "Data gagal Diupdate !!";
    }
}
