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
    <title>Daftar Mahasiswa</title>
    <link rel="stylesheet" href="database.css">
</head>
<body>
    <div class="container">
        <h2>Daftar Mahasiswa</h2>
        <a href="logout.php">Logout</a>
        <?php
        if (isset($_SESSION['message'])) {
            echo "<p style='color: green; text-align: center;'>" . $_SESSION['message'] . "</p>";
            unset($_SESSION['message']);
        }
        ?>
        <div class="table-container">
            <table>
                <tr>
                    <th>Nama</th>
                    <th>NIM</th>
                    <th>Umur</th>
                    <th>Jenis Kelamin</th>
                    <th>Prodi</th>
                    <th>Jurusan</th>
                    <th>Asal Kota</th>
                    <th>Aksi</th>
                </tr>
                <?php
                $sql = "SELECT * FROM mahasiswa";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>" . $row['nama'] . "</td>
                                <td>" . $row['nim'] . "</td>
                                <td>" . $row['umur'] . "</td>
                                <td>" . $row['jenis_kelamin'] . "</td>
                                <td>" . $row['prodi'] . "</td>
                                <td>" . $row['jurusan'] . "</td>
                                <td>" . $row['asal_kota'] . "</td>
                                <td>
                                    <a href='edit.php?id=" . $row['id'] . "'>Edit</a>
                                    <a href='delete.php?id=" . $row['id'] . "' onclick='return confirm(\"Apakah Anda yakin?\")'>Hapus</a>
                                </td>
                            </tr>";
                    }
                } else {
                    echo "<tr><td colspan='8'>Tidak ada data</td></tr>";
                }

                $conn->close();
                ?>
            </table>
        </div>
        <br>
        <a href="add.php">Tambah Mahasiswa</a>
    </div>
</body>
</html>