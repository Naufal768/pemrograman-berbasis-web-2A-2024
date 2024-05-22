<?php
session_start();
if (!isset($_SESSION['berhasil'])) {
    header("Location: login.php");
    exit();
}

include('db.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Mahasiswa</title>
    <link rel="stylesheet" href="database.css">
</head>
<body>
    <div class="container">
        <h2>Edit Data Mahasiswa</h2>

        <?php
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $sql = "SELECT * FROM mahasiswa WHERE id=$id";
            $result = $conn->query($sql);

            if ($result && $result->num_rows > 0) {
                $row = $result->fetch_assoc();
        ?>

        <form action="edit.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
            <label>Nama:</label>
            <input type="text" name="nama" value="<?php echo $row['nama']; ?>" required><br>
            <label>NIM:</label>
            <input type="text" name="nim" value="<?php echo $row['nim']; ?>" required><br>
            <label>Umur:</label>
            <input type="number" name="umur" value="<?php echo $row['umur']; ?>" required><br>
            <label>Jenis Kelamin:</label>
            <select name="jenis_kelamin" required>
                <option value="Laki-laki" <?php if($row['jenis_kelamin'] == 'Laki-laki') echo 'selected'; ?>>Laki-laki</option>
                <option value="Perempuan" <?php if($row['jenis_kelamin'] == 'Perempuan') echo 'selected'; ?>>Perempuan</option>
            </select><br>
            <label>Prodi:</label>
            <input type="text" name="prodi" value="<?php echo $row['prodi']; ?>" required><br>
            <label>Jurusan:</label>
            <input type="text" name="jurusan" value="<?php echo $row['jurusan']; ?>" required><br>
            <label>Asal Kota:</label>
            <input type="text" name="asal_kota" value="<?php echo $row['asal_kota']; ?>" required><br>
            <button type="submit" name="update">Update</button>
        </form>

        <?php
            } else {
                echo "Data mahasiswa tidak ditemukan.";
            }
        }

        if (isset($_POST['update'])) {
            $id = $_POST['id'];
            $nama = $_POST['nama'];
            $nim = $_POST['nim'];
            $umur = $_POST['umur'];
            $jenis_kelamin = $_POST['jenis_kelamin'];
            $prodi = $_POST['prodi'];
            $jurusan = $_POST['jurusan'];
            $asal_kota = $_POST['asal_kota'];

            $sql = "UPDATE mahasiswa SET nama='$nama', nim='$nim', umur='$umur', jenis_kelamin='$jenis_kelamin', prodi='$prodi', jurusan='$jurusan', asal_kota='$asal_kota' WHERE id=$id";

            if ($conn->query($sql) === TRUE) {
                echo "Data berhasil diupdate!";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }

        $conn->close();
        ?>
        <br>
        <a href="index.php">Kembali ke Daftar Mahasiswa</a>
    </div>
</body>
</html>