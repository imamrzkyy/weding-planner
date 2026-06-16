<?php
include 'config.php';
include 'header.php';

if (isset($_GET['id'])) {
    $id = $conn->real_escape_string($_GET['id']);

    $paket = $conn->query("SELECT * FROM paketpernikahan WHERE idPaket = '$id'")->fetch_assoc();

    if (!$paket) {
        echo "<script>alert('Paket tidak ditemukan'); window.location='pricelist.php';</script>";
        exit;
    }
} else {
    echo "<script>alert('ID paket tidak diberikan'); window.location='pricelist.php';</script>";
    exit;
}

$fotoDetail = $conn->query("SELECT * FROM paket_gambar_detail WHERE idPaket = '$id'");

$deskripsiSingkat = trim($paket['deskripsi'] ?? '');
$deskripsiLengkap = trim($paket['deskripsi_lengkap'] ?? '');

if (empty($deskripsiLengkap)) {
    $deskripsiLengkap = $deskripsiSingkat;
}

$items = preg_split("/\r\n|\n|\r/", $deskripsiLengkap);
$pesanWA = "Halo SYF Wedding Planner, saya ingin konsultasi mengenai " . $paket['namaPaket'];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($paket['namaPaket']) ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(to right, #fff8dc 0%, #f3c623 100%);
            font-family: 'Segoe UI', sans-serif;
            color: #0D0F2B;
        }

        .detail-wrapper {
            padding: 60px 0;
            min-height: 100vh;
        }

        .btn-back {
            background: #660000;
            color: white;
            border-radius: 25px;
            padding: 10px 25px;
            text-decoration: none;
            display: inline-block;
            margin-bottom: 35px;
            font-weight: 600;
        }

        .btn-back:hover {
            background: #0D0F2B;
            color: white;
        }

        .detail-layout {
            align-items: flex-start;
        }

        .carousel-box {
            border-radius: 20px;
            overflow: hidden;
            background: transparent;
            box-shadow: none;
        }

        .carousel-img {
            width: 100%;
            max-height: 620px;
            object-fit: contain;
            border-radius: 20px;
            background: none;
        }

        .info-paket {
            background: rgba(255,255,255,0.78);
            backdrop-filter: blur(10px);
            padding: 32px;
            border-radius: 26px;
            box-shadow: 0 12px 30px rgba(0,0,0,.12);
        }

        .paket-title {
            font-size: 4rem;
            font-weight: 900;
            color: #0D0F2B;
        }

        .price-tag {
            font-size: 3rem;
            font-weight: 900;
            color: #b30000;
            margin-bottom: 15px;
        }

        .deskripsi-singkat {
            font-size: 1.15rem;
            color: #333;
            line-height: 1.8;
            margin-bottom: 25px;
        }

        .facility-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: #0D0F2B;
            margin-bottom: 18px;
        }

        .facility-list {
            list-style: none;
            padding-left: 0;
            margin-bottom: 15px;
            columns: 2;
            column-gap: 35px;
        }

        .facility-list li {
            font-size: 0.95rem;
            margin-bottom: 10px;
            color: #333;
            line-height: 1.45;
            break-inside: avoid;
        }

        .section-title{
            font-weight: 800 !important;
            font-size: 1.15rem !important;
            color: #0D0F2B !important;
            margin-top: 18px;
            margin-bottom: 8px;
            break-inside: avoid;
        }

        .section-title::before{
            content: "";
            margin-right: 6px;
        }

        .facility-list li:not(.section-title)::before{
            content: "✓";
            color: #28a745;
            font-weight: bold;
            margin-right: 10px;
        }

        .facility-list.collapsed li:nth-child(n+7) {
            display: none;
        }

        .btn-more {
            border: none;
            background: transparent;
            color: #0D0F2B;
            font-weight: 700;
            text-decoration: underline;
            margin-bottom: 25px;
            padding: 0;
        }

        .btn-wa {
            background: #25D366;
            color: white;
            padding: 15px 35px;
            border-radius: 50px;
            font-size: 18px;
            font-weight: 700;
            box-shadow: 0 8px 20px rgba(37,211,102,.3);
            display: inline-block;
            text-decoration: none;
        }

        .btn-wa:hover {
            background: #1da851;
            color: white;
        }

        @media (max-width: 768px) {
            .carousel-img {
                max-height: 420px;
            }

            .paket-title {
                font-size: 2.2rem;
                margin-top: 25px;
            }

            .price-tag {
                font-size: 2rem;
            }

            .info-paket {
                padding: 25px;
            }

            .facility-list {
                columns: 1;
            }
        }
    </style>
</head>

<body>

<section class="detail-wrapper">
    <div class="container">

        <a href="pricelist.php" class="btn-back">
            ← Kembali ke Daftar Paket
        </a>

        <div class="row detail-layout g-5">

            <div class="col-md-6">
                <div id="carouselDetailPaket" class="carousel slide carousel-box" data-bs-ride="carousel">

                    <div class="carousel-inner">

                        <?php if ($fotoDetail && $fotoDetail->num_rows > 0): ?>
                            <?php $no = 0; ?>
                            <?php while($foto = $fotoDetail->fetch_assoc()): ?>
                                <div class="carousel-item <?= $no == 0 ? 'active' : '' ?>">
                                    <img src="assets/img/paket/detail/<?= htmlspecialchars($foto['gambar']) ?>"
                                         class="carousel-img"
                                         alt="Foto Detail Paket">
                                </div>
                                <?php $no++; ?>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <div class="carousel-item active">
                                <?php if (!empty($paket['gambar'])): ?>
                                    <img src="assets/img/paket/<?= htmlspecialchars($paket['gambar']) ?>"
                                         class="carousel-img"
                                         alt="<?= htmlspecialchars($paket['namaPaket']) ?>">
                                <?php else: ?>
                                    <img src="assets/img/paket/default.png"
                                         class="carousel-img"
                                         alt="Default Paket">
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>

                    </div>

                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselDetailPaket" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon"></span>
                    </button>

                    <button class="carousel-control-next" type="button" data-bs-target="#carouselDetailPaket" data-bs-slide="next">
                        <span class="carousel-control-next-icon"></span>
                    </button>

                </div>
            </div>

            <div class="col-md-6">
                <div class="info-paket">

                    <h1 class="paket-title">
                        <?= htmlspecialchars($paket['namaPaket']) ?>
                    </h1>

                    <div class="price-tag">
                        Rp <?= number_format($paket['harga'], 0, ',', '.') ?>
                    </div>

                    <?php if (!empty($deskripsiSingkat)): ?>
                        <p class="deskripsi-singkat">
                            <?= nl2br(htmlspecialchars($deskripsiSingkat)) ?>
                        </p>
                    <?php endif; ?>

                    <a href="https://wa.me/6285704019914?text=<?= urlencode($pesanWA) ?>"
                       target="_blank"
                       class="btn-wa">
                        Konsultasi via WhatsApp
                    </a>

                    <hr class="my-4">

                    <h4 class="facility-title">
                        Isi Paket
                    </h4>

                    <?php if (!empty($deskripsiLengkap)): ?>
                        <ul class="facility-list collapsed" id="facilityList">
                            <?php foreach($items as $item): ?>
                              <?php
                                $item = trim($item);

                                if ($item == '') continue;

                                $judul = strtoupper($item);

                                if (
                                    str_contains($judul, 'DEKORASI') ||
                                    str_contains($judul, 'MUA') ||
                                    str_contains($judul, 'BONUS') ||
                                    str_contains($judul, 'DOKUMENTASI') ||
                                    str_contains($judul, 'FREE')
                                ){
                                ?>
                                    <li class="section-title">
                                         <?= htmlspecialchars($item) ?>
                                    </li>

                                <?php } else { ?>

                                    <li>
                                         <?= htmlspecialchars(str_replace(['✨','•','-'], '', $item)) ?>
                                    </li>

                                <?php } ?>

                                <?php endforeach; ?>
                        </ul>

                        <?php if (count(array_filter($items)) > 6): ?>
                            <button type="button" class="btn-more" id="btnMore">
                                Tampilkan Lebih Banyak
                            </button>
                        <?php endif; ?>
                    <?php else: ?>
                        <p class="text-muted">
                            Isi paket belum tersedia.
                        </p>
                    <?php endif; ?>

                </div>
            </div>

        </div>

    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
const btnMore = document.getElementById("btnMore");
const facilityList = document.getElementById("facilityList");

if (btnMore && facilityList) {
    btnMore.addEventListener("click", function () {
        facilityList.classList.toggle("collapsed");

        if (facilityList.classList.contains("collapsed")) {
            btnMore.textContent = "Tampilkan Lebih Banyak";
        } else {
            btnMore.textContent = "Tampilkan Lebih Sedikit";
        }
    });
}
</script>

<?php include 'footer.php'; ?>

</body>
</html>