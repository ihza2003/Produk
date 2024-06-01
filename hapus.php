<?php
session_start();
require('db/db.php');

$id = $_GET['id'];

if (hapus($id) > 0) {
    $_SESSION['sukses'] = "Data Berhasil DiHapus";
    header("Location: Sholat.php");
    exit;
} else {
    echo "<script>
            alert('Data gagal dihapus');
            document.location.href = 'Sholat.php';
        </script>";
}



function hapus($id)
{
    global $con;
    mysqli_query($con, "DELETE FROM sholat_wajib WHERE id = $id");
    return mysqli_affected_rows($con);
}
