<?php
session_start();

if (!isset($_SESSION["berhasil"]) || $_SESSION["berhasil"] !== true) {
    header("location: index.php");
    exit;
}

if (!isset($_SESSION['students'])) {
    $_SESSION['students'] = [];
}

function addStudent($nim, $nama, $alamat, $angkatan) {
    $_SESSION['students'][$nim] = [
        'nama' => $nama,
        'alamat' => $alamat,
        'angkatan' => $angkatan
    ];
}

function deleteStudent($nim) {
    unset($_SESSION['students'][$nim]);
}

function editStudent($nim, $nama, $alamat, $angkatan) {
    $_SESSION['students'][$nim] = [
        'nama' => $nama,
        'alamat' => $alamat,
        'angkatan' => $angkatan
    ];
}

if (isset($_POST['action'])) {
    if ($_POST['action'] == 'Tambah') {
        addStudent($_POST['nim'], $_POST['nama'], $_POST['alamat'], $_POST['angkatan']);

    } elseif ($_POST['action'] == 'Edit') {
        $_SESSION['edit_nim'] = $_POST['nim'];

    } elseif ($_POST['action'] == 'Simpan') {
        editStudent($_SESSION['edit_nim'], $_POST['nama'], $_POST['alamat'], $_POST['angkatan']);
        unset($_SESSION['edit_nim']);

    } elseif ($_POST['action'] == 'Hapus') {
        deleteStudent($_POST['nim']);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Mahasiswa</title>
    <link rel="stylesheet" href="tabel.css">
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet" />
</head>
<body>
    <section class="navbar">
        <ul>
            <li><a href="selamatdatang.php">rumah</a></li>
            <li><a href="index.php">Logout</a></li>
        </ul>
    </section>
    <form method="post">
        
        <input type="hidden" name="edit_nim" value="<?= isset($_SESSION['edit_nim']) ? $_SESSION['edit_nim'] : '' ?>">
        NIM: <input type="text" name="nim" value="<?= isset($_SESSION['edit_nim']) ? $_SESSION['edit_nim'] : '' ?>" required><br>
        Nama: <input type="text" name="nama" value="<?= isset($_SESSION['edit_nim']) ? $_SESSION['students'][$_SESSION['edit_nim']]['nama'] : '' ?>" required><br>
        Alamat: <input type="text" name="alamat" value="<?= isset($_SESSION['edit_nim']) ? $_SESSION['students'][$_SESSION['edit_nim']]['alamat'] : '' ?>" required><br>
        Angkatan: <input type="text" name="angkatan" value="<?= isset($_SESSION['edit_nim']) ? $_SESSION['students'][$_SESSION['edit_nim']]['angkatan'] : '' ?>" required><br>
        
        <?php if(isset($_SESSION['edit_nim'])): ?>
        <input type="submit" name="action" value="Simpan">
        <input type="submit" name="action" value="Reset">
        <?php else: ?>
        <input type="submit" name="action" value="Tambah">
        <?php endif; ?>
    </form>

    <table>
        <tr>
            <th>NIM</th>
            <th>Nama</th>
            <th>Alamat</th>
            <th>Angkatan</th>
            <th>Aksi</th> 
        </tr>
        <?php foreach ($_SESSION['students'] as $nim => $student): ?>
        <tr>
            <td><?= $nim ?></td>
            <td><?= $student['nama'] ?></td>
            <td><?= $student['alamat'] ?></td>
            <td><?= $student['angkatan'] ?></td>
            <td>
                <form method="post">
                    <input type="hidden" name="nim" value="<?= $nim ?>">
                    <input type="submit" name="action" value="Edit">
                    <input type="submit" name="action" value="Hapus">
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>