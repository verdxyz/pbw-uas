<div class="section-title">
    - Photo -
</div>
<div class="content">
    <div class="photos">
        <?php
        include "koneksi.php";

        // Ambil data dari tabel gallery
        $hlm = (isset($_GET['hlm'])) ? $_GET['hlm'] : 1; // Halaman saat ini
        $limit = 10; // Batas jumlah gambar per halaman
        $limit_start = ($hlm - 1) * $limit; // Offset untuk query

        // Query untuk mengambil gambar
        $sql = "SELECT * FROM gallery ORDER BY created_at DESC LIMIT $limit_start, $limit";
        $hasil = $conn->query($sql);

        // Tampilkan gambar jika ada
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
                    echo '        <img src="' . $gambar_path . '" class="img-fluid" alt="' . htmlspecialchars($row["judul"]) . '">';
                    echo '      </div>';
                    echo '      <div class="modal-footer">';
                    echo '        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>';
                    echo '        <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modalEdit' . $gambar_id . '">Update</button>';
                    echo '        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalDelete' . $gambar_id . '">Delete</button>';
                    echo '      </div>';
                    echo '    </div>';
                    echo '  </div>';
                    echo '</div>';
                
                    // Modal Edit
                    echo '<div class="modal fade" id="modalEdit' . $gambar_id . '" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel' . $gambar_id . '" aria-hidden="true">';
                    echo '  <div class="modal-dialog">';
                    echo '    <div class="modal-content">';
                    echo '      <div class="modal-header">';
                    echo '        <h1 class="modal-title fs-5" id="staticBackdropLabel' . $gambar_id . '">Edit Image</h1>';
                    echo '        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
                    echo '      </div>';
                    echo '      <form method="post" action="" enctype="multipart/form-data">';
                    echo '        <div class="modal-body">';
                    echo '          <div class="mb-3">';
                    echo '            <label for="judul" class="form-label">Judul</label>';
                    echo '            <input type="hidden" name="id" value="' . $gambar_id . '">';
                    echo '            <input type="text" class="form-control" name="judul" placeholder="Tuliskan Judul Gambar" value="' . htmlspecialchars($row["judul"]) . '" required>';
                    echo '          </div>';
                    echo '          <div class="mb-3">';
                    echo '            <label for="gambar" class="form-label">Ganti Gambar</label>';
                    echo '            <input type="file" class="form-control" name="gambar">';
                    echo '          </div>';
                    echo '          <div class="mb-3">';
                    echo '            <label for="gambar_lama" class="form-label">Gambar Lama</label>';
                    if ($row["gambar"] != '') {
                        if (file_exists($row["gambar"])) {
                            echo '<br><img src="' . $row["gambar"] . '" width="100">';
                        }
                    }
                    echo '            <input type="hidden" name="gambar_lama" value="' . $row["gambar"] . '">';
                    echo '          </div>';
                    echo '        </div>';
                    echo '        <div class="modal-footer">';
                    echo '          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>';
                    echo '          <input type="submit" value="Update" name="update" class="btn btn-primary">';
                    echo '        </div>';
                    echo '      </form>';
                    echo '    </div>';
                    echo '  </div>';
                    echo '</div>';
                
                    // Modal Delete
                    echo '<div class="modal fade" id="modalDelete' . $gambar_id . '" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabelDelete' . $gambar_id . '" aria-hidden="true">';
                    echo '  <div class="modal-dialog">';
                    echo '    <div class="modal-content">';
                    echo '      <div class="modal-header">';
                    echo '        <h1 class="modal-title fs-5" id="staticBackdropLabelDelete' . $gambar_id . '">Konfirmasi Hapus</h1>';
                    echo '        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
                    echo '      </div>';
                    echo '      <form method="post" action="" enctype="multipart/form-data">';
                    echo '        <div class="modal-body">';
                    echo '          <div class="mb-3">';
                    echo '            <label for="formGroupExampleInput" class="form-label">Yakin akan menghapus gambar "<strong>' . htmlspecialchars($row["judul"]) . '</strong>"?</label>';
                    echo '            <input type="hidden" name="id" value="' . $gambar_id . '">';
                    echo '            <input type="hidden" name="gambar" value="' . $row["gambar"] . '">';
                    echo '          </div>';
                    echo '        </div>';
                    echo '        <div class="modal-footer">';
                    echo '          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>';
                    echo '          <input type="submit" value="Hapus" name="hapus" class="btn btn-danger">';
                    echo '        </div>';
                    echo '      </form>';
                    echo '    </div>';
                    echo '  </div>';
                    echo '</div>';
                }
                
            }
        } else {
            echo '<p>Tidak ada gambar ditemukan.</p>';
        }
        ?>
    </div>

    <?php 
    // Menghitung total record
    $sql1 = "SELECT * FROM gallery";
    $hasil1 = $conn->query($sql1); 
    $total_records = $hasil1->num_rows;
    ?>
    <p>Total articles: <?php echo $total_records; ?></p>
    <nav class="mb-2">
        <ul class="pagination justify-content-end">
        <?php
            $jumlah_page = ceil($total_records / $limit);
            $jumlah_number = 1; //jumlah halaman ke kanan dan kiri dari halaman yang aktif
            $start_number = ($hlm > $jumlah_number)? $hlm - $jumlah_number : 1;
            $end_number = ($hlm < ($jumlah_page - $jumlah_number))? $hlm + $jumlah_number : $jumlah_page;

            // Previous page logic
            if ($hlm == 1) {
                echo '<li class="page-item disabled"><a class="page-link" href="#">First</a></li>';
                echo '<li class="page-item disabled"><a class="page-link" href="#"><span aria-hidden="true">&laquo;</span></a></li>';
            } else {
                $link_prev = ($hlm > 1)? $hlm - 1 : 1;
                echo '<li class="page-item"><a class="page-link" href="?hlm=1">First</a></li>';
                echo '<li class="page-item"><a class="page-link" href="?hlm=' . $link_prev . '"><span aria-hidden="true">&laquo;</span></a></li>';
            }

            // Halaman angka
            for ($i = $start_number; $i <= $end_number; $i++) {
                $link_active = ($hlm == $i) ? ' active' : '';
                echo '<li class="page-item ' . $link_active . '"><a class="page-link" href="?hlm=' . $i . '">' . $i . '</a></li>';
            }

            // Next page logic
            if ($hlm == $jumlah_page) {
                echo '<li class="page-item disabled"><a class="page-link" href="#"><span aria-hidden="true">&raquo;</span></a></li>';
                echo '<li class="page-item disabled"><a class="page-link" href="#">Last</a></li>';
            } else {
                $link_next = ($hlm < $jumlah_page)? $hlm + 1 : $jumlah_page;
                echo '<li class="page-item"><a class="page-link" href="?hlm=' . $link_next . '"><span aria-hidden="true">&raquo;</span></a></li>';
                echo '<li class="page-item"><a class="page-link" href="?hlm=' . $jumlah_page . '">Last</a></li>';
            }
        ?>
        </ul>
    </nav>
</div>
