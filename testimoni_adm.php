<?php
include 'config.php';
include 'header_adm.php';

if (isset($_GET['hapus'])) {
    $idTestimoni = mysqli_real_escape_string($conn, $_GET['hapus']);

    $hapus = mysqli_query($conn, "
        DELETE FROM testimoni 
        WHERE idTestimoni = '$idTestimoni'
    ");

    if ($hapus) {
        echo "<script>
            alert('Testimoni berhasil dihapus.');
            window.location='testimoni_adm.php';
        </script>";
    } else {
        echo "<script>
            alert('Gagal menghapus testimoni.');
            window.location='testimoni_adm.php';
        </script>";
    }
}

$testimoni = mysqli_query($conn, "
    SELECT 
        t.idTestimoni,
        t.idPelanggan,
        t.isiTestimoni,
        t.tanggalTestimoni,
        p.nama
    FROM testimoni t
    LEFT JOIN pelanggan p 
        ON t.idPelanggan = p.idPelanggan
    ORDER BY t.tanggalTestimoni DESC
");
?>

<section class="container-fluid px-4 py-4">
    <div class="card shadow-sm border-0 rounded-4">
        <div class="card-header bg-maroon text-white py-3">
            <h5 class="mb-0 fw-bold">Kelola Testimoni</h5>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>No</th>
                            <th>ID Testimoni</th>
                            <th>Nama Pelanggan</th>
                            <th>Isi Testimoni</th>
                            <th>Tanggal</th>
                            <th width="120">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php if ($testimoni && mysqli_num_rows($testimoni) > 0): ?>
                            <?php $no = 1; ?>
                            <?php while ($row = mysqli_fetch_assoc($testimoni)): ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= htmlspecialchars($row['idTestimoni']) ?></td>
                                    <td><?= htmlspecialchars($row['nama'] ?? '-') ?></td>
                                    <td><?= htmlspecialchars($row['isiTestimoni']) ?></td>
                                    <td>
                                        <?= !empty($row['tanggalTestimoni']) 
                                            ? date('d M Y', strtotime($row['tanggalTestimoni'])) 
                                            : '-' ?>
                                    </td>
                                    <td>
                                        <a href="testimoni_adm.php?hapus=<?= urlencode($row['idTestimoni']) ?>"
                                           onclick="return confirm('Yakin ingin menghapus testimoni ini?')"
                                           class="btn btn-danger btn-sm">
                                            Hapus
                                        </a>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6" class="text-center text-muted py-4">
                                    Belum ada testimoni.
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>

<style>
.bg-maroon {
    background-color: #0D0F2B;
}
</style>

<?php include 'footer_adm.php'; ?>