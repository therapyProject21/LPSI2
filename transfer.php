<?php
// transfer.php

$host = 'localhost'; // ganti dengan host database Anda
$dbname = 'lpsi'; // ganti dengan nama database Anda
$username = 'root'; // ganti dengan username database Anda
$password = ''; // ganti dengan password database Anda

try {
    // Membuat koneksi PDO
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    // Mengatur mode error PDO ke Exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // Menangani error koneksi
    echo 'Koneksi gagal: ' . $e->getMessage();
}
?>
