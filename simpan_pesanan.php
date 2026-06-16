<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
header('Content-Type: application/json; charset=utf-8');

// Koneksi database
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
    http_response_code(500);
    echo json_encode([
        'status' => 'error',
        'message' => 'Gagal koneksi: ' . $koneksi->connect_error
    ]);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode([
        'status' => 'error',
        'message' => 'Metode request tidak diizinkan'
    ]);
    exit;
}

// Ambil data utama
$idPelanggan = $_POST['idPelanggan'] ?? '';
$idPaket = $_POST['idPaket'] ?? '';
$tanggalPesan = $_POST['tanggalPesan'] ?? '';
$metodePembayaran = $_POST['metodePembayaran'] ?? '';
$jumlahPembayaran = $_POST['jumlahPembayaran'] ?? '';
$transactionId = $_POST['transactionId'] ?? null;
$statusPembayaran = $_POST['statusPembayaran'] ?? 'pending';

// Tanggal pembayaran otomatis
date_default_timezone_set('Asia/Jakarta');
$tanggalPembayaran = date('Y-m-d');

// Ambil data tambahan
$adat = $_POST['adat'] ?? 0;
$makeup = $_POST['makeup'] ?? 0;
$baju = $_POST['baju'] ?? 0;
$alatMakan = $_POST['alatMakan'] ?? 0;
$mc = $_POST['mc'] ?? 0;
$catering = $_POST['catering'] ?? 0;

$Tambahan = 
"adat: $adat,
Makeup: $makeup,
Baju: $baju,
Alat Makan: $alatMakan,
MC: $mc,
Catering: $catering";

if (
    empty($idPelanggan) ||
    empty($idPaket) ||
    empty($tanggalPesan) ||
    empty($metodePembayaran) ||
    empty($jumlahPembayaran)
) {
    http_response_code(400);
    echo json_encode([
        'status' => 'error',
        'message' => 'Data tidak lengkap'
    ]);
    exit;
}

try {

    $jumlahPembayaran = floatval($jumlahPembayaran);

    $sql = "INSERT INTO pesanan (
        idPelanggan,
        idPaket,
        tanggalPesan,
        metodePembayaran,
        jumlahPembayaran,
        transactionId,
        statusPembayaran,
        tanggalPembayaran,
        Tambahan
    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $koneksi->prepare($sql);

    if (!$stmt) {
        throw new Exception('Prepare gagal: ' . $koneksi->error);
    }

    $stmt->bind_param(
        "ssssdssss",
        $idPelanggan,
        $idPaket,
        $tanggalPesan,
        $metodePembayaran,
        $jumlahPembayaran,
        $transactionId,
        $statusPembayaran,
        $tanggalPembayaran,
        $Tambahan
    );

    if (!$stmt->execute()) {
        throw new Exception('Execute gagal: ' . $stmt->error);
    }

    echo json_encode([
        'status' => 'success',
        'message' => 'Data pesanan berhasil disimpan',
        'tanggalPembayaran' => $tanggalPembayaran
    ]);

} catch (Exception $e) {

    http_response_code(500);

    echo json_encode([
        'status' => 'error',
        'message' => $e->getMessage()
    ]);

} finally {

    if (isset($stmt)) {
        $stmt->close();
    }

    $koneksi->close();
}
?>