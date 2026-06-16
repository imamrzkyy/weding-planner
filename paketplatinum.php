<?php
include 'header.php';
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Paket Platinum - Wedding Organizer</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    body {
      background: linear-gradient(to bottom right, #fffaf0, #f3c623);
      font-family: 'Segoe UI', sans-serif;
    }

    .back-btn {
      margin-top: 30px;
      display: inline-block;
      background-color: #4b0000;
      color: #fff;
      padding: 10px 20px;
      border-radius: 30px;
      text-decoration: none;
      transition: background-color 0.3s ease;
    }

    .back-btn:hover {
      background-color: #7b0000;
    }

    .detail-title {
      color: #4b0000;
      font-size: 2.5rem;
      font-weight: bold;
    }

    .price-tag {
      font-size: 1.8rem;
      color: #d90000;
      font-weight: bold;
      margin-top: 15px;
    }

    .package-img {
      width: 100%;
      max-height: 700px;
      object-fit: contain;
      object-position: center top;
      border-radius: 20px;
      padding: 10px;
      box-shadow: 0 6px 25px rgba(0, 0, 0, 0.15);
    }

    .package-features li {
      margin-bottom: 10px;
      font-size: 1.1rem;
      color: #4b0000;
    }

    .btn-cs {
      background-color: #4b0000;
      color: #fff;
      padding: 12px 24px;
      border-radius: 30px;
      font-size: 1.1rem;
      text-decoration: none;
      display: inline-block;
      margin-top: 20px;
      transition: background-color 0.3s ease;
    }

    .btn-cs:hover {
      background-color: #7b0000;
    }

    .carousel-inner {
      border-radius: 20px;
      overflow: hidden;
    }

    .carousel-control-prev-icon,
    .carousel-control-next-icon {
      background-color: rgba(0,0,0,0.5);
      border-radius: 50%;
      padding: 20px;
    }

    @media (max-width: 768px) {
      .package-img {
        height: 450px;
      }

      .detail-title {
        font-size: 2rem;
      }

      .col-md-6.d-flex {
        margin-top: 0 !important;
      }
    }
  </style>
</head>

<body>

<div class="container pt-md-4 pt-5 pb-5">

    <a href="pricelist.php" class="back-btn">
      ← Kembali ke Daftar Paket
    </a>

    <div class="row mt-4 align-items-center">

      <!-- Gambar Paket -->
      <div class="col-md-6 mb-4 mb-md-0">

        <div id="carouselPaketPlatinum" class="carousel slide" data-bs-ride="carousel">

          <div class="carousel-inner">

            <!-- Gambar 1 -->
            <div class="carousel-item active">
              <img src="assets/img/paket platinum.png"
                   class="d-block w-100 package-img"
                   alt="Paket platinum">
            </div>

            <!-- Gambar 2 -->
            <div class="carousel-item">
              <img src="assets/img/harga paket platinum.jpeg"
                   class="d-block w-100 package-img"
                   alt="Paket harga Platinum">
            </div>

          </div>

          <!-- Tombol kiri -->
          <button class="carousel-control-prev"
                  type="button"
                  data-bs-target="#carouselPaketPlatinum"
                  data-bs-slide="prev">

            <span class="carousel-control-prev-icon"></span>

          </button>

          <!-- Tombol kanan -->
          <button class="carousel-control-next"
                  type="button"
                  data-bs-target="#carouselPaketPlatinum"
                  data-bs-slide="next">

            <span class="carousel-control-next-icon"></span>

          </button>

        </div>

      </div>

      <!-- Detail Paket -->
      <div class="col-md-6 d-flex flex-column justify-content-center"
           style="min-height: 100%; margin-top: -140px;">

        <h1 class="detail-title">Paket Platinum</h1>

        <p class="text-muted">
        Paket Platinum merupakan paket wedding eksklusif dengan fasilitas paling lengkap, dekorasi mewah, dan pelayanan premium untuk acara pernikahan yang lebih berkesan.
        </p>

        <ul class="package-features">

        <li>✨ Dekorasi luxury + pelaminan premium ukuran besar</li>
        <li>🪑 Full cover tenda, karpet, meja & kursi tamu VIP</li>
        <li>💄 Makeup pengantin premium akad & resepsi lengkap</li>
        <li>👑 Hairdo/Hijabdo, busana keluarga & aksesoris lengkap</li>
        <li>📸 Dokumentasi foto, video cinematic & album eksklusif</li>
        <li>🎤 MC & Wedding Organizer profesional</li>
        <li>🌸 Welcome gate, standing bunga, gazebo & welcome mirror</li>
        <li>🍽️ Peralatan prasmanan lengkap + semi rolltop premium</li>
        <li>💌 Undangan digital + buku tamu premium</li>
        <li>🎁 Bonus henna, kuku palsu & softlens normal</li>
        <li>🕒 Maksimal acara hingga pukul 20.00 WIB</li>

        </ul>

        <div class="price-tag">
        Rp 30.000.000
        </div>

        <a href="https://wa.me/62895636125652"
           target="_blank"
           class="btn-cs">

          💬 Konsultasi via WhatsApp

        </a>

      </div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>