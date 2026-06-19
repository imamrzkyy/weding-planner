<?php
include 'config.php';

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

include 'header_adm.php';
?>

<style>
.bg-maroon {
    background-color: #0D0F2B;
}

.card {
    border-radius: 18px;
}

.table th {
    font-size: 14px;
    font-weight: 700;
}

.table td {
    font-size: 14px;
    vertical-align: middle;
}

.testimoni-text {
    max-width: 420px;
    white-space: normal;
    line-height: 1.5;
}

.btn-hapus {
    border-radius: 8px;
    font-weight: 600;
    padding: 6px 14px;
}

@media (max-width: 768px) {
    section.container-fluid {
        padding-left: 10px !important;
        padding-right: 10px !important;
    }

    .card-body {
        padding: 12px !important;
    }

    .table-responsive {
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
    }

    table {
        min-width: 850px;
    }

    table th,
    table td {
        font-size: 13px;
        white-space: nowrap;
    }

    .testimoni-text {
        white-space: normal !important;
        min-width: 280px;
    }

    .btn-sm {
        width: 100%;
    }

    .modal-dialog {
        margin: 12px;
    }
}
</style>

<section class="container-fluid px-4 py-4">

    <div class="card shadow-sm border-0">

        <div class="card-header bg-maroon text-white py-3">
            <h5 class="mb-0 fw-bold">
                Kelola Testimoni
            </h5>
        </div>

        <div class="card-body bg-white">

            <div class="table-responsive">

                <table class="table table-bordered table-hover align-middle">

                    <thead class="table-dark">
                        <tr>
                            <th>No</th>
                            <th>ID Testimoni</th>
                            <th>Nama Pelanggan</th>
                            <th>Isi Testimoni</th>
                            <th>Tanggal</th>
                            <th width="120" class="text-center">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>

                        <?php if ($testimoni && mysqli_num_rows($testimoni) > 0): ?>

                            <?php $no = 1; ?>

                            <?php while ($row = mysqli_fetch_assoc($testimoni)): ?>

                                <tr>
                                    <td><?= $no++ ?></td>

                                    <td>
                                        <?= htmlspecialchars($row['idTestimoni']) ?>
                                    </td>

                                    <td>
                                        <?= htmlspecialchars($row['nama'] ?? '-') ?>
                                    </td>

                                    <td class="testimoni-text">
                                        <?= htmlspecialchars($row['isiTestimoni']) ?>
                                    </td>

                                    <td>
                                        <?= !empty($row['tanggalTestimoni'])
                                            ? date('d M Y', strtotime($row['tanggalTestimoni']))
                                            : '-' ?>
                                    </td>

                                    <td class="text-center">
                                        <button
                                            type="button"
                                            class="btn btn-danger btn-sm btn-hapus"
                                            data-bs-toggle="modal"
                                            data-bs-target="#hapusModal<?= htmlspecialchars($row['idTestimoni']) ?>">
                                            Hapus
                                        </button>
                                    </td>
                                </tr>

                                <!-- MODAL HAPUS -->
                                <div class="modal fade"
                                     id="hapusModal<?= htmlspecialchars($row['idTestimoni']) ?>"
                                     tabindex="-1"
                                     aria-hidden="true">

                                    <div class="modal-dialog modal-dialog-centered">

                                        <div class="modal-content border-0 shadow">

                                            <div class="modal-header bg-danger text-white">

                                                <h5 class="modal-title">
                                                    Konfirmasi Hapus
                                                </h5>

                                                <button type="button"
                                                        class="btn-close btn-close-white"
                                                        data-bs-dismiss="modal"
                                                        aria-label="Close">
                                                </button>

                                            </div>

                                            <div class="modal-body text-center p-4">

                                                <i class="fas fa-trash-alt text-danger mb-3"
                                                   style="font-size:55px;"></i>

                                                <h5 class="fw-bold">
                                                    Yakin ingin menghapus testimoni ini?
                                                </h5>

                                                <p class="text-muted mt-2 mb-0">
                                                    Data testimoni yang dihapus tidak bisa dikembalikan.
                                                </p>

                                            </div>

                                            <div class="modal-footer">

                                                <button type="button"
                                                        class="btn btn-secondary"
                                                        data-bs-dismiss="modal">
                                                    Batal
                                                </button>

                                                <a href="testimoni_adm.php?hapus=<?= urlencode($row['idTestimoni']) ?>"
                                                   class="btn btn-danger">
                                                    Ya, Hapus
                                                </a>

                                            </div>

                                        </div>

                                    </div>

                                </div>

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

<script>
document.addEventListener('hidden.bs.modal', function () {
    document.querySelectorAll('.modal-backdrop').forEach(function (el) {
        el.remove();
    });

    document.body.classList.remove('modal-open');
    document.body.style.overflow = '';
    document.body.style.paddingRight = '';
});
</script>

<?php include 'footer_adm.php'; ?>