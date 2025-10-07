<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'koneksi.php';

session_start();
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}


if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $stmt = mysqli_prepare($conn, "DELETE FROM hp WHERE id_hp = ?");
    mysqli_stmt_bind_param($stmt, "i", $id);
    if (mysqli_stmt_execute($stmt)) {
        header("Location: index.php");
        exit();
    } else {
        ?>
        <!DOCTYPE html>
        <html lang="id">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Error Hapus Data</title>
            <!-- Bootstrap CSS -->
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
            <!-- FontAwesome -->
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
            <style>
                body { background: linear-gradient(120deg, #f8fafc 0%, #e0eafc 100%); min-height: 100vh; }
                .card-elegan { border-radius: 24px; box-shadow: 0 8px 32px rgba(44,62,80,0.13); animation: fadeIn 0.7s; background: rgba(255,255,255,0.98); }
                @keyframes fadeIn { from { opacity: 0; transform: translateY(30px); } to { opacity: 1; transform: translateY(0); } }
            </style>
        </head>
        <body>
            <div class="container py-5">
                <div class="row justify-content-center">
                    <div class="col-lg-6">
                        <div class="card card-elegan p-4 text-center">
                            <div class="mb-3" style="font-size:2.5rem;color:#ff1744;"><i class="fa-solid fa-triangle-exclamation"></i></div>
                            <h4 class="mb-2 text-danger">Gagal menghapus data!</h4>
                            <div class="mb-3 text-secondary small"><?= mysqli_error($conn); ?></div>
                            <a href="index.php" class="btn btn-secondary"><i class="fa-solid fa-arrow-left"></i> Kembali</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Bootstrap JS -->
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
        </body>
        </html>
        <?php
    }
    mysqli_stmt_close($stmt);
}

mysqli_close($conn);
?>