<?php
session_start();
include "koneksi.php";  

//check jika belum ada user yang login arahkan ke halaman login
if (!isset($_SESSION['username'])) { 
	header("location:login.php"); 
} 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
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
        html {
            position: relative;
            min-height: 100%;
        }
        body {
            margin-bottom: 100px; /* Margin bottom by footer height */
        }
        footer {
            position: absolute;
            bottom: 0;
            width: 100%;
            height: 100px; /* Set the fixed height of the footer here */ 
        }
    </style>
</head>
<body>
    <!-- nav begin -->
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
    <!-- nav end -->
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
            <h4 class="lead display-6 pb-2 border-bottom border-danger-subtle">Article</h4>
            <?php
            include("dashboard.php");
        }
        ?>
    </div>
    <div class="container">
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-secondary mb-2" data-bs-toggle="modal" data-bs-target="#modalTambah">
            <i class="bi bi-plus-lg"></i> Tambah Article
        </button>
    <div class="row">
        <div class="table-responsive" id="article_data">
           
        </div>
    </div>
        <!-- Awal Modal Tambah-->
    <div class="modal fade" id="modalTambah" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Tambah Article</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" action="" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="formGroupExampleInput" class="form-label">Judul</label>
                            <input type="text" class="form-control" name="judul" placeholder="Tuliskan Judul Artikel" required>
                        </div>
                        <div class="mb-3">
                            <label for="floatingTextarea2">Isi</label>
                            <textarea class="form-control" placeholder="Tuliskan Isi Artikel" name="isi" required></textarea>
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
    </section>
   
    <!-- content begin -->
    <section id="content" class="p-5">
        <!-- content begin -->

<!-- content end -->
    </section>

    <!-- content end -->
    <!-- footer begin -->
    <footer class="text-center p-5 bg-danger-subtle">
    <div>
        <a href="https://www.instagram.com/udinusofficial"
        ><i class="bi bi-instagram h2 p-2 text-dark"></i
        ></a>
        <a href="https://twitter.com/udinusofficial"
        ><i class="bi bi-twitter h2 p-2 text-dark"></i
        ></a>
        <a href="https://wa.me/+62812685577"
        ><i class="bi bi-whatsapp h2 p-2 text-dark"></i
        ></a>
    </div>
    <div>Aprilyani Nur Safitri &copy; 2023</div>
    </footer>
    <!-- footer end -->
    <script>
        $(document).ready(function(){
            load_data();
            function load_data(hlm){
                $.ajax({
                    url : "article_data.php",
                    method : "POST",
                    data : {
                                        hlm: hlm
                                },
                    success : function(data){
                            $('#article_data').html(data);
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
        include "upload_foto.php";

        //jika tombol simpan diklik
        if (isset($_POST['simpan'])) {
            $judul = $_POST['judul'];
            $isi = $_POST['isi'];
            $tanggal = date("Y-m-d H:i:s");
            $username = $_SESSION['username'];
            $gambar ='';
            $nama_gambar = $_FILES.'img/'.['gambar']['name'];

            //jika ada file yang dikirim  
            if ($nama_gambar != '') {
                    //panggil function upload_foto untuk cek spesifikasi file yg dikirimkan user
                    //function ini memiliki 2 keluaran yaitu status dan message
                $cek_upload = upload_foto($_FILES["gambar"]);

                        //cek status true/false
                if ($cek_upload['status']) {
                        //jika true maka message berisi nama file gambar
                        $gambar = 'img/' . $cek_upload['message'];
                } else {
                        //jika true maka message berisi pesan error, tampilkan dalam alert
                    echo "<script>
                        alert('" . $cek_upload['message'] . "');
                        document.location='article.php';
                    </script>";
                    die;
                }
            }

                //cek apakah ada id yang dikirimkan dari form
            if (isset($_POST['id'])) {
                //jika ada id,    lakukan update data dengan id tersebut
                $id = $_POST['id'];

                if ($nama_gambar == '') {
                    //jika tidak ganti gambar
                    $gambar = $_POST['gambar_lama'];
                } else {
                    //jika ganti gambar, hapus gambar lama
                    unlink($_POST['gambar_lama']);
                }

                $stmt = $conn->prepare("UPDATE article 
                                        SET 
                                        judul =?,
                                        isi =?,
                                        gambar = ?,
                                        tanggal = ?,
                                        username = ?
                                        WHERE id = ?");

                $stmt->bind_param("sssssi", $judul, $isi, $gambar, $tanggal, $username, $id);
                $simpan = $stmt->execute();
            } else {
                    //jika tidak ada id, lakukan insert data baru
                $stmt = $conn->prepare("INSERT INTO article (judul,isi,gambar,tanggal,username)
                                        VALUES (?,?,?,?,?)");

                $stmt->bind_param("sssss", $judul, $isi, $gambar, $tanggal, $username);
                $simpan = $stmt->execute();
            }

            if ($simpan) {
                echo "<script>
                    alert('Simpan data sukses');
                    document.location='article.php';
                </script>";
            } else {
                echo "<script>
                    alert('Simpan data gagal');
                    document.location='article.php';
                </script>";
            }

            $stmt->close();
            $conn->close();
        }

        //jika tombol hapus diklik
        if (isset($_POST['hapus'])) {
            $id = $_POST['id'];
            $gambar = $_POST['gambar'];

            if ($gambar != '') {
                //hapus file gambar
                unlink("img/" . $gambar);
            }

            $stmt = $conn->prepare("DELETE FROM article WHERE id =?");

            $stmt->bind_param("i", $id);
            $hapus = $stmt->execute();

            if ($hapus) {
                echo "<script>
                    alert('Hapus data sukses');
                    document.location='article.php';
                </script>";
            } else {
                echo "<script>
                    alert('Hapus data gagal');
                    document.location='article.php';
                </script>";
            }

            $stmt->close();
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