<?php
include 'config.php';

/* =========================
   HAPUS PELANGGAN
========================= */
if (isset($_POST['hapus_pelanggan'])) {

    $id = $_POST['idPelanggan'];

    $stmt = $conn->prepare("DELETE FROM pelanggan WHERE idPelanggan=?");
    $stmt->bind_param("s", $id);

    if ($stmt->execute()) {
        echo "
        <script>
            alert('Data pelanggan berhasil dihapus');
            window.location='pelanggan_adm.php';
        </script>";
    } else {
        echo "
        <script>
            alert('Data pelanggan gagal dihapus. Kemungkinan pelanggan masih memiliki pesanan.');
            window.location='pelanggan_adm.php';
        </script>";
    }

    $stmt->close();
}

/* =========================
   EDIT PELANGGAN
========================= */
if (isset($_POST['edit_pelanggan'])) {

    $id = $_POST['idPelanggan'];
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $alamat = $_POST['alamat'];
    $password = $_POST['password'];
    $noTelp = $_POST['noTelp'];

    $stmt = $conn->prepare("UPDATE pelanggan 
                            SET nama=?, 
                                email=?, 
                                alamat=?, 
                                password=?, 
                                telepon=? 
                            WHERE idPelanggan=?");

    $stmt->bind_param(
        "ssssss",
        $nama,
        $email,
        $alamat,
        $password,
        $noTelp,
        $id
    );

    if ($stmt->execute()) {
        echo "
        <script>
            alert('Data pelanggan berhasil diupdate');
            window.location='pelanggan_adm.php';
        </script>";
    } else {
        echo "
        <script>
            alert('Data pelanggan gagal diupdate');
            window.location='pelanggan_adm.php';
        </script>";
    }

    $stmt->close();
}

$pelanggan = $conn->query("SELECT * FROM pelanggan ORDER BY nama ASC");

include 'header_adm.php';
?>

<style>
    .aksi-btn {
        display: flex;
        flex-direction: column;
        gap: 8px;
        align-items: flex-start;
    }

    .aksi-btn .btn {
        width: 80px;
        height: 38px;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 0;
        font-weight: 600;
        border-radius: 8px;
    }

    .modal {
        z-index: 1060;
    }

    .modal-backdrop {
        z-index: 1050;
    }

    @media (max-width: 576px) {
        .modal-dialog {
            margin: 15px;
        }

        .aksi-btn {
            flex-direction: row;
        }
    }
</style>

<section id="pelanggan">

    <div class="card mb-4 shadow-sm border-0">

        <div class="card-header bg-maroon text-white fw-bold">
            Kelola Data Pelanggan
        </div>

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-bordered align-middle">

                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>No Telepon</th>
                            <th>Alamat</th>
                            <th width="180">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>

                        <?php while ($pl = $pelanggan->fetch_assoc()): ?>

                            <tr>
                                <td><?= htmlspecialchars($pl['idPelanggan']) ?></td>
                                <td><?= htmlspecialchars($pl['nama']) ?></td>
                                <td><?= htmlspecialchars($pl['email']) ?></td>
                                <td><?= htmlspecialchars($pl['telepon']) ?></td>
                                <td><?= htmlspecialchars($pl['alamat']) ?></td>

                                <td>
                                    <div class="aksi-btn">

                                        <button
                                            type="button"
                                            class="btn btn-warning btn-sm text-white"
                                            data-bs-toggle="modal"
                                            data-bs-target="#editModal<?= htmlspecialchars($pl['idPelanggan']) ?>">
                                            Edit
                                        </button>

                                        <button
                                            type="button"
                                            class="btn btn-danger btn-sm"
                                            data-bs-toggle="modal"
                                            data-bs-target="#hapusModal<?= htmlspecialchars($pl['idPelanggan']) ?>">
                                            Hapus
                                        </button>

                                    </div>
                                </td>
                            </tr>

                        <?php endwhile; ?>

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</section>

<?php
$pelanggan_modal = $conn->query("SELECT * FROM pelanggan ORDER BY nama ASC");
while ($pl = $pelanggan_modal->fetch_assoc()):
?>

    <!-- MODAL EDIT -->
    <div class="modal fade"
         id="editModal<?= htmlspecialchars($pl['idPelanggan']) ?>"
         tabindex="-1"
         aria-hidden="true">

        <div class="modal-dialog modal-dialog-centered">

            <div class="modal-content">

                <form method="POST">

                    <div class="modal-header bg-maroon text-white">

                        <h5 class="modal-title">
                            Edit Pelanggan
                        </h5>

                        <button type="button"
                                class="btn-close btn-close-white"
                                data-bs-dismiss="modal"
                                aria-label="Close">
                        </button>

                    </div>

                    <div class="modal-body">

                        <input type="hidden"
                               name="idPelanggan"
                               value="<?= htmlspecialchars($pl['idPelanggan']) ?>">

                        <input type="hidden"
                               name="password"
                               value="<?= htmlspecialchars($pl['password']) ?>">

                        <div class="mb-3">
                            <label class="form-label">Nama</label>
                            <input type="text"
                                   name="nama"
                                   class="form-control"
                                   value="<?= htmlspecialchars($pl['nama']) ?>"
                                   required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email"
                                   name="email"
                                   class="form-control"
                                   value="<?= htmlspecialchars($pl['email']) ?>"
                                   required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">No Telepon</label>
                            <input type="text"
                                   name="noTelp"
                                   class="form-control"
                                   value="<?= htmlspecialchars($pl['telepon']) ?>"
                                   required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Alamat</label>
                            <textarea name="alamat"
                                      class="form-control"
                                      rows="3"
                                      required><?= htmlspecialchars($pl['alamat']) ?></textarea>
                        </div>

                    </div>

                    <div class="modal-footer">

                        <button type="button"
                                class="btn btn-secondary"
                                data-bs-dismiss="modal">
                            Batal
                        </button>

                        <button type="submit"
                                name="edit_pelanggan"
                                class="btn btn-success">
                            Simpan
                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

    <!-- MODAL HAPUS -->
    <div class="modal fade"
         id="hapusModal<?= htmlspecialchars($pl['idPelanggan']) ?>"
         tabindex="-1"
         aria-hidden="true">

        <div class="modal-dialog modal-dialog-centered">

            <div class="modal-content">

                <form method="POST">

                    <div class="modal-header bg-danger text-white">

                        <h5 class="modal-title">
                            Hapus Pelanggan
                        </h5>

                        <button type="button"
                                class="btn-close btn-close-white"
                                data-bs-dismiss="modal"
                                aria-label="Close">
                        </button>

                    </div>

                    <div class="modal-body">

                        <input type="hidden"
                               name="idPelanggan"
                               value="<?= htmlspecialchars($pl['idPelanggan']) ?>">

                        <p class="mb-1">
                            Yakin ingin menghapus pelanggan ini?
                        </p>

                        <strong><?= htmlspecialchars($pl['nama']) ?></strong>

                    </div>

                    <div class="modal-footer">

                        <button type="button"
                                class="btn btn-secondary"
                                data-bs-dismiss="modal">
                            Batal
                        </button>

                        <button type="submit"
                                name="hapus_pelanggan"
                                class="btn btn-danger">
                            Hapus
                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

<?php endwhile; ?>

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