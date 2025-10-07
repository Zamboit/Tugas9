<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'koneksi.php';

$error = '';

if (isset($_POST['register'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = $_POST['password'];
    $confirm = $_POST['confirm'];

    if ($username === '' || $password === '' || $confirm === '') {
        $error = "Semua kolom wajib diisi!";
    } elseif ($password !== $confirm) {
        $error = "Password dan konfirmasi tidak cocok!";
    } else {
        // Cek username
        $result = mysqli_query($conn, "SELECT * FROM aman WHERE username='$username'");
        if (mysqli_num_rows($result) > 0) {
            $error = "Username sudah terdaftar!";
        } else {
            // Simpan password aman
            $hashed = password_hash($password, PASSWORD_DEFAULT);
            mysqli_query($conn, "INSERT INTO aman (username, password) VALUES ('$username', '$hashed')");
            $_SESSION['login'] = true;
            $_SESSION['username'] = $username;
            header("Location: index.php");
            exit;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
    <style>
        body {
            background: linear-gradient(120deg, #232526 0%, #414345 100%);
            color: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .register-box {
            background: rgba(40, 40, 60, 0.97);
            padding: 48px 36px;
            border-radius: 20px;
            box-shadow: 0 12px 32px rgba(0,0,0,0.35);
            text-align: center;
            min-width: 320px;
            animation: fadeIn 0.7s;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(40px); }
            to { opacity: 1; transform: translateY(0); }
        }
        h2 {
            margin-bottom: 24px;
            font-size: 2rem;
            color: #00adb5;
            letter-spacing: 1px;
        }
        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 14px;
            margin: 10px 0 20px 0;
            border: none;
            border-radius: 10px;
            background: #23243a;
            color: #fff;
            font-size: 1.1rem;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        }
        input:focus {
            box-shadow: 0 0 0 2px #00adb5;
            outline: none;
        }
        .btn-register {
            background: linear-gradient(90deg, #00adb5 0%, #007b7f 100%);
            color: #fff;
            border: none;
            padding: 14px 36px;
            border-radius: 10px;
            font-size: 1.1rem;
            cursor: pointer;
            font-weight: bold;
            transition: 0.2s;
        }
        .btn-register:hover {
            background: linear-gradient(90deg, #007b7f 0%, #00adb5 100%);
            transform: scale(1.04);
        }
        .error {
            background: #ff1744;
            color: #fff;
            padding: 12px;
            border-radius: 10px;
            margin-bottom: 18px;
            font-size: 1rem;
        }
        a {
            color: #00adb5;
            text-decoration: none;
        }
        a:hover { text-decoration: underline; }
    </style>
</head>
<body>
    <div class="register-box">
        <h2><i class="fa-solid fa-user-plus"></i> Daftar Akun</h2>
        <?php if ($error) echo '<div class="error">'.$error.'</div>'; ?>
        <form method="post" autocomplete="off">
            <input type="text" name="username" placeholder="&#xf007;  Username" style="font-family:inherit,FontAwesome" required>
            <input type="password" name="password" placeholder="&#xf084;  Password" style="font-family:inherit,FontAwesome" required>
            <input type="password" name="confirm" placeholder="&#xf00c;  Konfirmasi Password" style="font-family:inherit,FontAwesome" required>
            <button type="submit" name="register" class="btn-register"><i class="fa-solid fa-user-plus"></i> Daftar</button>
        </form>
        <p style="margin-top:18px;">Sudah punya akun? <a href="login.php">Login di sini</a></p>
    </div>
</body>
</html>
