<?php
session_start();
if (isset($_POST['login'])) {
    $user = $_POST['username'];
    $pass = $_POST['password'];
    if ($user == 'Naufal' AND $pass == '2005') {
        $_SESSION['berhasil'] = true;
        $_SESSION['username'] = $user; 
        header("Location: index.php");
        exit();
    } else {
        $salah = "<p style='color: red; text-align: center;'>Masukkan user & pass yang benar!</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="database.css">
    <title>Login</title>
</head>
<body>
    <div class="login-box">
        <div class="login-header">
            <header>Login</header>
        </div>
        <?php echo isset($salah) ? $salah : ''; ?>
        <form method="POST" action=""> 
            <div class="input-box">
                <input type="text" class="input-field" placeholder="Username" autocomplete="off" name="username" required>
            </div>
            <div class="input-box">
                <input type="password" class="input-field" placeholder="Password" autocomplete="off" name="password" required> 
            </div>
            <div class="input-submit">
                <button type="submit" class="submit-btn" name="login" id="submit">Login</button> 
            </div>
        </form>
    </div>
</body>
</html>