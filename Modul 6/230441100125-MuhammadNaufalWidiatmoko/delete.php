<?php
session_start();
if (!isset($_SESSION['berhasil'])) {
    header("Location: login.php");
    exit();
}

include('db.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "DELETE FROM mahasiswa WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        $_SESSION['message'] = "Data berhasil dihapus!";
    } else {
        $_SESSION['message'] = "Error: " . $sql . "<br>" . $conn->error;
    }

    header("Location: index.php");
    exit();
} else {
    echo "Parameter ID tidak diterima.";
}
?>