<?php
// Mulai sesi
session_start();

// Koneksi ke database
$host     = 'localhost';
$username = 'root'; // Ganti dengan username database Anda
$password = '';     // Ganti dengan password database Anda
$database = 'webdailyjournal'; // Nama database Anda

$conn = new mysqli($host, $username, $password, $database);

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi ke database gagal: " . $conn->connect_error);
}

// Periksa apakah form telah disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data username dan password dari form
    $username = $conn->real_escape_string($_POST['username']);
    $password = $conn->real_escape_string($_POST['password']);

    // Query untuk memeriksa username dan password di database
    $query = "SELECT * FROM users WHERE username = '$username'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        // Ambil data pengguna
        $user = $result->fetch_assoc();
        // echo "<pre>";
        // print_r($user);
        // echo "</pre>";
        // die;

        // Verifikasi password
        // if (password_verify($password, $user['password'])) {
        if( $user['password'] == $password ) {
            // Login berhasil, simpan data pengguna ke sesi
            $_SESSION['username'] = $user['username'];
            $_SESSION['user_id'] = $user['id'];

            // Redirect ke halaman utama
            header('Location: index.php');
            exit();
        } else {
            // Password salah
            $_SESSION['error'] = 'Password salah.';
            header('Location: login.php');
            exit();
        }
    } else {
        // Username tidak ditemukan
        $_SESSION['error'] = 'Username tidak ditemukan.';
        header('Location: login.php');
        exit();
    }
} else {
    // Akses langsung ke file ini tidak diizinkan
    header('Location: login.php');
    exit();
}

// if ($_POST['username'] && $_POST['password']) {
//     echo "<script>
//         alert(' " .$_POST['username'] . " - ". $_POST['password'] . " ')
//     </script>";
// }
?>
