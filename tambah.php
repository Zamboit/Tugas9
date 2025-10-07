<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

include "koneksi.php";

session_start();
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}


$error = '';

$error = '';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tanggal_input = trim($_POST['tanggal_input']);
    $merk_hp = trim($_POST['merk_hp']);
    $nama_hp = trim($_POST['nama_hp']);
    $deskripsi = trim($_POST['deskripsi']);
    $stok = intval($_POST['stok']);
    $harga = intval($_POST['harga']);

    if ($tanggal_input === '' || $merk_hp === '' || $nama_hp === '' || $deskripsi === '' || $stok < 0 || $harga < 0) {
        $error = "Semua field wajib diisi dengan benar!";
    } else {
        $stmt = mysqli_prepare($conn, "INSERT INTO hp (tanggal_input, merk_hp, nama_hp, deskripsi, stok, harga) VALUES (?, ?, ?, ?, ?, ?)");
        mysqli_stmt_bind_param($stmt, "ssssii", $tanggal_input, $merk_hp, $nama_hp, $deskripsi, $stok, $harga);
        if (mysqli_stmt_execute($stmt)) {
            header("Location: index.php");
            exit();
        } else {
            $error = "Gagal menyimpan data!";
        }
        mysqli_stmt_close($stmt);
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data HP</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        body {
            background: linear-gradient(120deg, #232526 0%, #414345 100%);
            color: #e0e0e0;
            line-height: 1.6;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }
        header {
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 100%);
            padding: 32px 20px 24px 20px;
            border-radius: 18px;
            margin-bottom: 30px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.25);
            text-align: center;
            animation: fadeIn 0.7s;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(40px); }
            to { opacity: 1; transform: translateY(0); }
        }
        h1 {
            font-size: 2.3rem;
            margin-bottom: 10px;
            color: #00adb5;
            letter-spacing: 1px;
        }
        h1 .fa-plus-circle {
            margin-right: 12px;
        }
        .subtitle {
            color: #bb86fc;
            margin-bottom: 20px;
            font-size: 1.1rem;
        }
        .btn {
            display: inline-block;
            background: linear-gradient(90deg, #00adb5 0%, #007b7f 100%);
            color: #fff;
            padding: 12px 28px;
            text-decoration: none;
            border-radius: 10px;
            font-weight: bold;
            font-size: 1.1rem;
            border: none;
            cursor: pointer;
            box-shadow: 0 2px 8px rgba(0,0,0,0.12);
            transition: background 0.2s, transform 0.2s;
            margin-right: 10px;
        }
        .btn i {
            margin-right: 8px;
        }
        .btn:hover {
            background: linear-gradient(90deg, #007b7f 0%, #00adb5 100%);
            transform: scale(1.04);
        }
        .btn-back {
            background: linear-gradient(90deg, #666 0%, #555 100%);
            color: #fff;
        }
        .btn-back:hover {
            background: linear-gradient(90deg, #555 0%, #666 100%);
        }
        .card {
            background: rgba(40, 40, 60, 0.97);
            padding: 32px 20px;
            border-radius: 18px;
            margin-bottom: 20px;
            box-shadow: 0 8px 24px rgba(0,0,0,0.25);
            animation: fadeIn 0.7s;
        }
        .form-group {
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #00adb5;
        }
        input[type="text"], input[type="number"], input[type="date"], textarea {
            width: 100%;
            padding: 14px;
            border: none;
            border-radius: 10px;
            background: #23243a;
            color: #fff;
            font-size: 1.1rem;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            transition: box-shadow 0.2s;
        }
        input[type="text"]:focus, input[type="number"]:focus, input[type="date"]:focus, textarea:focus {
            box-shadow: 0 0 0 2px #00adb5;
        }
        .form-actions {
            display: flex;
            justify-content: space-between;
            margin-top: 30px;
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
        footer {
            text-align: center;
            margin-top: 40px;
            padding: 20px;
            color: #bb86fc;
            font-size: 1rem;
            background: linear-gradient(90deg, #232526 0%, #414345 100%);
            border-radius: 10px;
        }
        @media (max-width: 700px) {
            .container { padding: 4px; }
            .card, header, footer { padding: 10px; }
        }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <h1><i class="fa-solid fa-plus-circle"></i> Tambah Data HP</h1>
            <p class="subtitle">Tambahkan data Handphone baru ke database</p>
        </header>

        <div class="card">
            <?php if ($error) { echo '<div class="error">'.$error.'</div>'; } ?>
            <form method="POST" action="" autocomplete="off">
                <div class="form-group">
                    <label for="tanggal_input">Tanggal Input</label>
                    <input type="date" id="tanggal_input" name="tanggal_input" required>
                </div>
                <div class="form-group">
                    <label for="merk_hp">Merk HP</label>
                    <input type="text" id="merk_hp" name="merk_hp" maxlength="250" required>
                </div>
                <div class="form-group">
                    <label for="nama_hp">Nama HP</label>
                    <input type="text" id="nama_hp" name="nama_hp" required>
                </div>
                <div class="form-group">
                    <label for="deskripsi">Deskripsi</label>
                    <textarea id="deskripsi" name="deskripsi" rows="4" required></textarea>
                </div>
                <div class="form-group">
                    <label for="stok">Stok</label>
                    <input type="number" id="stok" name="stok" min="0" required>
                </div>
                <div class="form-group">
                    <label for="harga">Harga</label>
                    <input type="number" id="harga" name="harga" min="0" step="1000" required>
                </div>
                <div class="form-actions">
                    <a href="index.php" class="btn btn-back"><i class="fa-solid fa-arrow-left"></i> Kembali</a>
                    <button type="submit" class="btn"><i class="fa-solid fa-save"></i> Simpan Data</button>
                </div>
            </form>
        </div>

        <footer>
            <p>&copy; 2023 - CRUD Application for Database db_xirpl1-15_1</p>
        </footer>
    </div>
</body>
</html>
<?php
mysqli_close($conn);
?>