<?php
header('Content-Type: application/json; charset=utf-8');

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
    echo json_encode([
        'status' => 'error',
        'message' => 'Gagal koneksi'
    ]);
    exit;
}

$id = $_POST['id'] ?? '';
$jumlahBaru = $_POST['jumlahPembayaran'] ?? 0;

try {

    if (empty($id)) {
        throw new Exception("ID tidak ditemukan");
    }

    $statusPesanan = 'diproses';
    $statusPembayaran = 'Lunas';
    $metodePembayaran = 'Lunas';

    date_default_timezone_set('Asia/Jakarta');
    $tanggalPembayaran = date('Y-m-d');

    $sql = "UPDATE pesanan SET
            jumlahPembayaran = jumlahPembayaran + ?,
            statusPesanan = ?,
            statusPembayaran = ?,
            metodePembayaran = ?,
            tanggalPembayaran = ?
            WHERE id = ?";

    $stmt = $koneksi->prepare($sql);

    if (!$stmt) {
        throw new Exception($koneksi->error);
    }

    $jumlahBaru = (float)$jumlahBaru;
    $id = (int)$id;

    $stmt->bind_param(
        "dssssi",
        $jumlahBaru,
        $statusPesanan,
        $statusPembayaran,
        $metodePembayaran,
        $tanggalPembayaran,
        $id
    );

    if (!$stmt->execute()) {
        throw new Exception($stmt->error);
    }

    echo json_encode([
        'status' => 'success',
        'message' => 'Pembayaran berhasil'
    ]);

} catch (Exception $e) {

    echo json_encode([
        'status' => 'error',
        'message' => $e->getMessage()
    ]);

}
?>