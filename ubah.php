<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'koneksi.php';

$id = $_GET['id'];
$result = mysqli_query($conn, "SELECT * FROM hp WHERE id_hp = $id");
$row = mysqli_fetch_assoc($result);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_hp = $_POST['nama_hp'];
    $umur = $_POST['umur'];
    $email = $_POST['email'];
    $stok = $_POST['stok'];
    $harga = $_POST['harga'];

    $sql = "UPDATE hp SET nama_hp='$nama_hp', umur='$umur', email='$email', stok='$stok', harga='$harga' WHERE id_hp=$id";

    if (mysqli_query($conn, $sql)) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ubah Data HP</title>
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
            max-width: 800px;
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

        .btn-back {
            background: #666;
        }

        .btn-back:hover {
            background: #555;
        }

        .card {
            background: #1e1e1e;
            padding: 30px;
            border-radius: 10px;
            margin-bottom: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.3);
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #bb86fc;
        }

        input[type="text"],
        input[type="number"] {
            width: 100%;
            padding: 12px;
            border: 1px solid #333;
            border-radius: 5px;
            background-color: #2c2c2c;
            color: #e0e0e0;
            font-size: 16px;
        }

        input[type="text"]:focus,
        input[type="number"]:focus {
            outline: none;
            border-color: #bb86fc;
            box-shadow: 0 0 0 2px rgba(187, 134, 252, 0.3);
        }

        .form-actions {
            display: flex;
            justify-content: space-between;
            margin-top: 30px;
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
            <h1>Ubah Data HP</h1>
            <p class="subtitle">Edit data Handphone yang ada di database</p>
        </header>

        <div class="card">
            <form method="POST" action="">
                <div class="form-group">
                    <label for="nama_hp">Nama HP</label>
                    <input type="text" id="nama_hp" name="nama_hp" value="<?php echo $row['nama_hp']; ?>" required>
                </div>

                <div class="form-group">
                    <label for="umur">Umur</label>
                    <input type="number" id="umur" name="umur" min="0" value="<?php echo $row['umur']; ?>" required>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" value="<?php echo $row['email']; ?>" required>
                </div>

                <div class="form-group">
                    <label for="stok">Stok</label>
                    <input type="number" id="stok" name="stok" min="0" value="<?php echo $row['stok']; ?>" required>
                </div>

                <div class="form-group">
                    <label for="harga">Harga</label>
                    <input type="number" id="harga" name="harga" min="0" step="1000" value="<?php echo $row['harga']; ?>" required>
                </div>

                <div class="form-actions">
                    <a href="index.php" class="btn btn-back">Kembali</a>
                    <button type="submit" class="btn">Update Data</button>
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