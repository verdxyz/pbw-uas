<?php
// Konfigurasi database
$host     = 'localhost';       // Nama host (default: localhost)
$username = 'root';        // Username MySQL (default: root)
$password = '';            // Password MySQL (default: kosong)
$database = 'webdailyjournal'; // Nama database yang digunakan

// Membuat koneksi ke database
$conn = new mysqli($host, $username, $password, $database);

// Cek koneksi
// if ($conn->connect_error) {
//     die("Koneksi ke database gagal: " . $conn->connect_error);
// }

// // Jika koneksi berhasil
// echo "Koneksi ke database berhasil!";
?>
