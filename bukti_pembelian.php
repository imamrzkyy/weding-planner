<?php
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

if (!isset($_GET['id'])) {
    die("ID pesanan tidak ditemukan");
}

$id = (int) $_GET['id'];

$query = mysqli_query($koneksi, "
    SELECT 
        p.*,
        pl.nama AS namaPelanggan,
        pk.namaPaket
    FROM pesanan p
    LEFT JOIN pelanggan pl
        ON p.idPelanggan = pl.idPelanggan
    LEFT JOIN paketpernikahan pk
        ON p.idPaket = pk.idPaket
    WHERE p.id = '$id'
");

$data = mysqli_fetch_assoc($query);

if (!$data) {
    die("Data pesanan tidak ditemukan");
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Bukti Pembayaran</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>

        body{
            background:#f1f5f9;
            font-family: Arial, sans-serif;
        }

        .invoice-box{
            max-width:800px;
            margin:auto;
            background:#fff;
            border-radius:15px;
            overflow:hidden;
            box-shadow:0 5px 20px rgba(0,0,0,0.08);
        }

        .header{
            background: linear-gradient(135deg, #0f172a, #0D0F28);
            color:white;
            padding:30px;
            display:flex;
            justify-content:space-between;
            align-items:center;
        }

        .header h2{
            margin:0;
            font-weight:bold;
            font-size:40px;
        }

        .header p{
            margin:0;
            opacity:0.8;
            font-size:18px;
        }

        .logo-box{
            padding:10px;
            border-radius:12px;
        }

        .logo{
            width:90px;
            height:auto;
            object-fit:contain;
        }

        .content{
            padding:35px;
        }

        .info-box{
            display:flex;
            justify-content:space-between;
            margin-bottom:30px;
        }

        .info-box h5{
            font-weight:bold;
            margin-bottom:10px;
        }

        .table{
            margin-top:20px;
        }

        .table th{
            background:#f8fafc;
            width:35%;
        }

        .status{
            background:#16a34a;
            color:white;
            padding:7px 15px;
            border-radius:20px;
            font-size:13px;
            font-weight:bold;
        }

        .footer{
            margin-top:40px;
            text-align:center;
            color:#64748b;
            font-size:14px;
        }

        .btn-print{
            background:#1e293b;
            color:white;
            border:none;
            padding:12px 25px;
            border-radius:10px;
            font-weight:bold;
            margin-top:25px;
        }

        .btn-print:hover{
            background:#334155;
        }

        .watermark{
            position:absolute;
            opacity:0.03;
            font-size:100px;
            top:45%;
            left:50%;
            transform:translate(-50%, -50%);
            font-weight:bold;
        }

        @media print{

            body{
                background:white !important;
            }

            .btn-print{
                display:none;
            }

            .invoice-box{
                box-shadow:none;
                border:none;
            }

            .header{
                background:#1e293b !important;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }

            .status{
                background:#16a34a !important;
                color:white !important;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }

            .table th{
                background:#f8fafc !important;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }

            .logo-box{
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }

        }

    </style>
</head>
<body>

<div class="container py-5">

    <div class="invoice-box position-relative">

        <div class="watermark">
            PAID
        </div>

        <div class="header">

            <div>
                <h2>Bukti Pembayaran</h2>
                <p>SYF Wedding Planner</p>
            </div>

            <div class="logo-box">
                <img src="assets/img/profile foto syf wedding planners.jpeg" alt="Logo" class="logo">
            </div>

        </div>

        <div class="content">

            <div class="info-box">

                <div>
                    <h5>Pelanggan</h5>
                    <p><?= htmlspecialchars($data['namaPelanggan'] ?? '-'); ?></p>
                </div>

                <div class="text-end">
                    <h5>ID Pesanan</h5>
                    <p>#<?= htmlspecialchars($data['id']); ?></p>
                </div>

            </div>

            <table class="table table-bordered">

                <tr>
                    <th>Paket Wedding</th>
                    <td><?= htmlspecialchars($data['namaPaket'] ?? $data['idPaket']); ?></td>
                </tr>

                <tr>
                    <th>Tanggal Acara</th>
                    <td><?= htmlspecialchars($data['tanggalPesan']); ?></td>
                </tr>

                <tr>
                    <th>Metode Pembayaran</th>
                    <td><?= htmlspecialchars($data['metodePembayaran']); ?></td>
                </tr>

                <tr>
                    <th>Status Pembayaran</th>
                    <td>
                        <span class="status">
                            <?= htmlspecialchars($data['statusPembayaran'] ?? $data['metodePembayaran']); ?>
                        </span>
                    </td>
                </tr>

                <tr>
                    <th>Total Pembayaran</th>
                    <td>
                        <strong>
                            Rp <?= number_format($data['jumlahPembayaran'],0,',','.'); ?>
                        </strong>
                    </td>
                </tr>

            </table>

            <div class="footer">
                Terima kasih telah menggunakan layanan SYF Wedding Planner
            </div>

            <div class="text-center">
                <button onclick="window.print()" class="btn-print">
                    Cetak Bukti
                </button>
            </div>

        </div>

    </div>

</div>

</body>
</html>