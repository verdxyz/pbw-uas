<table class="table table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th class="w-25">username</th>
                        <th class="w-75">password</th>
                        <th class="w-25">foto</th>
                        <th class="w-25">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include "koneksi.php";
                    $hlm = (isset($_POST['hlm'])) ? $_POST['hlm'] : 1;
                    $limit = 3;
                    $limit_start = ($hlm - 1) * $limit;
                    $no = $limit_start + 1;

                    $sql = "SELECT * FROM users ORDER BY created_at DESC LIMIT $limit_start, $limit";
                    $hasil = $conn->query($sql);
                    while ($row = $hasil->fetch_assoc()) {
                    ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td>
                                <strong><?= $row["username"] ?></strong>
                                <br>pada : <?= $row["created_at"] ?>
                            </td>
                            <td><?= $row["password"] ?></td>
                            <td>
                                <?php
                                if ($row["foto"] != '') {
                                    if (file_exists($row["foto"] . '')) {
                                ?>
                                        <img src="<?= $row["foto"] ?>" width="100">
                                <?php
                                    }
                                }
                                ?>
                            </td>
                            <td>
                                <a href="#" title="edit" class="badge rounded-pill text-bg-success" data-bs-toggle="modal" data-bs-target="#modalEdit<?= $row["id"] ?>"><i class="bi bi-pencil"></i></a>
                                <a href="#" title="delete" class="badge rounded-pill text-bg-danger" data-bs-toggle="modal" data-bs-target="#modalHapus<?= $row["id"] ?>"><i class="bi bi-x-circle"></i></a>
                                <!-- Awal Modal Edit -->
                                <div class="modal fade" id="modalEdit<?= $row["id"] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="staticBackdropLabel">Edit Users</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <form method="post" action="" enctype="multipart/form-data">
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label for="formGroupExampleInput" class="form-label">Username</label>
                                                        <input type="hidden" name="id" value="<?= $row["id"] ?>">
                                                        <input type="text" class="form-control" name="judul" placeholder="Tuliskan Judul users" value="<?= $row["username"] ?>" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="floatingTextarea2">password</label>
                                                        <textarea class="form-control" placeholder="Tuliskan password users" name="password" required><?= $row["password"] ?></textarea>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="formGroupExampleInput2" class="form-label">Ganti foto</label>
                                                        <input type="file" class="form-control" name="foto">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="formGroupExampleInput3" class="form-label">foto Lama</label>
                                                        <?php
                                                        if ($row["foto"] != '') {
                                                            if (file_exists($row["foto"] . '')) {
                                                        ?>
                                                                <br><img src="<?= $row["foto"] ?>" width="100">
                                                        <?php
                                                            }
                                                        }
                                                        ?>
                                                        <input type="hidden" name="foto_lama" value="<?= $row["foto"] ?>">
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
                                <!-- Akhir Modal Edit -->

                                <!-- Awal Modal Hapus -->
                                <div class="modal fade" id="modalHapus<?= $row["id"] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="staticBackdropLabel">Konfirmasi Hapus Users</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <form method="post" action="" enctype="multipart/form-data">
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label for="formGroupExampleInput" class="form-label">Yakin akan menghapus users "<strong><?= $row["username"] ?></strong>"?</label>
                                                        <input type="hidden" name="id" value="<?= $row["id"] ?>">
                                                        <input type="hidden" name="foto" value="<?= $row["foto"] ?>">
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">batal</button>
                                                    <input type="submit" value="hapus" name="hapus" class="btn btn-primary">
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- Akhir Modal Hapus -->
                            
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
</table>

<?php 
$sql1 = "SELECT * FROM users";
$hasil1 = $conn->query($sql1); 
$total_records = $hasil1->num_rows;
?>
<p>Total users : <?php echo $total_records; ?></p>
<nav class="mb-2">
    <ul class="pagination justify-content-end">
    <?php
        $jumlah_page = ceil($total_records / $limit);
        $jumlah_number = 1; //jumlah halaman ke kanan dan kiri dari halaman yang aktif
        $start_number = ($hlm > $jumlah_number)? $hlm - $jumlah_number : 1;
        $end_number = ($hlm < ($jumlah_page - $jumlah_number))? $hlm + $jumlah_number : $jumlah_page;

        if($hlm == 1){
            echo '<li class="page-item disabled"><a class="page-link" href="#">First</a></li>';
            echo '<li class="page-item disabled"><a class="page-link" href="#"><span aria-hidden="true">&laquo;</span></a></li>';
        } else {
            $link_prev = ($hlm > 1)? $hlm - 1 : 1;
            echo '<li class="page-item halaman" id="1"><a class="page-link" href="#">First</a></li>';
            echo '<li class="page-item halaman" id="'.$link_prev.'"><a class="page-link" href="#"><span aria-hidden="true">&laquo;</span></a></li>';
        }

        for($i = $start_number; $i <= $end_number; $i++){
            $link_active = ($hlm == $i)? ' active' : '';
            echo '<li class="page-item halaman '.$link_active.'" id="'.$i.'"><a class="page-link" href="#">'.$i.'</a></li>';
        }

        if($hlm == $jumlah_page){
            echo '<li class="page-item disabled"><a class="page-link" href="#"><span aria-hidden="true">&raquo;</span></a></li>';
            echo '<li class="page-item disabled"><a class="page-link" href="#">Last</a></li>';
        } else {
        $link_next = ($hlm < $jumlah_page)? $hlm + 1 : $jumlah_page;
            echo '<li class="page-item halaman" id="'.$link_next.'"><a class="page-link" href="#"><span aria-hidden="true">&raquo;</span></a></li>';
            echo '<li class="page-item halaman" id="'.$jumlah_page.'"><a class="page-link" href="#">Last</a></li>';
        }
    ?>
    </ul>
</nav>