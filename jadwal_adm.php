<?php
include 'config.php';

$jadwalPesanan = $conn->query("
    SELECT 
        p.id,
        p.tanggalPesan,
        p.metodePembayaran,
        p.statusPesanan,
        p.jumlahPembayaran,
        pl.nama AS namaPelanggan,
        pk.namaPaket
    FROM pesanan p 
    LEFT JOIN pelanggan pl ON p.idPelanggan = pl.idPelanggan 
    LEFT JOIN paketpernikahan pk ON p.idPaket = pk.idPaket 
    ORDER BY STR_TO_DATE(p.tanggalPesan, '%Y-%m-%d') ASC
");

$events = [];
$agendaList = [];

include 'header_adm.php';
?>

<style>
    #calendar {
        background: #ffffff;
        border-radius: 18px;
        padding: 18px;
    }

    .fc .fc-toolbar-title {
        font-size: 28px;
        font-weight: 800;
        color: #0D0F28;
    }

    .fc .fc-button {
        border: none !important;
        border-radius: 10px !important;
        padding: 8px 14px !important;
        font-weight: 600 !important;
        box-shadow: none !important;
    }

    .fc .fc-button-primary {
        background: #0D0F28 !important;
        color: #ffffff !important;
    }

    .fc .fc-button-primary:not(:disabled):hover {
        background: #1f2937 !important;
    }

    .fc .fc-daygrid-day {
        transition: 0.2s ease;
    }

    .fc .fc-daygrid-day:hover {
        background: #f8fafc;
    }

    .fc .fc-day-today {
        background: #fff7ed !important;
    }

    .fc-event {
        border: none !important;
        border-radius: 10px !important;
        padding: 4px 7px !important;
        font-size: 13px !important;
        font-weight: 600 !important;
        cursor: pointer;
        box-shadow: 0 4px 10px rgba(15, 23, 42, 0.12);
    }

    .agenda-card {
        border: 1px solid #e5e7eb;
        border-radius: 16px;
        padding: 14px 16px;
        background: #ffffff;
        box-shadow: 0 4px 14px rgba(15, 23, 42, 0.05);
        margin-bottom: 12px;
    }

    .agenda-dot {
        width: 12px;
        height: 12px;
        border-radius: 50%;
        display: inline-block;
        margin-right: 8px;
    }

    
     @media (max-width: 768px) {

    .fc .fc-toolbar {
        flex-direction: column !important;
        align-items: flex-start !important;
        gap: 10px;
    }

    .fc .fc-toolbar-chunk {
        width: 100%;
        display: flex;
        flex-wrap: wrap;
        gap: 6px;
    }

    .fc .fc-toolbar-title {
        font-size: 22px !important;
        text-align: left !important;
        margin: 5px 0 !important;
    }

    .fc .fc-button {
        padding: 6px 10px !important;
        font-size: 12px !important;
    }

    #gotoDate {
        width: 100% !important;
    }

    .card-header .d-flex {
        flex-direction: column;
        align-items: stretch !important;
    }

    .card-header label {
        margin-bottom: 6px;
    }

    #calendar {
        padding: 10px;
        overflow-x: hidden;
    }

    .fc .fc-col-header-cell-cushion,
    .fc .fc-daygrid-day-number {
        font-size: 12px !important;
    }

    .fc-event {
        font-size: 10px !important;
        padding: 3px 5px !important;
        line-height: 1.2;
    }

    .agenda-card {
        margin-bottom: 15px;
    }

    .modal-dialog {
        margin: 10px;
    }
}
</style>

<section id="jadwal">

    <div class="card mb-4 shadow-sm border-0" style="border-radius: 22px; overflow: hidden;">

        <div class="card-header text-white py-4 px-4"
             style="background: #0D0F28; border: none;">

            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">

                <div>
                    <h4 class="mb-1 fw-bold">Kelola Jadwal Acara</h4>
                    <small class="opacity-75">Pantau jadwal acara pernikahan berdasarkan tanggal pesanan.</small>
                </div>

                <div class="d-flex align-items-center gap-2 flex-wrap">
                    <label for="gotoDate" class="text-white fw-semibold mb-0">
                        Lompat Tanggal
                    </label>

                    <input type="date"
                           id="gotoDate"
                           class="form-control"
                           style="width: 180px; border-radius: 12px;">
                </div>

            </div>

        </div>

        <div class="card-body bg-white p-4">

            <?php while ($j = $jadwalPesanan->fetch_assoc()): ?>

                <?php
                $daftarWarna = [
                    '#ef4444',
                    '#3b82f6',
                    '#22c55e',
                    '#f59e0b',
                    '#8b5cf6',
                    '#ec4899',
                    '#14b8a6',
                    '#f97316',
                    '#6366f1',
                    '#84cc16'
                ];

                $indexWarna = abs(crc32($j['namaPelanggan'])) % count($daftarWarna);
                $warna = $daftarWarna[$indexWarna];

                if (strtolower($j['statusPesanan'] ?? '') == 'selesai') { 
                    $status = 'Selesai';
                    $warna = '#16a34a';
                } elseif (strtolower($j['metodePembayaran'] ?? '') == 'dp') {
                    $status = 'DP';
                    $warna = '#f59e0b';
                } else { 
                    $status = 'Diproses';
                    $warna = '#2563eb';
                }

                $events[] = [
                    'title' => $j['namaPelanggan'] . " - " . $j['namaPaket'],
                    'start' => $j['tanggalPesan'],
                    'allDay' => true,
                    'backgroundColor' => $warna,
                    'borderColor' => $warna,
                    'extendedProps' => [
                        'id' => $j['id'],
                        'nama' => $j['namaPelanggan'],
                        'paket' => $j['namaPaket'],
                        'tanggal' => $j['tanggalPesan'],
                        'status' => $status,
                        'metode' => $j['metodePembayaran'],
                        'total' => number_format($j['jumlahPembayaran'], 0, ',', '.')
                    ]
                ];

                $agendaList[] = [
                    'tanggal' => $j['tanggalPesan'],
                    'nama' => $j['namaPelanggan'],
                    'paket' => $j['namaPaket'],
                    'warna' => $warna,
                    'status' => $status
                ];
                ?>

            <?php endwhile; ?>

            <div id="calendar"></div>

            <hr class="my-4">

            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="fw-bold mb-0">
                    <i class="bi bi-calendar-event me-2"></i>
                    Daftar Agenda Pernikahan
                </h5>
            </div>

            <div class="row">

                <?php foreach ($agendaList as $agenda): ?>

                    <div class="col-md-6 col-lg-4">
                        <div class="agenda-card">

                            <div class="d-flex justify-content-between align-items-center mb-2">

                                <div class="fw-bold text-dark">
                                    <span class="agenda-dot" style="background: <?= $agenda['warna'] ?>;"></span>
                                    <?= htmlspecialchars($agenda['nama']) ?>
                                </div>

                                <span class="badge text-white" style="background: <?= $agenda['warna'] ?>;">
                                    <?= htmlspecialchars($agenda['status']) ?>
                                </span>
                            </div>

                            <div class="text-muted small mb-1">
                                <i class="bi bi-calendar3 me-1"></i>
                                <?= date('d M Y', strtotime($agenda['tanggal'])) ?>
                            </div>

                            <div class="fw-semibold">
                                <?= htmlspecialchars($agenda['paket']) ?>
                            </div>

                        </div>
                    </div>

                <?php endforeach; ?>

            </div>

        </div>

    </div>

</section>

<div class="modal fade" id="detailModal" tabindex="-1">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content border-0 shadow" style="border-radius: 20px; overflow: hidden;">

            <div class="modal-header text-white" style="background: #0D0F28;">

                <h5 class="modal-title fw-bold">Detail Pesanan</h5>

                <button type="button"
                        class="btn-close btn-close-white"
                        data-bs-dismiss="modal">
                </button>

            </div>

            <div class="modal-body p-4">

                <div class="row g-3">

                    <div class="col-12">
                        <div class="border rounded-4 p-3 bg-light">
                            <small class="text-muted">Nama Pelanggan</small>
                            <div class="fw-bold" id="detailNama"></div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="border rounded-4 p-3 bg-light">
                            <small class="text-muted">ID Pesanan</small>
                            <div class="fw-bold" id="detailId"></div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="border rounded-4 p-3 bg-light">
                            <small class="text-muted">Paket Wedding</small>
                            <div class="fw-bold" id="detailPaket"></div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="border rounded-4 p-3 bg-light">
                            <small class="text-muted">Tanggal Acara</small>
                            <div class="fw-bold" id="detailTanggal"></div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="border rounded-4 p-3 bg-light">
                            <small class="text-muted">Metode Pembayaran</small>
                            <div class="fw-bold" id="detailMetode"></div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="border rounded-4 p-3 bg-light">
                            <small class="text-muted">Status Pesanan</small>
                            <div class="fw-bold" id="detailStatus"></div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="border rounded-4 p-3 bg-light">
                            <small class="text-muted">Total Pembayaran</small>
                            <div class="fw-bold text-success">
                                Rp <span id="detailTotal"></span>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js'></script>

<script>
document.addEventListener('DOMContentLoaded', function () {

    var calendarEl = document.getElementById('calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {

        initialView: 'dayGridMonth',
        locale: 'id',

        headerToolbar: window.innerWidth <= 768 ? {
            left: 'prev,next',
            center: 'title',
            right: 'today'
        } : {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay'
        },

        buttonText: {
            today: 'Hari ini',
            month: 'Bulan',
            week: 'Minggu',
            day: 'Hari'
        },

        themeSystem: 'bootstrap5',

        events: <?= json_encode($events) ?>,

        eventDisplay: 'block',
        dayMaxEvents: 3,

        editable: false,
        droppable: false,

        eventClick: function(info) {

            document.getElementById("detailId").innerText =
                info.event.extendedProps.id;

            document.getElementById("detailNama").innerText =
                info.event.extendedProps.nama;

            document.getElementById("detailPaket").innerText =
                info.event.extendedProps.paket;

            document.getElementById("detailTanggal").innerText =
                info.event.extendedProps.tanggal;

            document.getElementById("detailMetode").innerText =
                info.event.extendedProps.metode;

            document.getElementById("detailStatus").innerText =
                info.event.extendedProps.status;

            document.getElementById("detailTotal").innerText =
                info.event.extendedProps.total;

            var modal = new bootstrap.Modal(
                document.getElementById('detailModal')
            );

            modal.show();
        }

    });

    calendar.render();

    const inputTgl = document.getElementById('gotoDate');

    inputTgl.addEventListener('change', function() {
        const tanggalPilihan = this.value;

        if (tanggalPilihan) {
            calendar.gotoDate(tanggalPilihan);
        }
    });

});
</script>

<?php include 'footer_adm.php'; ?>