<?php
session_start();

$koneksi =$koneksi = new mysqli(
    getenv('DB_HOST') ?: 'localhost',
    getenv('DB_USERNAME') ?: 'root',
    getenv('DB_PASSWORD') ?: '',
    getenv('DB_DATABASE') ?: 'wo_web',
    (int) (getenv('DB_PORT') ?: 3306)
);

if ($koneksi->connect_error) {
    die("Koneksi database gagal: " . $koneksi->connect_error);
}
if ($koneksi->connect_errno) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}

$idPelanggan = $_SESSION['ses_id'] ?? '';

$query = "
    SELECT 
        p.*,
        pl.nama AS namaPelanggan,
        pk.namaPaket
    FROM pesanan p
    LEFT JOIN pelanggan pl 
        ON p.idPelanggan = pl.idPelanggan
    LEFT JOIN paketpernikahan pk 
        ON p.idPaket = pk.idPaket
    WHERE p.idPelanggan = '$idPelanggan'
    ORDER BY p.id DESC
";

$result = $koneksi->query($query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Keranjang Pemesanan</title>
    <link rel="icon" type="image/jpeg" href="assets/img/profile%20foto%20syf%20wedding%20planners.jpeg?v=99">
    <link rel="shortcut icon" type="image/jpeg" href="assets/img/profile%20foto%20syf%20wedding%20planners.jpeg?v=99">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <script type="text/javascript"
        src="https://app.midtrans.com/snap/snap.js"
        data-client-key="SB-Mid-client-BLUyugD7t0NiNWmy">
    </script>
</head>

<body class="bg-light">

<?php include 'header.php'; ?>

<div class="container py-5">
    <h2 class="mb-4">Keranjang Pemesanan Anda</h2>

    <?php if ($result && $result->num_rows > 0): ?>

        <div class="table-responsive">
                <table class="table table-bordered bg-white shadow-sm">
                    <thead class="table-dark">
                        <tr>
                            <th>ID Pesanan</th>
                            <th>Nama</th>
                            <th>Paket</th>
                            <th>Tanggal Acara</th>
                            <th>Metode</th>
                            <th>Status Pembayaran</th>
                            <th>Jumlah Dibayar</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                    <?php while($row = $result->fetch_assoc()): ?>

                        <tr>
                            <td><?= isset($row['id']) ? htmlspecialchars($row['id']) : '-' ?></td>

                            <td><?= isset($row['namaPelanggan']) ? htmlspecialchars($row['namaPelanggan']) : '-' ?></td>

                            <td><?= isset($row['namaPaket']) ? htmlspecialchars($row['namaPaket']) : '-' ?></td>

                            <td><?= isset($row['tanggalPesan']) ? htmlspecialchars($row['tanggalPesan']) : '-' ?></td>

                            <td><?= isset($row['metodePembayaran']) ? htmlspecialchars($row['metodePembayaran']) : '-' ?></td>

                            <td>
                                <?php
                                $jumlahDibayar = isset($row['jumlahPembayaran']) ? $row['jumlahPembayaran'] : 0;

                                if ($row['metodePembayaran'] == 'Lunas') {
                                    echo '<span class="badge bg-success">Lunas</span>';
                                } elseif ($row['metodePembayaran'] == 'DP') {
                                    echo '<span class="badge bg-warning text-dark">DP / Belum Lunas</span>';
                                } else {
                                    echo '<span class="badge bg-secondary">-</span>';
                                }
                                ?>
                            </td>

                            <td>Rp <?= number_format($jumlahDibayar, 0, ',', '.') ?></td>

                            <td>
                                <?php
                                if ($row['metodePembayaran'] == 'Lunas') {

                                    if ($row['statusPesanan'] == 'selesai') {
                                        echo '<span class="text-muted d-block mb-2">Pesanan Selesai</span>';
                                    } else {
                                        echo '<span class="text-primary d-block mb-2">Pesanan Diproses</span>';
                                    }

                                    echo '<a href="bukti_pembelian.php?id=' . $row['id'] . '" 
                                            target="_blank" 
                                            class="btn btn-success btn-sm">
                                            Download Bukti
                                        </a>';

                                } else {

                                    echo '<div class="text-success me-2">Menunggu Pembayaran</div>';

                                    echo '<form method="post" class="d-inline formPesanan">';

                                    echo '<input type="hidden" name="idPesanan" value="' . htmlspecialchars($row['id']) . '">';

                                    echo '<input type="hidden" name="jumlahPembayaran" value="' . htmlspecialchars($row['jumlahPembayaran']) . '">';

                                    echo '<button type="button" class="pay-button btn btn-sm btn-primary">
                                            Bayar Sisa Rp ' . number_format($row['jumlahPembayaran'], 0, ',', '.') . '
                                        </button>';

                                    echo '</form>';
                                }
                                ?>
                            </td>
                        </tr>

                    <?php endwhile; ?>
                    </tbody>
                </table>
        </div>

    <?php else: ?>

        <div class="alert alert-info">Belum ada pesanan.</div>

    <?php endif; ?>
</div>

<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="SB-Mid-client-BLUyugD7t0NiNWmy"></script>

<script>
const payButton = document.querySelectorAll('.pay-button');
const form = document.getElementsByClassName("formPesanan");

payButton.forEach((item, index) => {
    item.addEventListener("click", async () => {

        const formData = new FormData(form[index]);

        await fetch('checkout-process.php', {
            method: 'POST',
            body: formData
        })
        .then(async (response) => {
            const data = await response.json();

            snap.pay(data.token, {

                onSuccess: function(result) {

                    const formDataUpdate = new FormData();

                    formDataUpdate.append("id", formData.get('idPesanan'));
                    formDataUpdate.append("jumlahPembayaran", Number(formData.get('jumlahPembayaran')));

                    fetch('update_pesanan.php', {
                        method: 'POST',
                        body: formDataUpdate
                    })
                    .then(res => res.json())
                    .then(data => {
                        if (data.status === "success") {
                            alert(data.message);
                            window.location.href = "keranjang.php";
                        } else {
                            alert("Gagal menyimpan pesanan: " + data.message);
                        }
                    })
                    .catch(err => {
                        console.log("Error saat simpan:", err);
                        alert("Terjadi kesalahan saat menyimpan pesanan.");
                    });
                },

                onPending: function(result) {
                    console.log(result);
                },

                onError: function(result) {
                    console.log(result);
                }
            });
        })
        .catch(() => {
            alert("Terjadi kesalahan saat memproses pembayaran.");
        });
    });
});
</script>

<?php include 'footer.php'; ?>

</body>
</html>