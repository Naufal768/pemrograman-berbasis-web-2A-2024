<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>selamat</title>
    <link rel="stylesheet" href="selamatdatang.css">
</head>
<body>
<div class="container">
        <?php
        session_start();
        if(isset($_SESSION['berhasil']) && $_SESSION['berhasil'] == true) {
            if(isset($_SESSION['username'])) {
                $user = $_SESSION['username'];
                echo "<h1>Selamat Datang, $user!</h1>";
            } else {
                echo "<h1>Selamat Datang, Pengguna!</h1>";
        }
        } else {
            header("Location: index.php");
            exit();
        }
        ?> 
        <center>
            <a href="tabel.php" class="btn">Lanjut!</a>
        </center>
    </div>
</body>
</html>