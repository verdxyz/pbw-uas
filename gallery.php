<?php
session_start();

include "koneksi.php";  

//check jika belum ada user yang login arahkan ke halaman login
if (!isset($_SESSION['username'])) { 
	header("location:login.php"); 
} 
?>

<html>
 <head>
  <title>
   Daily Journal
  </title>
  <title>My Daily Journal | Admin</title>
    <link rel="icon" href="img/logo.png" />
    <link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css"
    />
    <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
    rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
    crossorigin="anonymous"
    /> 
    <!-- Memuat jQuery melalui CDN -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <style>
   body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 80%;
            margin: 0 auto;
            padding: 20px;
        }
        h1 {
            font-family: 'Times New Roman', Times, serif;
            font-size: 36px;
            font-style: italic;
        }
        p {
            font-size: 18px;
        }
        .nav {
            margin: 20px 0;
        }
        .nav a {
            margin-right: 15px;
            text-decoration: none;
            color: purple;
        }
        .content {
            display: flex;
        justify-content: center; /* Memusatkan secara horizontal */
        align-items: center; /* Memusatkan secara vertikal */
        flex-wrap: wrap; 
        }
        .photos {
    display: flex;
    flex-wrap: wrap;
    gap: 15px;
    justify-content: center;
    padding: 20px;
    }

    .gallery-item {
        text-align: center;
        border: 1px solid #ddd;
        padding: 10px;
        border-radius: 8px;
        background-color: #f9f9f9;
        transition: transform 0.3s, box-shadow 0.3s;
    }

    .gallery-item img {
        width: 150px;
        height: 150px;
        object-fit: cover;
        border-radius: 5px;
    }

    .gallery-item:hover {
        transform: scale(1.05);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }

    .gallery-item p {
        margin: 10px 0 0;
        font-size: 14px;
        font-weight: bold;
        color: #333;
    }

        .photo {
            object-fit: cover;
        }
        .video iframe {
            width: 100%;
            height: 315px;
        }
        .section-title {
            text-align: center;
            font-weight: bold;
            margin: 20px 0;
        }
        @media (max-width: 768px) {
            .content {
                flex-direction: column;
            }
            .photos, .video {
                width: 100%;
            }
            .photos img {
                width: 45%;
            }
        }
  </style>
 </head>
 <body>
 <nav class="navbar navbar-expand-sm bg-body-tertiary sticky-top bg-danger-subtle">
    <div class="container">
        <a class="navbar-brand" href=".">My Daily Journal</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0 text-dark">
                <li class="nav-item"><a class="nav-link" href="admin.php?page=dashboard">Dashboard</a></li>
                <li class="nav-item"><a class="nav-link" href="article.php">Article</a></li>
                <li class="nav-item"><a class="nav-link" href="users.php">Users</a></li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-danger fw-bold" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <?= $_SESSION['username'] ?>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
  </nav>
    <!-- end nav -->
    <section id="content" class="p-5">
    <div class="container">
        <?php
        if(isset($_GET['page'])){
        ?>
            <h4 class="lead display-6 pb-2 border-bottom border-danger-subtle"><?= ucfirst($_GET['page'])?></h4>
            <?php
            include($_GET['page'].".php");
        }else{
        ?>
            <h4 class="lead display-6 pb-2 border-bottom border-danger-subtle">Gallery</h4>
            <?php
            include("dashboard.php");
        }
        ?>
    </div>
    <div class="container">
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-secondary mb-2" data-bs-toggle="modal" data-bs-target="#modalTambah">
            <i class="bi bi-plus-lg"></i> Tambah Photo
        </button>
    <div class="row">
        <div class="table-responsive" id="gallery_data">
        
        </div>
        </div>
    </div>
        <!-- Awal Modal Tambah-->
        <div class="modal fade" id="modalTambah" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Tambah Photo</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" action="" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="formGroupExampleInput" class="form-label">Judul</label>
                            <input type="text" class="form-control" name="judul" placeholder="Tuliskan Judul Gambar" required>
                        </div>
                        <div class="mb-3">
                            <label for="formGroupExampleInput2" class="form-label">Gambar</label>
                            <input type="file" class="form-control" name="gambar" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <input type="submit" value="Simpan" name="tambah" class="btn btn-primary">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Akhir Modal Tambah-->
            

    </section>
    <script>
        $(document).ready(function(){
            load_data();
            function load_data(hlm){
                $.ajax({
                    url : "gallery_data.php",
                    method : "POST",
                    data : {
                                        hlm: hlm
                                },
                    success : function(data){
                            $('#gallery_data').html(data);
                    }
                })
            } 
            $(document).on('click', '.halaman', function(){
            var hlm = $(this).attr("id");
            load_data(hlm);
             }); 
        });
     </script>


<?php
include "upload_foto.php"; // Pastikan fungsi upload_foto sudah benar
include "koneksi.php"; // Pastikan koneksi ke database benar

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Proses Update Data
    if (isset($_POST['update'])) {
        $id = $_POST['id'];
        $judul = $_POST['judul'];
        $gambar_lama = $_POST['gambar_lama'];
        $tanggal = date("Y-m-d H:i:s");
        $gambar = $gambar_lama; // Default gunakan gambar lama

        // Jika ada file gambar baru yang diupload
        if (!empty($_FILES['gambar']['name'])) {
            $cek_upload = upload_foto($_FILES['gambar']);
            if ($cek_upload['status']) {
                $gambar = 'img/' . $cek_upload['message'];
                // Hapus gambar lama jika ada
                if (file_exists($gambar_lama)) {
                    unlink($gambar_lama);
                }
            } else {
                echo "<script>alert('" . $cek_upload['message'] . "');</script>";
                exit;
            }
        }

        // Update data ke database
        $stmt = $conn->prepare("UPDATE gallery SET judul = ?, gambar = ?, created_at = ? WHERE id = ?");
        $stmt->bind_param("sssi", $judul, $gambar, $tanggal, $id);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            echo "<script>alert('Update data sukses'); window.location='gallery.php';</script>";
        } else {
            echo "<script>alert('Update data gagal');</script>";
        }

        $stmt->close();
    }

    // Proses Tambah Data
    elseif (isset($_POST['tambah'])) {
        $judul = $_POST['judul'];
        $tanggal = date("Y-m-d H:i:s");
        $gambar = '';

        // Proses upload file gambar
        if (!empty($_FILES['gambar']['name'])) {
            $cek_upload = upload_foto($_FILES['gambar']);
            if ($cek_upload['status']) {
                $gambar = 'img/' . $cek_upload['message'];
            } else {
                echo "<script>alert('" . $cek_upload['message'] . "');</script>";
                exit;
            }
        }

        // Insert data ke database
        $stmt = $conn->prepare("INSERT INTO gallery (judul, gambar, created_at) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $judul, $gambar, $tanggal);
        $simpan = $stmt->execute();

        if ($simpan) {
            echo "<script>alert('Simpan data sukses'); window.location='gallery.php';</script>";
        } else {
            echo "<script>alert('Simpan data gagal');</script>";
        }

        $stmt->close();
    }

    // Proses Hapus Data
    elseif (isset($_POST['hapus'])) {
        $id = $_POST['id'];
        $gambar = $_POST['gambar'];

        // Hapus file gambar dari server
        if (!empty($gambar) && file_exists($gambar)) {
            unlink($gambar);
        }

        // Hapus data dari database
        $stmt = $conn->prepare("DELETE FROM gallery WHERE id = ?");
        $stmt->bind_param("i", $id);
        $hapus = $stmt->execute();

        if ($hapus) {
            echo "<script>alert('Hapus data sukses'); window.location='gallery.php';</script>";
        } else {
            echo "<script>alert('Hapus data gagal');</script>";
        }

        $stmt->close();
    }

    $conn->close();
}
?>


    <script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
    crossorigin="anonymous"
    ></script>
 </body>
</html>
