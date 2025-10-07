
<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'koneksi.php';

$error = '';
if (isset($_POST['login'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = $_POST['password'];
    if ($username === '' || $password === '') {
        $error = "Username dan password wajib diisi!";
    } else {
        $result = mysqli_query($conn, "SELECT * FROM aman WHERE username='$username'");
        if (mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);
            if (hash('sha256', $password) === $row['password']) {
                $_SESSION['login'] = true;
                $_SESSION['username'] = $row['username'];
                header("Location: index.php");
                exit;
            } else {
                $error = "Password salah!";
            }
        } else {
            $error = "Username tidak ditemukan!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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
        .login-box {
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
        h2 .fa-user-lock {
            margin-right: 10px;
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
            transition: box-shadow 0.2s;
        }
        input[type="text"]:focus, input[type="password"]:focus {
            box-shadow: 0 0 0 2px #00adb5;
        }
        .btn-login {
            background: linear-gradient(90deg, #00adb5 0%, #007b7f 100%);
            color: #fff;
            border: none;
            padding: 14px 36px;
            border-radius: 10px;
            font-size: 1.1rem;
            cursor: pointer;
            font-weight: bold;
            box-shadow: 0 2px 8px rgba(0,0,0,0.12);
            transition: background 0.2s, transform 0.2s;
            margin-top: 10px;
        }
        .btn-login:hover {
            background: linear-gradient(90deg, #007b7f 0%, #00adb5 100%);
            transform: scale(1.04);
        }
        .btn-login .fa-sign-in-alt {
            margin-right: 8px;
        }
        .error {
            background: #ff1744;
            color: #fff;
            padding: 12px;
            border-radius: 10px;
            margin-bottom: 18px;
            font-size: 1rem;
            box-shadow: 0 2px 8px rgba(255,23,68,0.12);
        }
        @media (max-width: 500px) {
            .login-box {
                padding: 24px 8px;
                min-width: 0;
            }
        }
    </style>
</head>
<body>
    <div class="login-box">
        <h2><i class="fa-solid fa-user-lock"></i> Login</h2>
        <?php if ($error) { echo '<div class="error">'.$error.'</div>'; } ?>
        <form method="post" autocomplete="off">
            <input type="text" name="username" placeholder="&#xf007;  Username" style="font-family:inherit,FontAwesome" autofocus required>
            <input type="password" name="password" placeholder="&#xf084;  Password" style="font-family:inherit,FontAwesome" required>
            <button type="submit" name="login" class="btn-login"><i class="fa-solid fa-sign-in-alt"></i> Login</button>
        </form>
    </div>
</body>
</html>
