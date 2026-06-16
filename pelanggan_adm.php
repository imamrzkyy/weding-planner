<?php
include 'config.php';

/* =========================
   HAPUS PELANGGAN
========================= */
if(isset($_GET['hapus'])){

    $id = $_GET['hapus'];

    $stmt = $conn->prepare("DELETE FROM pelanggan WHERE idPelanggan=?");
    $stmt->bind_param("s", $id);

    if($stmt->execute()){
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
if(isset($_POST['edit_pelanggan'])){

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

    $stmt->bind_param("ssssss", 
        $nama,
        $email,
        $alamat,
        $password,
        $noTelp,
        $id
    );

    if($stmt->execute()){
        echo "
        <script>
            alert('Data pelanggan berhasil diupdate');
            window.location='pelanggan_adm.php';
        </script>";
    }

    $stmt->close();
}

$pelanggan = $conn->query("SELECT * FROM pelanggan");

include 'header_adm.php';
?>

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

                    <?php while($pl = $pelanggan->fetch_assoc()): ?>

                        <tr>

                            <td><?= $pl['idPelanggan'] ?></td>
                            <td><?= $pl['nama'] ?></td>
                            <td><?= $pl['email'] ?></td>
                            <td><?= $pl['telepon'] ?></td>
                            <td><?= $pl['alamat'] ?></td>

                            <td>
                                <button 
                                    class="btn btn-warning btn-sm text-white"
                                    data-bs-toggle="modal"
                                    data-bs-target="#editModal<?= $pl['idPelanggan'] ?>">
                                    Edit
                                </button>

                                <a href="?hapus=<?= $pl['idPelanggan'] ?>"
                                   class="btn btn-danger btn-sm"
                                   onclick="return confirm('Yakin ingin menghapus pelanggan ini?')">
                                    Hapus
                                </a>
                            </td>

                        </tr>

                        <!-- MODAL EDIT -->
                        <div class="modal fade" 
                             id="editModal<?= $pl['idPelanggan'] ?>" 
                             tabindex="-1">

                            <div class="modal-dialog">

                                <div class="modal-content">

                                    <form method="POST">

                                        <div class="modal-header bg-maroon text-white">

                                            <h5 class="modal-title">
                                                Edit Pelanggan
                                            </h5>

                                            <button type="button" 
                                                    class="btn-close btn-close-white" 
                                                    data-bs-dismiss="modal">
                                            </button>

                                        </div>

                                        <div class="modal-body">

                                            <input type="hidden" 
                                                   name="idPelanggan"
                                                   value="<?= $pl['idPelanggan'] ?>">

                                            <div class="mb-3">
                                                <label>Nama</label>
                                                <input type="text"
                                                       name="nama"
                                                       class="form-control"
                                                       value="<?= $pl['nama'] ?>"
                                                       required>
                                            </div>

                                            <div class="mb-3">
                                                <label>Email</label>
                                                <input type="email"
                                                       name="email"
                                                       class="form-control"
                                                       value="<?= $pl['email'] ?>"
                                                       required>
                                            </div>

                                            <div class="mb-3">
                                                <label>Password</label>
                                                <input type="text"
                                                       name="password"
                                                       class="form-control"
                                                       value="<?= $pl['password'] ?>"
                                                       required>
                                            </div>

                                            <div class="mb-3">
                                                <label>No Telepon</label>
                                                <input type="text"
                                                       name="noTelp"
                                                       class="form-control"
                                                       value="<?= $pl['telepon'] ?>"
                                                       required>
                                            </div>

                                            <div class="mb-3">
                                                <label>Alamat</label>
                                                <textarea name="alamat"
                                                          class="form-control"
                                                          rows="3"
                                                          required><?= $pl['alamat'] ?></textarea>
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
                                                Simpan Perubahan
                                            </button>

                                        </div>

                                    </form>

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