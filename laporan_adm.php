<?php
include 'config.php';

$bulan = $_GET['bulan'] ?? date('m');
$tahun = $_GET['tahun'] ?? date('Y');

$laporan = $conn->query("
    SELECT 
        p.*,
        pl.nama AS namaPelanggan,
        pk.namaPaket
    FROM pesanan p
    LEFT JOIN pelanggan pl
        ON p.idPelanggan = pl.idPelanggan
    LEFT JOIN paketpernikahan pk
        ON p.idPaket = pk.idPaket
    WHERE p.statusPembayaran IN ('Lunas', 'Sudah Bayar')
    AND MONTH(p.tanggalPesan) = '$bulan'
    AND YEAR(p.tanggalPesan) = '$tahun'
    ORDER BY p.tanggalPesan ASC
");

include 'header_adm.php';
?>

<section id="laporan">
    <div class="card mb-4 shadow-sm border-0" style="border-radius: 12px; overflow: hidden;">
        <div class="card-header bg-maroon py-3">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0 fw-bold text-white">Laporan Transaksi</h5>

                <div class="d-flex gap-2">
                    <a href="laporan_pdf.php?bulan=<?= $bulan ?>&tahun=<?= $tahun ?>" class="btn btn-danger btn-sm fw-bold px-3">
                        <i class="bi bi-file-earmark-pdf me-1"></i> Download PDF
                    </a>

                    <input type="month" value="<?= $tahun.'-'.$bulan ?>" id="date_laporan" class="form-control form-control-sm" style="width: 160px;">
                </div>
            </div>
        </div>

        <div class="card-body bg-white p-4">
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Nama Pelanggan</th>
                            <th>Paket</th>
                            <th>Jumlah</th>
                            <th>Status</th>
                            <th>Tanggal Acara</th>
                            <th>Tanggal Pembayaran</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php if ($laporan->num_rows > 0): ?>
                            <?php while($row = $laporan->fetch_assoc()): ?>
                            <tr>
                                <td><?= $row['id'] ?></td>
                                <td><?= $row['namaPelanggan'] ?></td>
                                <td><?= $row['namaPaket'] ?></td>
                                <td>Rp <?= number_format($row['jumlahPembayaran'], 0, ',', '.') ?></td>
                                <td>
                                    <span class="badge bg-success">
                                        <?= $row['statusPembayaran'] ?>
                                    </span>
                                </td>
                                <td>
                                    <?= !empty($row['tanggalPesan'])
                                        ? date('d M Y', strtotime($row['tanggalPesan']))
                                        : '-' ?>
                                </td>
                                <td>
                                    <?= !empty($row['tanggalPembayaran'])
                                        ? date('d M Y', strtotime($row['tanggalPembayaran']))
                                        : '-' ?>
                                </td>
                            </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="7" class="text-center py-4 text-muted">
                                    Belum ada transaksi pada periode ini.
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>

<script>
document.getElementById('date_laporan').addEventListener('change', function() {
    let v = this.value.split('-');
    window.location.href = "laporan_adm.php?bulan=" + v[1] + "&tahun=" + v[0];
});
</script>

<?php include 'footer_adm.php'; ?>