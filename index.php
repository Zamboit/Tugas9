<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'koneksi.php';

session_start();
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

// Mengambil data dari database
$result = mysqli_query($conn, "SELECT * FROM hp ORDER BY id_hp DESC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data HP - CRUD Application</title>
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
            max-width: 1200px;
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
            font-size: 2.7rem;
            margin-bottom: 10px;
            color: #00adb5;
            letter-spacing: 1px;
        }
        h1 .fa-mobile-alt {
            margin-right: 12px;
        }
        .subtitle {
            color: #bb86fc;
            margin-bottom: 20px;
            font-size: 1.2rem;
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
        .btn-danger {
            background: linear-gradient(90deg, #cf6679 0%, #b00020 100%);
            color: #fff;
        }
        .btn-danger:hover {
            background: linear-gradient(90deg, #b00020 0%, #cf6679 100%);
        }
        .btn-edit {
            background: linear-gradient(90deg, #03dac6 0%, #018786 100%);
            color: #121212;
        }
        .btn-edit:hover {
            background: linear-gradient(90deg, #018786 0%, #03dac6 100%);
        }
        .card {
            background: rgba(40, 40, 60, 0.97);
            padding: 32px 20px;
            border-radius: 18px;
            margin-bottom: 20px;
            box-shadow: 0 8px 24px rgba(0,0,0,0.25);
            animation: fadeIn 0.7s;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 25px 0;
            background-color: #23243a;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.18);
        }
        th, td {
            padding: 14px 16px;
            text-align: left;
            border-bottom: 1px solid #333;
        }
        th {
            background-color: #332940;
            color: #00adb5;
            font-weight: bold;
            text-transform: uppercase;
            font-size: 1rem;
        }
        tr:hover {
            background-color: #2c2c2c;
            transition: background 0.2s;
        }
        .action-buttons {
            display: flex;
            gap: 10px;
        }
        .no-data {
            text-align: center;
            padding: 20px;
            color: #cf6679;
            font-size: 1.1rem;
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
            table th, table td { font-size: 0.95rem; padding: 8px; }
            .card, header, footer { padding: 10px; }
        }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <h1><i class="fa-solid fa-mobile-alt"></i> Manajemen Data HP</h1>
            <p class="subtitle">Sistem CRUD untuk mengelola data Handphone</p>
        </header>

        <div class="card">
            <a href="tambah.php" class="btn"><i class="fa-solid fa-plus"></i> Tambah Data HP</a>
            <a href="logout.php" class="btn"><i class="fa-solid fa-sign-out-alt"></i> Logout</a>
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal Input</th>
                        <th>Merk HP</th>
                        <th>Nama HP</th>
                        <th>Deskripsi</th>
                        <th>Stok</th>
                        <th>Harga</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (mysqli_num_rows($result) > 0) {
                        $no = 1;
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td>" . $no++ . "</td>";
                            echo "<td>" . htmlspecialchars($row['tanggal_input']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['merk_hp']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['nama_hp']) . "</td>";
                            echo "<td>" . nl2br(htmlspecialchars($row['deskripsi'])) . "</td>";
                            echo "<td>" . $row['stok'] . "</td>";
                            echo "<td>Rp " . number_format($row['harga'], 0, ',', '.') . "</td>";
                            echo "<td class='action-buttons'>";
                            echo "<a href='ubah.php?id=" . $row['id_hp'] . "' class='btn btn-edit'><i class='fa-solid fa-pen-to-square'></i> Edit</a>";
                            echo "<a href='hapus.php?id=" . $row['id_hp'] . "' class='btn btn-danger' onclick='return confirm(\"Apakah Anda yakin ingin menghapus data ini?\")'><i class='fa-solid fa-trash'></i> Hapus</a>";
                            echo "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='8' class='no-data'>Tidak ada data HP</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
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