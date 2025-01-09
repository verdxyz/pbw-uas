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
      justify-content: center;
      align-items: center;
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
       <a class="navbar-brand" target="_blank" href=".">My Daily Journal</a>
       <button
         class="navbar-toggler"
         type="button"
         data-bs-toggle="collapse"
         data-bs-target="#navbarSupportedContent"
         aria-controls="navbarSupportedContent"
         aria-expanded="false"
         aria-label="Toggle navigation"
       >
         <span class="navbar-toggler-icon"></span>
       </button>
       <div class="collapse navbar-collapse" id="navbarSupportedContent">
         <ul class="navbar-nav ms-auto mb-2 mb-lg-0 text-dark">
           <li class="nav-item">
             <a class="nav-link" href="admin.php?page=dashboard">Dashboard</a>
           </li>
           <li class="nav-item">
             <a class="nav-link" href="article.php">Article</a>
           </li> 
           <li class="nav-item dropdown">
             <a class="nav-link dropdown-toggle text-danger fw-bold" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
               <?= $_SESSION['username']?>
             </a>
             <ul class="dropdown-menu">
               <li><a class="dropdown-item" href="logout.php">Logout</a></li> 
             </ul>
           </li> 
         </ul>
       </div>
     </div>
   </nav>

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
       <button type="button" class="btn btn-secondary mb-2" data-bs-toggle="modal" data-bs-target="#modalTambah">
         <i class="bi bi-plus-lg"></i> Tambah Photo
       </button>
     </div>

     <div class="container">
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
                   <input type="file" class="form-control" name="gambar">
                 </div>
               </div>
               <div class="modal-footer">
                 <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                 <input type="submit" value="simpan" name="simpan" class="btn btn-primary">
               </div>
             </form>
           </div>
         </div>
       </div>
       <!-- Akhir Modal Tambah-->
     </div>

     <div class="section-title">
       - Photo -
     </div>

     <div class="content">
       <div class="photos">
         <?php
         include "koneksi.php";

         // Ambil data dari tabel gallery
         $hlm = (isset($_GET['hlm'])) ? $_GET['hlm'] : 1; // Halaman saat ini
         $limit = 3; // Batas jumlah gambar per halaman
         $limit_start = ($hlm - 1) * $limit; // Offset untuk query

         $sql = "SELECT * FROM gallery ORDER BY created_at DESC LIMIT $limit_start, $limit";
         $hasil = $conn->query($sql);

         if ($hasil->num_rows > 0) {
             while ($row = $hasil->fetch_assoc()) {
                 if (!empty($row["gambar"]) && file_exists($row["gambar"])) {
                     $gambar_path = $row["gambar"];
                     $gambar_id = $row["id"];
                     echo '<div class="gallery-item">';
                     echo '<img class="photo" src="' . $gambar_path . '" alt="' . htmlspecialchars($row["judul"]) . '" height="150" width="150" data-bs-toggle="modal" data-bs-target="#gambarModal' . $gambar_id . '">';
                     echo '<p><strong>' . htmlspecialchars($row["judul"]) . '</strong></p>';
                     echo '<p><small>Created at: ' . date("d M Y, H:i", strtotime($row["created_at"])) . '</small></p>';
                     echo '</div>';

                     // Modal untuk melihat gambar besar
                     echo '<div class="modal fade" id="gambarModal' . $gambar_id . '" tabindex="-1" aria-labelledby="gambarModalLabel' . $gambar_id . '" aria-hidden="true">';
                     echo '  <div class="modal-dialog modal-lg">';
                     echo '    <div class="modal-content">';
                     echo '      <div class="modal-header">';
                     echo '        <h5 class="modal-title" id="gambarModalLabel' . $gambar_id . '">' . htmlspecialchars($row["judul"]) . '</h5>';
                     echo '        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
                     echo '      </div>';
                     echo '      <div class="modal-body">';
                     echo '        <img src="' . $gambar_path . '" alt="' . htmlspecialchars($row["judul"]) . '" class="img-fluid">';
                     echo '      </div>';
                     echo '    </div>';
                     echo '  </div>';
                     echo '</div>';
                 }
             }
         } else {
             echo '<p>Tidak ada gambar ditemukan.</p>';
         }

         // Hitung total gambar
         $sql_total = "SELECT COUNT(*) AS total FROM gallery";
         $result_total = $conn->query($sql_total);
         $row_total = $result_total->fetch_assoc();
         $total_gambar = $row_total['total'];

         // Menghitung total halaman
         $total_halaman = ceil($total_gambar / $limit); // Total halaman berdasarkan jumlah data dan batas

         // Menampilkan link paginasi
         echo '<nav aria-label="Page navigation example">';
         echo '<ul class="pagination justify-content-center">';

         // Tombol Halaman Sebelumnya
         if ($hlm > 1) {
             echo '<li class="page-item"><a class="page-link" href="?hlm=' . ($hlm - 1) . '">Previous</a></li>';
         }

         // Menampilkan nomor halaman
         for ($i = 1; $i <= $total_halaman; $i++) {
             $active_class = ($hlm == $i) ? 'active' : '';
             echo '<li class="page-item ' . $active_class . '"><a class="page-link" href="?hlm=' . $i . '">' . $i . '</a></li>';
         }

         // Tombol Halaman Berikutnya
         if ($hlm < $total_halaman) {
             echo '<li class="page-item"><a class="page-link" href="?hlm=' . ($hlm + 1) . '">Next</a></li>';
         }

         echo '</ul>';
         echo '</nav>';
         ?>
       </div>
     </div>
   </section>
 </body>
</html>
