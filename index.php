<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'koneksi.php';

// Mengambil data dari database
$result = mysqli_query($conn, "SELECT * FROM hp ORDER BY id_hp DESC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data HP - CRUD Application</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: #121212;
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
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 30px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.3);
        }

        h1 {
            text-align: center;
            font-size: 2.5rem;
            margin-bottom: 10px;
            color: #bb86fc;
        }

        .subtitle {
            text-align: center;
            color: #03dac6;
            margin-bottom: 20px;
        }

        .btn {
            display: inline-block;
            background: #bb86fc;
            color: #121212;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
        }

        .btn:hover {
            background: #985eff;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .btn-danger {
            background: #cf6679;
        }

        .btn-danger:hover {
            background: #b00020;
        }

        .btn-edit {
            background: #03dac6;
            color: #121212;
        }

        .btn-edit:hover {
            background: #018786;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 25px 0;
            background-color: #1e1e1e;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.3);
        }

        th, td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #333;
        }

        th {
            background-color: #332940;
            color: #bb86fc;
            font-weight: bold;
            text-transform: uppercase;
        }

        tr:hover {
            background-color: #2c2c2c;
        }

        .action-buttons {
            display: flex;
            gap: 10px;
        }

        .no-data {
            text-align: center;
            padding: 20px;
            color: #cf6679;
        }

        .card {
            background: #1e1e1e;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.3);
        }

        footer {
            text-align: center;
            margin-top: 40px;
            padding: 20px;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <h1>Manajemen Data HP</h1>
            <p class="subtitle">Sistem CRUD untuk mengelola data Handphone</p>
        </header>

        <div class="card">
            <a href="tambah.php" class="btn">Tambah Data HP</a>
            
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama HP</th>
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
                            echo "<td>" . $row['nama_hp'] . "</td>";
                            echo "<td>" . $row['stok'] . "</td>";
                            echo "<td>Rp " . number_format($row['harga'], 0, ',', '.') . "</td>";
                            echo "<td class='action-buttons'>";
                            echo "<a href='ubah.php?id=" . $row['id_hp'] . "' class='btn btn-edit'>Edit</a>";
                            echo "<a href='hapus.php?id=" . $row['id_hp'] . "' class='btn btn-danger' onclick='return confirm(\"Apakah Anda yakin ingin menghapus data ini?\")'>Hapus</a>";
                            echo "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5' class='no-data'>Tidak ada data HP</td></tr>";
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