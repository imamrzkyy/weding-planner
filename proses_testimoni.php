<?php
session_start();
include 'config.php';

if (!isset($_SESSION['ses_id']) || ($_SESSION['ses_level'] ?? '') != 'user') {
    echo "<script>
        alert('Silakan login terlebih dahulu untuk menulis testimoni.');
        window.location='login.php';
    </script>";
    exit;
}

if (empty($_POST['isiTestimoni'])) {
    echo "<script>
        alert('Isi testimoni tidak boleh kosong.');
        window.location='index.php#testimoni';
    </script>";
    exit;
}

$idPelanggan = $_SESSION['ses_id'];
$isiTestimoni = mysqli_real_escape_string($conn, trim($_POST['isiTestimoni']));
$tanggal = date('Y-m-d');

/* Membuat ID Testimoni otomatis: TST001, TST002, TST003, dst */
$queryId = mysqli_query($conn, "
    SELECT MAX(CAST(SUBSTRING(idTestimoni, 4) AS UNSIGNED)) AS nomor
    FROM testimoni
    WHERE idTestimoni LIKE 'TST%'
");

$dataId = mysqli_fetch_assoc($queryId);
$nomorTerakhir = $dataId['nomor'] ?? 0;
$nomorBaru = $nomorTerakhir + 1;

$idTestimoni = "TST" . str_pad($nomorBaru, 3, "0", STR_PAD_LEFT);

$sql = "INSERT INTO testimoni (
            idTestimoni,
            idPelanggan,
            isiTestimoni,
            tanggalTestimoni
        ) VALUES (
            '$idTestimoni',
            '$idPelanggan',
            '$isiTestimoni',
            '$tanggal'
        )";

if (mysqli_query($conn, $sql)) {
    echo "<script>
          alert('Testimoni berhasil dikirim.');
          window.location='index.php#testimoni';
        </script>";
} else {
    echo "<script>
        alert('Gagal mengirim testimoni.');
        window.location='index.php#testimoni';
    </script>";
}

mysqli_close($conn);
exit;
?>