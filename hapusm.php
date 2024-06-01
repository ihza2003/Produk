<?php
session_start();
require('db/db.php');

$id = $_GET['id'];

if (hapus($id) > 0) {
    $_SESSION['sukses'] = "Data Berhasil DiHapus";
    header("Location: Murojaah.php");
    exit;
} else {
    echo "<script>
            alert('Data gagal dihapus');
            document.location.href = 'Murojaah.php';
        </script>";
}



function hapus($id)
{
    global $con;
    mysqli_query($con, "DELETE FROM murajaah WHERE id = $id");
    return mysqli_affected_rows($con);
}
