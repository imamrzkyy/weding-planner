<?php
include 'config.php';

/* =========================
   TAMBAH PAKET
========================= */
if (isset($_POST['tambah_paket'])) {

    $nama = trim($_POST['namaPaket']);
    $deskripsi = trim($_POST['deskripsi']);
    $deskripsi_lengkap = trim($_POST['deskripsi_lengkap']);
    $harga = intval($_POST['harga']);

    $gambar = null;

    if (!empty($_FILES['gambar']['name'])) {
        $namaGambar = $_FILES['gambar']['name'];
        $tmpGambar = $_FILES['gambar']['tmp_name'];
        $ekstensi = pathinfo($namaGambar, PATHINFO_EXTENSION);
        $gambar = time() . '_' . uniqid() . '.' . $ekstensi;

        move_uploaded_file($tmpGambar, 'assets/img/paket/' . $gambar);
    }

    $result = $conn->query("SELECT MAX(CAST(SUBSTRING(idPaket, 6) AS UNSIGNED)) AS max_id FROM paketpernikahan");
    $row = $result->fetch_assoc();

    $max_id = $row['max_id'] ?? 0;
    $new_id = 'paket' . ($max_id + 1);

    $stmt = $conn->prepare("INSERT INTO paketpernikahan 
        (idPaket, namaPaket, deskripsi, deskripsi_lengkap, harga, gambar) 
        VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssis", $new_id, $nama, $deskripsi, $deskripsi_lengkap, $harga, $gambar);

    if ($stmt->execute()) {

        if (!empty($_FILES['gambar_detail']['name'][0])) {
            foreach ($_FILES['gambar_detail']['name'] as $key => $namaDetail) {

                $tmpDetail = $_FILES['gambar_detail']['tmp_name'][$key];
                $ekstensiDetail = pathinfo($namaDetail, PATHINFO_EXTENSION);
                $namaFileDetail = time() . '_' . uniqid() . '.' . $ekstensiDetail;

                move_uploaded_file($tmpDetail, 'assets/img/paket/detail/' . $namaFileDetail);

                $stmtDetail = $conn->prepare("INSERT INTO paket_gambar_detail (idPaket, gambar) VALUES (?, ?)");
                $stmtDetail->bind_param("ss", $new_id, $namaFileDetail);
                $stmtDetail->execute();
                $stmtDetail->close();
            }
        }

        echo "<script>
                alert('Paket berhasil ditambahkan');
                location.href='paket_adm.php';
              </script>";
    }

    $stmt->close();
}

/* =========================
   EDIT PAKET
========================= */
if (isset($_POST['edit_paket'])) {

    $id = $_POST['idPaket'];
    $nama = trim($_POST['namaPaket']);
    $deskripsi = trim($_POST['deskripsi']);
    $deskripsi_lengkap = trim($_POST['deskripsi_lengkap']);
    $harga = intval($_POST['harga']);

    if (!empty($_FILES['gambar']['name'])) {

        $q = $conn->query("SELECT gambar FROM paketpernikahan WHERE idPaket='$id'");
        $old = $q->fetch_assoc();

        if (!empty($old['gambar']) && file_exists('assets/img/paket/' . $old['gambar'])) {
            unlink('assets/img/paket/' . $old['gambar']);
        }

        $namaGambar = $_FILES['gambar']['name'];
        $tmpGambar = $_FILES['gambar']['tmp_name'];
        $ekstensi = pathinfo($namaGambar, PATHINFO_EXTENSION);
        $gambar = time() . '_' . uniqid() . '.' . $ekstensi;

        move_uploaded_file($tmpGambar, 'assets/img/paket/' . $gambar);

        $stmt = $conn->prepare("UPDATE paketpernikahan 
            SET namaPaket=?, deskripsi=?, deskripsi_lengkap=?, harga=?, gambar=? 
            WHERE idPaket=?");

        $stmt->bind_param("sssiss", $nama, $deskripsi, $deskripsi_lengkap, $harga, $gambar, $id);

    } else {

        $stmt = $conn->prepare("UPDATE paketpernikahan 
            SET namaPaket=?, deskripsi=?, deskripsi_lengkap=?, harga=? 
            WHERE idPaket=?");

        $stmt->bind_param("sssis", $nama, $deskripsi, $deskripsi_lengkap, $harga, $id);
    }

    if ($stmt->execute()) {

        if (!empty($_FILES['gambar_detail']['name'][0])) {
            foreach ($_FILES['gambar_detail']['name'] as $key => $namaDetail) {

                $tmpDetail = $_FILES['gambar_detail']['tmp_name'][$key];
                $ekstensiDetail = pathinfo($namaDetail, PATHINFO_EXTENSION);
                $namaFileDetail = time() . '_' . uniqid() . '.' . $ekstensiDetail;

                move_uploaded_file($tmpDetail, 'assets/img/paket/detail/' . $namaFileDetail);

                $stmtDetail = $conn->prepare("INSERT INTO paket_gambar_detail (idPaket, gambar) VALUES (?, ?)");
                $stmtDetail->bind_param("ss", $id, $namaFileDetail);
                $stmtDetail->execute();
                $stmtDetail->close();
            }
        }

        echo "<script>
                alert('Paket berhasil diupdate');
                location.href='paket_adm.php';
              </script>";
    }

    $stmt->close();
}

/* =========================
   HAPUS FOTO DETAIL
========================= */
if (isset($_GET['hapus_detail'])) {

    $idGambar = $_GET['hapus_detail'];

    $q = $conn->query("SELECT gambar FROM paket_gambar_detail WHERE idGambar='$idGambar'");
    $data = $q->fetch_assoc();

    if (!empty($data['gambar']) && file_exists('assets/img/paket/detail/' . $data['gambar'])) {
        unlink('assets/img/paket/detail/' . $data['gambar']);
    }

    $conn->query("DELETE FROM paket_gambar_detail WHERE idGambar='$idGambar'");

    echo "<script>
            alert('Foto detail berhasil dihapus');
            location.href='paket_adm.php';
          </script>";
}

/* =========================
   HAPUS PAKET
========================= */
if (isset($_GET['hapus_paket'])) {

    $id = $_GET['hapus_paket'];

    $q = $conn->query("SELECT gambar FROM paketpernikahan WHERE idPaket='$id'");
    $old = $q->fetch_assoc();

    if (!empty($old['gambar']) && file_exists('assets/img/paket/' . $old['gambar'])) {
        unlink('assets/img/paket/' . $old['gambar']);
    }

    $detail = $conn->query("SELECT gambar FROM paket_gambar_detail WHERE idPaket='$id'");
    while ($d = $detail->fetch_assoc()) {
        if (!empty($d['gambar']) && file_exists('assets/img/paket/detail/' . $d['gambar'])) {
            unlink('assets/img/paket/detail/' . $d['gambar']);
        }
    }

    $conn->query("DELETE FROM paket_gambar_detail WHERE idPaket='$id'");
    $conn->query("DELETE FROM paketpernikahan WHERE idPaket='$id'");

    echo "<script>
            alert('Paket berhasil dihapus');
            location.href='paket_adm.php';
          </script>";
}

$paket = $conn->query("SELECT * FROM paketpernikahan ORDER BY idPaket ASC");

include 'header_adm.php';
?>
<style>
/* KHUSUS HP & TABLET */
@media (max-width: 768px){

    .container-fluid{
        padding-left:10px !important;
        padding-right:10px !important;
    }

    .card-header{
        flex-direction:column;
        align-items:stretch !important;
        gap:10px;
    }

    .card-header .btn{
        width:100%;
    }

    .table-responsive{
        overflow-x:auto;
        -webkit-overflow-scrolling:touch;
    }

    table{
        min-width:900px;
    }

    .modal-dialog{
        max-width:95%;
        margin:10px auto;
    }

    .modal-body{
        max-height:70vh;
        overflow-y:auto;
    }

    .modal-footer{
        flex-direction:column;
    }

    .modal-footer .btn{
        width:100%;
    }

    .d-flex.justify-content-center.gap-2{
        flex-direction:column;
    }

    .d-flex.justify-content-center.gap-2 .btn{
        width:100%;
    }

    img{
        max-width:100%;
        height:auto;
    }
}
</style>

<div class="container-fluid">

    <div class="card shadow-sm border-0">

        <div class="card-header bg-dark py-3 d-flex justify-content-between align-items-center">
            <h5 class="mb-0 fw-bold text-white">
                Kelola Paket Pernikahan
            </h5>

            <button class="btn btn-success fw-bold"
                    data-bs-toggle="modal"
                    data-bs-target="#tambahModal">
                + Tambah Paket
            </button>
        </div>

        <div class="card-body p-4 bg-white">

            <div class="table-responsive">

                <table class="table table-bordered table-hover align-middle">

                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Cover</th>
                            <th>Nama Paket</th>
                            <th>Deskripsi Singkat</th>
                            <th>Harga</th>
                            <th>Foto Detail</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>

                        <?php while($p = $paket->fetch_assoc()): ?>

                        <tr>

                            <td><?= $p['idPaket'] ?></td>

                            <td>
                                <?php if (!empty($p['gambar'])): ?>
                                    <img src="assets/img/paket/<?= $p['gambar'] ?>"
                                         style="width:80px; height:80px; object-fit:cover; border-radius:8px;">
                                <?php else: ?>
                                    -
                                <?php endif; ?>
                            </td>

                            <td class="fw-bold">
                                <?= $p['namaPaket'] ?>
                            </td>

                            <td style="max-width:300px;">
                                <?= !empty($p['deskripsi']) ? nl2br($p['deskripsi']) : '-' ?>
                            </td>

                            <td>
                                Rp <?= number_format($p['harga'],0,',','.') ?>
                            </td>

                            <td>
                                <?php
                                $idPaket = $p['idPaket'];
                                $detailFoto = $conn->query("SELECT * FROM paket_gambar_detail WHERE idPaket='$idPaket'");
                                ?>

                                <?php if ($detailFoto->num_rows > 0): ?>
                                    <?php while($df = $detailFoto->fetch_assoc()): ?>
                                        <div class="d-inline-block text-center me-1 mb-1">
                                            <img src="assets/img/paket/detail/<?= $df['gambar'] ?>"
                                                 style="width:55px; height:55px; object-fit:cover; border-radius:6px;">
                                            <br>
                                            <a href="?hapus_detail=<?= $df['idGambar'] ?>"
                                               onclick="return confirm('Hapus foto detail ini?')"
                                               class="text-danger small">
                                                Hapus
                                            </a>
                                        </div>
                                    <?php endwhile; ?>
                                <?php else: ?>
                                    -
                                <?php endif; ?>
                            </td>

                            <td>
                                <div class="d-flex justify-content-center gap-2">

                                    <button class="btn btn-warning btn-sm px-3"
                                            data-bs-toggle="modal"
                                            data-bs-target="#editModal<?= $p['idPaket']; ?>">
                                        <i class="fas fa-edit"></i> Edit
                                    </button>

                                    <a href="?hapus_paket=<?= $p['idPaket']; ?>"
                                    class="btn btn-danger btn-sm px-3"
                                    onclick="return confirm('Yakin ingin menghapus paket ini?')">
                                        <i class="fas fa-trash"></i> Hapus
                                    </a>

                                </div>
                            </td>

                        </tr>

                        <?php endwhile; ?>

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>

<!-- MODAL TAMBAH -->
<div class="modal fade" id="tambahModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <form method="POST" enctype="multipart/form-data">

                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title">Tambah Paket</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                    <div class="mb-3">
                        <label class="form-label">Nama Paket</label>
                        <input type="text" name="namaPaket" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Deskripsi Singkat</label>
                        <textarea name="deskripsi" class="form-control" rows="4"></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Deskripsi Lengkap / Isi Paket</label>
                        <textarea name="deskripsi_lengkap" class="form-control" rows="18"></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Harga</label>
                        <input type="number" name="harga" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Gambar Cover Paket</label>
                        <input type="file" name="gambar" class="form-control" accept="image/*">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Foto Detail Paket</label>
                        <input type="file" name="gambar_detail[]" class="form-control" accept="image/*" multiple>
                        <small class="text-muted">Bisa pilih lebih dari satu foto.</small>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Batal
                    </button>

                    <button type="submit" name="tambah_paket" class="btn btn-success">
                        Simpan Paket
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>

<!-- MODAL EDIT -->
<?php
$paket_modal = $conn->query("SELECT * FROM paketpernikahan ORDER BY idPaket ASC");

while($p = $paket_modal->fetch_assoc()):
?>

<div class="modal fade"
     id="editModal<?= $p['idPaket'] ?>"
     tabindex="-1">

    <div class="modal-dialog modal-lg">

        <div class="modal-content">

            <form method="POST" enctype="multipart/form-data">

                <div class="modal-header bg-warning">

                    <h5 class="modal-title text-white">
                        Edit Paket
                    </h5>

                    <button type="button"
                            class="btn-close"
                            data-bs-dismiss="modal">
                    </button>

                </div>

                <div class="modal-body">

                    <input type="hidden"
                           name="idPaket"
                           value="<?= $p['idPaket'] ?>">

                    <div class="mb-3">
                        <label class="form-label">Nama Paket</label>
                        <input type="text"
                               name="namaPaket"
                               class="form-control"
                               value="<?= $p['namaPaket'] ?>"
                               required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Deskripsi Singkat</label>
                        <textarea name="deskripsi"
                                  class="form-control"
                                  rows="4"><?= $p['deskripsi'] ?></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Deskripsi Lengkap / Isi Paket</label>
                        <textarea name="deskripsi_lengkap"
                                  class="form-control"
                                  rows="20"><?= $p['deskripsi_lengkap'] ?? '' ?></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Harga</label>
                        <input type="number"
                               name="harga"
                               class="form-control"
                               value="<?= $p['harga'] ?>"
                               required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Gambar Cover Paket</label>

                        <?php if (!empty($p['gambar'])): ?>
                            <div class="mb-2">
                                <img src="assets/img/paket/<?= $p['gambar'] ?>"
                                     style="width:120px; height:120px; object-fit:cover; border-radius:10px;">
                            </div>
                        <?php endif; ?>

                        <input type="file"
                               name="gambar"
                               class="form-control"
                               accept="image/*">

                        <small class="text-muted">
                            Kosongkan jika tidak ingin mengganti cover.
                        </small>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Tambah Foto Detail Paket</label>

                        <input type="file"
                               name="gambar_detail[]"
                               class="form-control"
                               accept="image/*"
                               multiple>

                        <small class="text-muted">
                            Bisa pilih lebih dari satu foto detail.
                        </small>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Foto Detail Saat Ini</label>
                        <div>
                            <?php
                            $idPaket = $p['idPaket'];
                            $fotoDetail = $conn->query("SELECT * FROM paket_gambar_detail WHERE idPaket='$idPaket'");
                            ?>

                            <?php if ($fotoDetail->num_rows > 0): ?>
                                <?php while($fd = $fotoDetail->fetch_assoc()): ?>
                                    <div class="d-inline-block text-center me-2 mb-2">
                                        <img src="assets/img/paket/detail/<?= $fd['gambar'] ?>"
                                             style="width:90px; height:90px; object-fit:cover; border-radius:8px;">
                                        <br>
                                        <a href="?hapus_detail=<?= $fd['idGambar'] ?>"
                                           onclick="return confirm('Hapus foto detail ini?')"
                                           class="text-danger small">
                                            Hapus
                                        </a>
                                    </div>
                                <?php endwhile; ?>
                            <?php else: ?>
                                <p class="text-muted">Belum ada foto detail.</p>
                            <?php endif; ?>
                        </div>
                    </div>

                </div>

                <div class="modal-footer">

                    <button type="button"
                            class="btn btn-secondary"
                            data-bs-dismiss="modal">
                        Batal
                    </button>

                    <button type="submit"
                            name="edit_paket"
                            class="btn btn-warning text-white">
                        Simpan Perubahan
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

<?php endwhile; ?>


<?php include 'footer_adm.php'; ?>