<?php
// Aktifkan error reporting untuk debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

$host = "localhost";
$username = "xirpl1-15"; // Ganti dengan username database Anda
$password = "0075205536"; // Ganti dengan password database Anda
$database = "db_xirpl1-15_1";

// Membuat koneksi
$conn = mysqli_connect($host, $username, $password, $database);

// Cek koneksi
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

?>
