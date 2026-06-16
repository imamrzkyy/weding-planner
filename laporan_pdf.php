<?php
require_once 'dompdf/dompdf/vendor/autoload.inc.php';

use Dompdf\Dompdf;

include 'config.php';

if (!isset($conn)) {
    die("Koneksi database tidak ditemukan!");
}

$bulan = isset($_GET['bulan']) ? $_GET['bulan'] : date('m');
$tahun = isset($_GET['tahun']) ? $_GET['tahun'] : date('Y');

$laporan = $conn->query("
    SELECT 
        p.id,
        pl.nama AS namaPelanggan,
        pk.namaPaket,
        p.jumlahPembayaran,
        p.statusPembayaran,
        p.tanggalPesan
    FROM pesanan p
    LEFT JOIN pelanggan pl 
        ON p.idPelanggan = pl.idPelanggan
    LEFT JOIN paketpernikahan pk 
        ON p.idPaket = pk.idPaket
    WHERE p.statusPembayaran IN ('Lunas', 'Sudah Bayar')
    AND MONTH(p.tanggalPesan) = '$bulan'
    AND YEAR(p.tanggalPesan) = '$tahun'
    ORDER BY p.tanggalPesan DESC
");

$total = 0;
$data = [];

if ($laporan && $laporan->num_rows > 0) {
    while ($row = $laporan->fetch_assoc()) {
        $total += $row['jumlahPembayaran'];
        $data[] = $row;
    }
}

$nama_bulan = date('F', mktime(0, 0, 0, $bulan, 1));

$html = '
<style>
body { font-family: sans-serif; }
h2 { text-align:center; }
table { border-collapse: collapse; width:100%; }
th, td { border:1px solid #000; padding:8px; font-size:12px; }
th { background:#f2f2f2; }
.total { font-weight:bold; }
</style>

<h2>Laporan Transaksi</h2>
<p>Bulan: '.$nama_bulan.' '.$tahun.'</p>

<table>
<tr>
    <th>ID</th>
    <th>Nama</th>
    <th>Paket</th>
    <th>Pembayaran</th>
    <th>Status</th>
    <th>Tanggal</th>
</tr>
';

if (count($data) > 0) {
    foreach ($data as $row) {
        $html .= '
        <tr>
            <td>'.$row['id'].'</td>
            <td>'.$row['namaPelanggan'].'</td>
            <td>'.$row['namaPaket'].'</td>
            <td>Rp '.number_format($row['jumlahPembayaran'], 0, ",", ".").'</td>
            <td>'.$row['statusPembayaran'].'</td>
            <td>'.date('d M Y', strtotime($row['tanggalPesan'])).'</td>
        </tr>';
    }

    $html .= '
    <tr class="total">
        <td colspan="3">TOTAL</td>
        <td colspan="3">Rp '.number_format($total, 0, ",", ".").'</td>
    </tr>';
} else {
    $html .= '<tr><td colspan="6">Tidak ada data</td></tr>';
}

$html .= '</table>';

$dompdf = new Dompdf();
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'landscape');
$dompdf->render();

$dompdf->stream("Laporan_Transaksi_$bulan-$tahun.pdf", ["Attachment" => true]);
?>