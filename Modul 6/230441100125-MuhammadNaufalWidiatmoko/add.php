<?php
session_start();
if (!isset($_SESSION['berhasil'])) {
    header("Location: login.php");
    exit();
}

include('db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $nim = $_POST['nim'];
    $umur = $_POST['umur'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $prodi = $_POST['prodi'];
    $jurusan = $_POST['jurusan'];
    $asal_kota = $_POST['asal_kota'];

    $sql = "INSERT INTO mahasiswa (nama, nim, umur, jenis_kelamin, prodi, jurusan, asal_kota) VALUES ('$nama', '$nim', '$umur', '$jenis_kelamin', '$prodi', '$jurusan', '$asal_kota')";

    if ($conn->query($sql) === TRUE) {
        $_SESSION['message'] = "Data berhasil ditambahkan!";
    } else {
        $_SESSION['message'] = "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tambah Data Mahasiswa</title>
    <link rel="stylesheet" href="database.css">
</head>
<body>
    <div class="container">
        <?php if(isset($_SESSION['message'])): ?>
            <div>
                <?php echo $_SESSION['message']; ?>
                <?php unset($_SESSION['message']); ?>
            </div>
        <?php endif; ?>
        <h2>Tambah Data Mahasiswa</h2>
        <form action="add.php" method="POST">
            <label for="nama">Nama:</label>
            <input type="text" name="nama" required>
            <label for="nim">NIM:</label>
            <input type="text" name="nim" required>
            <label for="umur">Umur:</label>
            <input type="number" name="umur" required>
            <label for="jenis_kelamin">Jenis Kelamin:</label>
            <select name="jenis_kelamin" required>
                <option value="Laki-laki">Laki-laki</option>
                <option value="Perempuan">Perempuan</option>
            </select>
            <label for="prodi">Prodi:</label>
            <input type="text" name="prodi" required>
            <label for="jurusan">Jurusan:</label>
            <input type="text" name="jurusan" required>
            <label for="asal_kota">Asal Kota:</label>
            <input type="text" name="asal_kota" required>
            <button type="submit">Tambah</button>
        </form>
        <br>
        <a href="index.php">Kembali ke Daftar Mahasiswa</a>
    </div>
</body>
</html>