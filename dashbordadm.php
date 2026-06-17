<?php
include 'config.php';

$tahun_awal = $_GET['tahun_awal'] ?? (date('Y') - 3);
$tahun_akhir = $_GET['tahun_akhir'] ?? date('Y');

if ($tahun_awal > $tahun_akhir) {
    $temp = $tahun_awal;
    $tahun_awal = $tahun_akhir;
    $tahun_akhir = $temp;
}

$jumlah_tahun = ($tahun_akhir - $tahun_awal) + 1;

$query_paket = $conn->query("SELECT * FROM paketpernikahan");
$query_pelanggan = $conn->query("SELECT * FROM pelanggan");

$query_pesanan = $conn->query("
    SELECT *
    FROM pesanan
    WHERE YEAR(tanggalPesan) BETWEEN '$tahun_awal' AND '$tahun_akhir'
");

$total_paket = ($query_paket) ? $query_paket->num_rows : 0;
$total_pelanggan = ($query_pelanggan) ? $query_pelanggan->num_rows : 0;
$total_pesanan = ($query_pesanan) ? $query_pesanan->num_rows : 0;

$nama_bulan = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Ags', 'Sep', 'Okt', 'Nov', 'Des'];

$chartTahunan = [];
$totalTahunan = [];
$detailTahunan = [];

for ($tahunLoop = $tahun_awal; $tahunLoop <= $tahun_akhir; $tahunLoop++) {
    $dataBulanan = [];
    $detailBulanan = [];
    $totalPerTahun = 0;

    for ($bulan = 1; $bulan <= 12; $bulan++) {
        $query_chart = $conn->query("
            SELECT 
                p.*,
                pl.nama AS namaPelanggan
            FROM pesanan p
            LEFT JOIN pelanggan pl
                ON p.idPelanggan = pl.idPelanggan
            WHERE MONTH(p.tanggalPesan) = '$bulan'
            AND YEAR(p.tanggalPesan) = '$tahunLoop'
        ");

        $jumlahBulan = $query_chart->num_rows;
        $dataBulanan[] = $jumlahBulan;
        $totalPerTahun += $jumlahBulan;

        $detail = [];
        while ($row = $query_chart->fetch_assoc()) {
            $detail[] = [
                'nama' => $row['namaPelanggan'] ?? '-',
                'tanggal' => $row['tanggalPesan']
            ];
        }

        $detailBulanan[] = $detail;
    }

    $chartTahunan[$tahunLoop] = $dataBulanan;
    $totalTahunan[$tahunLoop] = $totalPerTahun;
    $detailTahunan[$tahunLoop] = $detailBulanan;
}

$queryPaket = $conn->query("
    SELECT 
        pk.namaPaket,
        COUNT(p.idPaket) AS total
    FROM paketpernikahan pk
    LEFT JOIN pesanan p
        ON pk.idPaket = p.idPaket
        AND YEAR(p.tanggalPesan) BETWEEN '$tahun_awal' AND '$tahun_akhir'
    GROUP BY pk.idPaket, pk.namaPaket
");

$paketLabels = [];
$paketData = [];

while ($row = $queryPaket->fetch_assoc()) {
    $paketLabels[] = $row['namaPaket'];
    $paketData[] = $row['total'];
}

$queryMetode = $conn->query("
    SELECT 
        metodePembayaran,
        COUNT(*) AS total
    FROM pesanan
    WHERE YEAR(tanggalPesan) BETWEEN '$tahun_awal' AND '$tahun_akhir'
    AND metodePembayaran IN ('dp', 'lunas', 'DP', 'Lunas')
    GROUP BY metodePembayaran
");

$metodeLabels = [];
$metodeData = [];

while ($row = $queryMetode->fetch_assoc()) {
    $metodeLabels[] = strtoupper($row['metodePembayaran']);
    $metodeData[] = $row['total'];
}

$ringkasanUmumLabels = array_merge(
    ['Total Pesanan', 'Pengguna Terdaftar'],
    $metodeLabels
);

$ringkasanUmumData = array_merge(
    [$total_pesanan, $total_pelanggan],
    $metodeData
);

$ringkasanPaketLabels = $paketLabels;
$ringkasanPaketData = $paketData;

include 'header_adm.php';
?>

<style>
.dashboard-card {
    border-radius: 20px;
}

.chart-box {
    min-height: 320px;
}

.chart-wrapper {
    position: relative;
    width: 100%;
    height: 250px;
}

.ringkasan-chart {
    max-width: 280px;
    height: 280px;
    margin: 0 auto 25px auto;
}

@media (max-width: 768px) {
    .dashboard-header {
        flex-direction: column !important;
        align-items: flex-start !important;
        gap: 15px;
    }

    .dashboard-header .btn {
        width: 100%;
    }

    .filter-header {
        flex-direction: column !important;
        align-items: flex-start !important;
        gap: 15px;
    }

    .filter-tahun {
        flex-direction: column !important;
        align-items: stretch !important;
        width: 100%;
    }

    .filter-tahun select {
        width: 100%;
    }

    .filter-tahun span {
        text-align: center;
    }

    .stat-card {
        text-align: center;
        padding: 20px !important;
    }

    .stat-card h2 {
        font-size: 28px;
    }

    .card-body {
        padding: 18px !important;
    }

    h2 {
        font-size: 24px;
    }

    h5 {
        font-size: 18px;
    }

    .chart-box {
        min-height: 300px;
    }

    .chart-wrapper {
        height: 220px;
    }

    .ringkasan-chart {
        max-width: 230px;
        height: 230px;
    }

    canvas {
        max-width: 100% !important;
    }
}
</style>

<div class="container-fluid">

    <div class="row mb-4">
        <div class="col-12">
            <div class="p-4 text-white rounded shadow-sm"
                 style="background: linear-gradient(135deg, #0D0F28 0%, #0D0F28 100%);">

                <div class="d-flex justify-content-between align-items-center dashboard-header">
                    <div>
                        <h2 class="fw-bold mb-1">Dashboard WO</h2>
                        <p class="mb-0 opacity-75">
                            Selamat Datang, Admin! Berikut ringkasan bisnis Anda hari ini.
                        </p>
                    </div>

                    <a href="pesanan_adm.php" class="btn btn-light fw-bold px-4 shadow-sm">
                        Lihat Pesanan Baru
                    </a>
                </div>

            </div>
        </div>
    </div>

    <div class="row g-4 mb-4">

        <div class="col-lg-4 col-md-6 col-12">
            <div class="card border-0 shadow-sm p-4 h-100 text-white stat-card dashboard-card"
                style="background:linear-gradient(135deg,#4F46E5,#6366F1);">
                <p class="mb-1 small fw-bold">PAKET</p>
                <h2 class="fw-bold mb-0"><?= $total_paket ?></h2>
            </div>
        </div>

        <div class="col-lg-4 col-md-6 col-12">
            <div class="card border-0 shadow-sm p-4 h-100 text-white stat-card dashboard-card"
                style="background: linear-gradient(135deg,#F59E0B,#FBBF24);">
                <p class="mb-1 small fw-bold">PESANAN</p>
                <h2 class="fw-bold mb-0"><?= $total_pesanan ?></h2>
            </div>
        </div>

        <div class="col-lg-4 col-md-12 col-12">
            <div class="card border-0 shadow-sm p-4 h-100 text-white stat-card dashboard-card"
                style="background: linear-gradient(135deg,#8B5CF6,#A78BFA);">
                <p class="mb-1 small fw-bold">PELANGGAN</p>
                <h2 class="fw-bold mb-0"><?= $total_pelanggan ?></h2>
            </div>
        </div>

    </div>

    <div class="row align-items-start">

        <div class="col-lg-8 col-md-12 mb-4">
            <div class="card border-0 shadow-sm h-100 dashboard-card">
                <div class="card-body p-4">

                    <div class="d-flex justify-content-between align-items-center mb-4 filter-header">
                        <h5 class="fw-bold mb-0">Statistik Pesanan Per Tahun</h5>

                        <form method="GET" class="d-flex gap-2 align-items-center filter-tahun">
                            <select name="tahun_awal" class="form-select" onchange="this.form.submit()">
                                <?php for($t = date('Y'); $t >= 2020; $t--){ ?>
                                    <option value="<?= $t ?>" <?= ($tahun_awal == $t) ? 'selected' : '' ?>>
                                        <?= $t ?>
                                    </option>
                                <?php } ?>
                            </select>

                            <span>s/d</span>

                            <select name="tahun_akhir" class="form-select" onchange="this.form.submit()">
                                <?php for($t = date('Y'); $t >= 2020; $t--){ ?>
                                    <option value="<?= $t ?>" <?= ($tahun_akhir == $t) ? 'selected' : '' ?>>
                                        <?= $t ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </form>
                    </div>

                    <div class="row g-3">

                        <?php
                        $colChart = 'col-md-6 col-12';

                        if ($jumlah_tahun == 1) {
                            $colChart = 'col-12';
                        }

                        if ($jumlah_tahun >= 9) {
                            $colChart = 'col-lg-4 col-md-6 col-12';
                        }

                        if ($jumlah_tahun >= 12) {
                            $colChart = 'col-lg-3 col-md-6 col-12';
                        }
                        ?>

                        <?php for ($tahunLoop = $tahun_awal; $tahunLoop <= $tahun_akhir; $tahunLoop++) { ?>

                            <div class="<?= $colChart ?>">
                                <div class="border rounded-4 p-3 h-100 shadow-sm bg-white chart-box">

                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <h6 class="fw-bold mb-0">
                                            Tahun <?= $tahunLoop ?>
                                        </h6>

                                        <span class="badge bg-primary px-3 py-2">
                                            <?= $totalTahunan[$tahunLoop] ?> Pesanan
                                        </span>
                                    </div>

                                    <div class="chart-wrapper">
                                        <canvas id="pesananChart<?= $tahunLoop ?>"></canvas>
                                    </div>

                                </div>
                            </div>

                        <?php } ?>

                    </div>

                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-12 mb-4">
            <div class="card border-0 shadow-sm h-100 dashboard-card">
                <div class="card-body p-4">

                    <h5 class="fw-bold mb-4">Ringkasan Sistem</h5>

                    <p class="fw-bold mb-2">Pesanan, Pengguna & Metode</p>
                    <div class="ringkasan-chart">
                        <canvas id="ringkasanUmumChart"></canvas>
                    </div>

                    <hr>

                    <p class="fw-bold mb-2">Paket Paling Banyak Dipesan</p>
                    <div class="ringkasan-chart">
                        <canvas id="ringkasanPaketChart"></canvas>
                    </div>

                    <div class="mt-4">
                        <small class="text-muted d-block">
                            Chart pertama menampilkan total pesanan, pengguna terdaftar, dan metode pembayaran. Chart kedua menampilkan paket yang paling banyak dipesan.
                        </small>
                    </div>

                </div>
            </div>
        </div>

    </div>

</div>

<div class="modal fade" id="detailModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Detail Pemesan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body" id="detailIsi"></div>

        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
const namaBulan = <?= json_encode($nama_bulan) ?>;
const chartTahunan = <?= json_encode($chartTahunan) ?>;
const detailTahunan = <?= json_encode($detailTahunan) ?>;

Object.keys(chartTahunan).forEach(tahun => {

    const ctx = document.getElementById('pesananChart' + tahun);

    new Chart(ctx, {
        type: 'bar',

        data: {
            labels: namaBulan,
            datasets: [{
                label: 'Pesanan',
                data: chartTahunan[tahun],
                backgroundColor: '#0D0F28',
                borderRadius: 6
            }]
        },

        options: {
            responsive: true,
            maintainAspectRatio: false,

            onClick: (e, elements) => {
                if(elements.length > 0){

                    const index = elements[0].index;
                    let html = `<h6 class="fw-bold mb-3">Detail Pesanan ${namaBulan[index]} ${tahun}</h6>`;

                    if(detailTahunan[tahun][index].length > 0){

                        detailTahunan[tahun][index].forEach(item => {
                            html += `
                                <div class="border rounded p-2 mb-2">
                                    <strong>${item.nama}</strong><br>
                                    <small>${item.tanggal}</small>
                                </div>
                            `;
                        });

                    } else {
                        html += '<p>Tidak ada pesanan.</p>';
                    }

                    document.getElementById('detailIsi').innerHTML = html;

                    const modal = new bootstrap.Modal(
                        document.getElementById('detailModal')
                    );

                    modal.show();
                }
            },

            plugins: {
                legend: {
                    display: false
                }
            },

            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        precision: 0
                    }
                }
            }
        }
    });

});

const ringkasanUmum = document.getElementById('ringkasanUmumChart');

new Chart(ringkasanUmum, {
    type: 'doughnut',

    data: {
        labels: <?= json_encode($ringkasanUmumLabels) ?>,

        datasets: [{
            data: <?= json_encode($ringkasanUmumData) ?>,

            backgroundColor: [
                '#0D0F28',
                '#3b82f6',
                '#f59e0b',
                '#10b981',
                '#ef4444'
            ]
        }]
    },

    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                position: 'bottom'
            }
        }
    }
});

const ringkasanPaket = document.getElementById('ringkasanPaketChart');

new Chart(ringkasanPaket, {
    type: 'doughnut',

    data: {
        labels: <?= json_encode($ringkasanPaketLabels) ?>,

        datasets: [{
            data: <?= json_encode($ringkasanPaketData) ?>,

            backgroundColor: [
                '#0D0F28',
                '#3b82f6',
                '#f59e0b',
                '#10b981',
                '#ef4444',
                '#8b5cf6',
                '#ec4899'
            ]
        }]
    },

    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                position: 'bottom'
            }
        }
    }
});
</script>

<?php include 'footer_adm.php'; ?>