<?php
include 'config.php';

if (isset($_GET['hapus_pesanan'])) {
    $id = (int)$_GET['hapus_pesanan'];

    $conn->query("DELETE FROM pesanan WHERE id='$id'");

    header("Location: pesanan_adm.php");
    exit;
}

if (isset($_GET['selesai_pesanan'])) {

    $id = (int)$_GET['selesai_pesanan'];

    date_default_timezone_set('Asia/Jakarta');
    $tanggalPembayaran = date('Y-m-d');

    $conn->query("
        UPDATE pesanan 
        SET statusPesanan='selesai',
            statusPembayaran='Lunas',
            metodePembayaran='Lunas',
            tanggalPembayaran='$tanggalPembayaran'
        WHERE id=$id
    ");

    header("Location: laporan_adm.php");
    exit;
}

$pesanan = $conn->query("
    SELECT
        p.*,
        pl.nama AS namaPelanggan,
        pk.namaPaket
    FROM pesanan p
    LEFT JOIN pelanggan pl
        ON p.idPelanggan = pl.idPelanggan
    LEFT JOIN paketpernikahan pk
        ON p.idPaket = pk.idPaket
    ORDER BY p.id DESC
");

include 'header_adm.php';
?>

<section id="pesanan">

    <div class="card border-0 shadow-sm mb-4" style="border-radius:20px; overflow:hidden;">

        <div class="card-header bg-maroon text-white py-4 border-0">
            <h4 class="mb-0 fw-bold">Kelola Pesanan</h4>
        </div>

        <div class="card-body bg-white p-4">

            <div class="table-responsive">

                <table class="table table-hover align-middle">

                    <thead style="background:#f8fafc;">

                        <tr>
                            <th>ID</th>
                            <th>Nama</th>
                            <th>Paket</th>
                            <th>Status Pembayaran</th>
                            <th>Status Pesanan</th>
                            <th width="260">Aksi</th>
                            <th class="text-center">Tambahan</th>
                        </tr>

                    </thead>

                    <tbody>

                    <?php while($ps = $pesanan->fetch_assoc()): ?>

                        <?php
                        $statusPembayaran = strtolower(trim($ps['metodePembayaran']?? ''));
                        $statusPesanan = strtolower(trim($ps['statusPesanan']?? ''));
                        ?>

                        <tr style="border-bottom:1px solid #f1f5f9;">

                            <td class="fw-semibold text-muted">
                                <?= $ps['id'] ?>
                            </td>

                            <td class="fw-semibold">
                                <?= $ps['namaPelanggan'] ?? '-' ?>
                            </td>

                            <td>
                                <span class="badge bg-light text-dark border px-3 py-2">
                                    <?= $ps['namaPaket'] ?? $ps['idPaket'] ?>
                                </span>
                            </td>

                            <td>
                                <?php
                                if ($statusPembayaran == 'lunas') {
                                    echo '
                                    <span class="badge px-3 py-2"
                                          style="background:#fef3c7; color:#b45309; font-size:13px;">
                                        Lunas
                                    </span>';
                                } elseif ($statusPembayaran == 'dp') {
                                    echo '
                                    <span class="badge px-3 py-2"
                                          style="background:#dcfce7; color:#15803d; font-size:13px;">
                                        DP
                                    </span>';
                                } else {
                                    echo '
                                    <span class="badge bg-secondary px-3 py-2">
                                        -
                                    </span>';
                                }
                                ?>
                            </td>

                            <td>
                                <?php
                                if ($statusPesanan == 'selesai') {
                                    echo '
                                    <div class="d-inline-flex align-items-center px-3 py-2 rounded-pill"
                                         style="background:#ecfdf3; color:#16a34a; font-size:13px; font-weight:600; border:1px solid #bbf7d0;">
                                        <span style="width:8px; height:8px; background:#16a34a; border-radius:50%; display:inline-block; margin-right:8px;"></span>
                                        Selesai
                                    </div>';
                                } else {
                                    echo '
                                    <div class="d-inline-flex align-items-center px-3 py-2 rounded-pill"
                                         style="background:#dbeafe; color:#2563eb; font-size:13px; font-weight:600; border:1px solid #bfdbfe;">
                                        <span style="width:8px; height:8px; background:#2563eb; border-radius:50%; display:inline-block; margin-right:8px;"></span>
                                        Diproses
                                    </div>';
                                }
                                ?>
                            </td>

                            <td>
                                <div class="d-flex align-items-center gap-2 flex-wrap">

                                    <button
                                        class="btn btn-info btn-sm text-white"
                                        data-bs-toggle="modal"
                                        data-bs-target="#detailModal<?= $ps['id'] ?>">
                                        Detail
                                    </button>

                                    <?php if ($statusPesanan != 'selesai'): ?>

                                        <a href="?selesai_pesanan=<?= $ps['id'] ?>"
                                           class="btn btn-success btn-sm"
                                           onclick="return confirm('Pesanan selesai?')">
                                            Selesai
                                        </a>

                                    <?php endif; ?>

                                    <a href="?hapus_pesanan=<?= $ps['id'] ?>"
                                       class="btn btn-danger btn-sm"
                                       onclick="return confirm('Hapus pesanan?')">
                                        Hapus
                                    </a>

                                </div>
                            </td>

                            <td class="text-center">
                                <?php
                                $tambahan = $ps['Tambahan'] ?? '';
                                $adaTambahan = false;

                                preg_match_all('/:\s*(\d+)/', $tambahan, $matches);

                                if (!empty($matches[1])) {
                                    foreach ($matches[1] as $angka) {
                                        if ((int)$angka > 0) {
                                            $adaTambahan = true;
                                            break;
                                        }
                                    }
                                }

                                if ($adaTambahan) {
                                    echo '<span class="text-success fs-5 fw-bold">✔</span>';
                                } else {
                                    echo '<span class="text-muted fs-5 fw-bold">-</span>';
                                }
                                ?>
                            </td>

                        </tr>

                        <!-- MODAL DETAIL -->
                        <div class="modal fade"
                             id="detailModal<?= $ps['id'] ?>"
                             tabindex="-1">

                            <div class="modal-dialog modal-lg modal-dialog-centered">

                                <div class="modal-content border-0 shadow">

                                    <div class="modal-header bg-maroon text-white">

                                        <h5 class="modal-title">
                                            Detail Pesanan #<?= $ps['id'] ?>
                                        </h5>

                                        <button type="button"
                                                class="btn-close btn-close-white"
                                                data-bs-dismiss="modal">
                                        </button>

                                    </div>

                                    <div class="modal-body p-4">

                                        <div class="row">

                                            <div class="col-md-6 mb-3">
                                                <label class="fw-bold">
                                                    Nama Pelanggan
                                                </label>
                                                <div>
                                                    <?= $ps['namaPelanggan'] ?? '-' ?>
                                                </div>
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label class="fw-bold">
                                                    Paket Wedding
                                                </label>
                                                <div>
                                                    <?= $ps['namaPaket'] ?? $ps['idPaket'] ?>
                                                </div>
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label class="fw-bold">
                                                    Tanggal Acara
                                                </label>
                                                <div>
                                                    <?= $ps['tanggalPesan'] ?>
                                                </div>
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label class="fw-bold">
                                                    Metode Pembayaran
                                                </label>
                                                <div>
                                                    <?= $ps['metodePembayaran'] ?>
                                                </div>
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label class="fw-bold">
                                                    Status Pesanan
                                                </label>

                                                <div>
                                                    <?php
                                                    if ($statusPembayaran == 'dp') {
                                                        echo '
                                                        <span class="badge bg-warning text-dark px-3 py-2">
                                                            DP
                                                        </span>';
                                                    } elseif ($statusPesanan == 'selesai') {
                                                        echo '
                                                        <span class="badge bg-success px-3 py-2">
                                                            Selesai
                                                        </span>';
                                                    } else {
                                                        echo '
                                                        <span class="badge bg-primary px-3 py-2">
                                                            Masih Diproses
                                                        </span>';
                                                    }
                                                    ?>
                                                </div>
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label class="fw-bold">
                                                    Total Pembayaran
                                                </label>

                                                <div class="fw-bold text-success">
                                                    Rp <?= number_format($ps['jumlahPembayaran'],0,',','.') ?>
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <label class="fw-bold mb-1">
                                                    Tambahan
                                                </label>

                                                <div class="border rounded p-3 bg-light">
                                                    <?= nl2br($ps['Tambahan'] ?? 'Tidak ada tambahan') ?>
                                                </div>
                                            </div>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                    <?php endwhile; ?>

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</section>

<?php include 'footer_adm.php'; ?>