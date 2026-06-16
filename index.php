<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
    include 'config.php';
    
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Wedding Planner</title>
    <link rel="icon" type="image/jpeg" href="assets/img/profile%20foto%20syf%20wedding%20planners.jpeg?v=99">
    <link rel="shortcut icon" type="image/jpeg" href="assets/img/profile%20foto%20syf%20wedding%20planners.jpeg?v=99">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
    body {
        font-family: 'Poppins', sans-serif;
        margin: 0;
        padding: 65px 0 150px 0;
    }

    /* Hero Section */
    .hero {
        background-image: url('assets/img/bg_login.jpg');
        /* Ganti dengan background emas kamu */
        background-size: auto;
        background-position: center;
        padding: 150px 0;
        color: #0D0F2B;
        text-align: center;
    }

    .hero h1 {
    font-size: 4rem;
    font-weight: 800;
    color: white;
    text-shadow: 2px 2px 10px rgba(0,0,0,0.7);
}

.hero p {
    font-size: 2rem;
    color: white;
    text-shadow: 2px 2px 8px rgba(0,0,0,0.7);
}

    /* Why Us Section */
    .why-us {
        background-color: #0D0F2B;
        color: white;
        padding: 80px 0;
        text-align: center;
    }

    .why-us h2 {
        font-size: 2rem;
        font-weight: bold;
        color: #f3c623;
        border-bottom: 2px solid #f3c623;
        display: inline-block;
        padding-bottom: 5px;
        margin-bottom: 20px;
    }

    .why-us p {
        max-width: 800px;
        margin: 0 auto 30px;
        font-size: 1rem;
    }

    .btn-maroon {
        background-color: #0D0F2B !important;
        color: white;
    }

    .btn-maroon:hover {
        background-color: #0D0F2B !important;
        color: #0D0F2B;
    }

    .btn-outline-gold {
        border: 1px solid #f4f4f9 !important;
        color: #fff !important;
        background-color: transparent;
        padding: 10px 25px;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin: 10px;
    }

    .btn-outline-gold:hover {
        background-color: #f7f6f5 !important;
        color: #000 !important;
    }

    /* WhatsApp Floating Button */
    .wa-button {
        position: fixed;
        bottom: 20px;
        right: 20px;
        z-index: 999;
    }

    .wa-button img {
        width: 160px;
    }

    @media (max-width: 576px) {
        .hero h1 {
            font-size: 2rem;
        }

        .wa-button img {
            width: 120px;
        }
    }

    .portfolio-img-wrapper {
        height: 300px;
        overflow: hidden;
        position: relative;
    }

    .portfolio-img-wrapper img {
        transition: transform 0.5s ease;
    }

    .portfolio-img-wrapper:hover img {
        transform: scale(1.1);
    }

    .overlay {
        position: absolute;
        top: 0;
        left: 0;
        background: #0D0F2B;
        width: 100%;
        height: 100%;
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .portfolio-img-wrapper:hover .overlay {
        opacity: 1;
    }

    .overlay h5 {
        color: #0D0F2B;
        font-weight: bold;
    }

    .bg-maroon {
        background-color: #0D0F2B;
    }

    .text-maroon {
        color: #0D0F2B;
    }




    /* TESTIMONI CAROUSEL */
#carouselTestimoni {
    position: relative;
    padding-bottom: 70px;
}

#carouselTestimoni .carousel-control-prev,
#carouselTestimoni .carousel-control-next {
    top: auto;
    bottom: 0;
    width: 50px;
    height: 50px;
    opacity: 1;
}

#carouselTestimoni .carousel-control-prev {
    left: calc(50% - 60px);
}

#carouselTestimoni .carousel-control-next {
    right: calc(50% - 60px);
}

#carouselTestimoni .carousel-control-prev-icon,
#carouselTestimoni .carousel-control-next-icon {
    background-color: #0D0F2B;
    border-radius: 50%;
    padding: 22px;
    background-size: 55%;
}



  /* ================= CHATBOT ================= */

#chatBubble{
    border:2px solid #F3C623;
    position:fixed;
    bottom:80px;
    right:20px;
    width:65px;
    height:65px;
    background:#0D0F2B;
    color:white;
    border-radius:50%;
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:28px;
    cursor:pointer;
    box-shadow:0 4px 15px rgba(0,0,0,0.3);
    z-index:9999;
    transition:0.3s;
}

#chatBubble:hover{
    transform:scale(1.08);
    background:#F3C623;
    color:#0D0F2B;
}

#chatContainer{
    position:fixed;
    bottom:90px;
    right:20px;
    width:90%;
    max-width:380px;
    height:70vh;
    max-height:540px;
    background:#fff8dc;
    border:2px solid #F3C623;
    border-radius:22px;
    box-shadow:0 12px 35px rgba(0,0,0,0.28);
    display:none;
    flex-direction:column;
    overflow:hidden;
    z-index:9999;
    font-family:'Poppins', sans-serif;
}

.chat-header{
    background:#0D0F2B;
    color:#F3C623;
    padding:16px;
    font-size:18px;
    font-weight:700;
    display:flex;
    justify-content:space-between;
    align-items:center;
}

#chatClose{
    cursor:pointer;
    font-size:24px;
    color:white;
}

#chatClose:hover{
    color:#F3C623;
}

#chatMessages{
    flex:1;
    padding:15px;
    overflow-y:auto;
    background:#fff8dc;
    display:flex;
    flex-direction:column;
    gap:12px;
    scroll-behavior:smooth;
}

.user-message{
    background:#F3C623;
    color:#0D0F2B;
    padding:12px 15px;
    border-radius:16px 16px 0 16px;
    max-width:80%;
    align-self:flex-end;
    font-size:14px;
    line-height:1.6;
    box-shadow:0 2px 8px rgba(0,0,0,0.1);
}

.ai-message{
    background:white;
    color:#333;
    padding:13px 15px;
    border-radius:16px 16px 16px 0;
    max-width:85%;
    align-self:flex-start;
    font-size:14px;
    line-height:1.7;
    box-shadow:0 2px 10px rgba(0,0,0,0.1);
}

.ai-message strong{
    color:#0D0F2B;
}

.typing-message{
    background:white;
    color:#777;
    padding:12px 15px;
    border-radius:16px 16px 16px 0;
    max-width:75%;
    align-self:flex-start;
    font-size:14px;
    font-style:italic;
}

.faq-box{
    background:white;
    border-radius:15px;
    padding:12px;
    box-shadow:0 2px 8px rgba(0,0,0,0.08);
}

.faq-title{
    font-weight:700;
    color:#0D0F2B;
    margin-bottom:10px;
    font-size:14px;
}

.faq-btn{
    display:block;
    width:100%;
    border:none;
    background:#fff3b0;
    color:#0D0F2B;
    text-align:left;
    padding:9px 11px;
    border-radius:10px;
    margin-bottom:7px;
    font-size:13px;
    cursor:pointer;
}

.faq-btn:hover{
    background:#F3C623;
}

#chatForm{
    display:flex;
    border-top:1px solid #e0d8a8;
    background:white;
    padding:10px;
    gap:8px;
}

#chatInput{
    flex:1;
    border:none;
    outline:none;
    padding:12px;
    font-size:14px;
    border-radius:12px;
    background:#f3f3f3;
}

#chatForm button{
    background:#0D0F2B;
    color:white;
    border:none;
    width:52px;
    border-radius:12px;
    font-size:18px;
    cursor:pointer;
}

#chatForm button:hover{
    background:#F3C623;
    color:#0D0F2B;
}


#quickQuestions{
    padding:10px;
    display:flex;
    gap:8px;
    overflow-x:auto;
    overflow-y:hidden;
    white-space:nowrap;
    background:#fff8dc;
    border-top:1px solid #eee;
    scrollbar-width:none;
}

#quickQuestions::-webkit-scrollbar{
    display:none;
}

.quick-btn{
    flex:0 0 auto;
    border:none;
    background:#F3C623;
    color:#0D0F2B;
    border-radius:20px;
    padding:10px 15px;
    font-size:12px;
    font-weight:600;
    cursor:pointer;
    transition:.3s;
}

.quick-btn:hover{
    background:#0D0F2B;
    color:white;
}

/* ANIMATION */
@keyframes fadeIn{
from{
opacity:0;
transform:translateY(8px);
}
to{
opacity:1;
transform:translateY(0);
}
}
    </style>
</head>

<body>
    <?php
    include 'header.php';

    $dbHost = getenv('DB_HOST') ?: 'localhost';
    $dbUser = getenv('DB_USERNAME') ?: 'root';
    $dbPass = getenv('DB_PASSWORD') ?: '';
    $dbName = getenv('DB_DATABASE') ?: 'wo_web';
    $dbPort = getenv('DB_PORT') ?: 3306;

    $koneksi = new mysqli($dbHost, $dbUser, $dbPass, $dbName, (int) $dbPort);

    if ($koneksi->connect_error) {
        die("Koneksi database gagal: " . $koneksi->connect_error);
    }

    $testimonies = $koneksi->query("
        SELECT t.*, p.nama
        FROM testimoni t
        LEFT JOIN pelanggan p
        ON t.idPelanggan = p.idPelanggan
    ");
    ?>

    <!-- Hero Section -->
    <section class="hero">
        <h1>SYF_WEDDINGPLANNERS</h1>
        <p>Because it’s your wedding, every detail matters.</p>
    </section>

    <!-- WHY US Section -->
    <section class="why-us">
        <h2>KENAPA KITA?</h2>
        <h1>Karena ini adalah pernikahanmu, setiap detail itu penting.</h1>
        <p>Syf Wedding Organizer  memiliki team dengan individu-individu profesional, memiliki pengalaman bertahun-tahun
            dalam sukses melaksanakan acara pernikahan.
        </p>
        <div>
            <?php if(isset($_SESSION['ses_id']) && ($_SESSION['ses_level'] ?? '') == 'user'): ?>

                <a href="#" class="btn btn-outline-gold" data-bs-toggle="modal" data-bs-target="#orderModal">
                    Pesan Paket →
                </a>

            <?php else: ?>

                <a href="#" class="btn btn-outline-gold" onclick="peringatanLoginPesan()">
                    Pesan Paket →
                </a>

            <?php endif; ?>

            <a href="pricelist.php" class="btn btn-outline-gold">DAFTAR HARGA →</a>
        </div>
    </section>
    <!-- Modal Pemesanan -->
    <div class="modal fade" id="orderModal" tabindex="-1" aria-labelledby="orderModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content border-0 rounded-4">
                <div class="modal-header bg-maroon text-white">
                    <h5 class="modal-title fw-bold" id="orderModalLabel">Form Pemesanan Wedding Organizer</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <form action="" method="post" id="formPesanan">
                        <!-- Simulasi session -->
                        <input type="hidden" name="idPelanggan" value="<?= $_SESSION['ses_id'] ?>">

                        <?php
                        $namaUserPesan = '';

                        if (isset($_SESSION['ses_id'])) {
                            $idUserPesan = $_SESSION['ses_id'];

                            $qUserPesan = mysqli_query($conn, "
                                SELECT nama
                                FROM pelanggan
                                WHERE idPelanggan = '$idUserPesan'
                            ");

                            if ($qUserPesan && mysqli_num_rows($qUserPesan) > 0) {
                                $dUserPesan = mysqli_fetch_assoc($qUserPesan);
                                $namaUserPesan = $dUserPesan['nama'];
                            }
                        }
                        ?>

                        <div class="mb-3">
                            <label class="form-label">Nama Pelanggan</label>
                            <input
                                type="text"
                                class="form-control"
                                value="<?= htmlspecialchars($namaUserPesan) ?>"
                                readonly>
                        </div>

                        <!-- Input ID Paket -->
                        <div class="mb-3">
                            <label for="idPaket" class="form-label">Pilih Paket</label>
                            <?php
                            $queryPaket = mysqli_query($conn, "SELECT * FROM paketpernikahan");
                            ?>

                            <select class="form-select" name="idPaket" id="idPaket" required>

                                <option selected disabled value="">
                                    Pilih salah satu
                                </option>

                                <?php while($paket = mysqli_fetch_assoc($queryPaket)) : ?>

                                    <option 
                                        value="<?= $paket['idPaket']; ?>"
                                        data-harga="<?= $paket['harga']; ?>">

                                        <?= $paket['namaPaket']; ?> -
                                        Rp <?= number_format($paket['harga'],0,',','.'); ?>

                                    </option>

                                <?php endwhile; ?>

                            </select>
                        </div>

                        <div class="mb-3">
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" id="cekTambahan">
                            <label class="form-check-label fw-bold" for="cekTambahan">
                                Tambah layanan tambahan?
                            </label>
                        </div>

                        <div id="boxTambahan" style="display: none;">
                            <label class="form-label">Tambahan (Opsional)</label>

                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <label>Tambah adat (Rp 1.000.000)</label>
                                <input type="number" name="adat" class="form-control tambahan" data-harga="1000000" min="0" value="0" style="width:100px;">
                            </div>

                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <label>Makeup (Rp 500.000 / orang)</label>
                                <input type="number" name="makeup" class="form-control tambahan" data-harga="500000" min="0" value="0" style="width:100px;">
                            </div>

                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <label>Tambah Baju (Rp 700.000 / pcs)</label>
                                <input type="number" name="baju" class="form-control tambahan" data-harga="700000" min="0" value="0" style="width:100px;">
                            </div>

                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <label>Perlengkapan Alat Makan (Rp 20.000 / set)</label>
                                <input type="number" name="alatMakan" class="form-control tambahan" data-harga="20000" min="0" value="0" style="width:100px;">
                            </div>

                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <label>MC (Rp 1.000.000)</label>
                                <input type="number" name="mc" class="form-control tambahan" data-harga="1000000" min="0" max="2" value="0" style="width:100px;">
                            </div>

                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <label>Catering (Rp 50.000 / porsi)</label>
                                <input type="number" name="catering" class="form-control tambahan" data-harga="50000" min="0" value="0" style="width:100px;">
                            </div>
                        </div>
                    </div>

                        <div class="mb-3">
                            <label for="tanggalPesan" class="form-label">Tanggal Acara</label>
                            <input type="date" class="form-control" name="tanggalPesan" required>
                        </div>

                        <!-- Metode Pembayaran -->
                        <div class="mb-3">
                            <label for="metodePembayaran" class="form-label">Metode Pembayaran</label>
                            <select class="form-select" name="metodePembayaran" id="metodePembayaran" required>
                                <option value="DP">DP (50%)</option>
                                <option value="Lunas">Lunas (100%)</option>
                            </select>
                        </div>

                        <!-- Input Tersembunyi -->
                        <input type="hidden" name="jumlahPembayaran" id="jumlahPembayaran">

                        <!-- Harga yang ditampilkan -->
                        <div class="mb-3 text-end">
                            <strong>Total Pembayaran: <span id="hargaTampil">Rp 0</span></strong>
                        </div>

                        <!-- Tombol Submit -->
                        <div class="text-end">
                            <button id="pay-button" class="btn btn-maroon text-white">Bayar Sekarang</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="SB-Mid-client-BLUyugD7t0NiNWmy">
    </script>
    <script>
    const form = document.getElementById("formPesanan");
    const paketSelect = document.getElementById("idPaket");
    const metodeSelect = document.getElementById("metodePembayaran");
    const jumlahPembayaranInput = document.getElementById("jumlahPembayaran");
    const hargaTampil = document.getElementById("hargaTampil");
    const payButton = document.getElementById("pay-button");
    const cekTambahan = document.getElementById("cekTambahan");
    const boxTambahan = document.getElementById("boxTambahan");

    payButton.addEventListener("click", async (e) => {
        e.preventDefault();

        const formData = new FormData(form);

        await fetch('checkout-process.php', {
            method: 'POST',
            body: formData
        })
        .then(async (response) => {
            const data = await response.json();

            snap.pay(data.token, {
                onSuccess: function(result) {
                    const formData = new FormData(form);

                    formData.append("transactionId", result.transaction_id);
                    formData.append("statusPembayaran", result.transaction_status);

                    fetch('simpan_pesanan.php', {
                        method: 'POST',
                        body: formData
                    })
                    .then(res => res.json())
                    .then(data => {
                        if (data.status === "success") {
                            alert("Pesanan berhasil disimpan!");
                            window.location.href = "keranjang.php";
                        } else {
                            alert("Gagal menyimpan pesanan: " + data.message);
                        }
                    })
                    .catch(err => {
                        console.error("Error saat simpan:", err);
                        alert("Terjadi kesalahan saat menyimpan pesanan.");
                    });
                },

                onPending: function(result) {
                    console.log(result);
                    alert("Pembayaran masih pending.");
                },

                onError: function(result) {
                    console.log(result);
                    alert("Pembayaran gagal.");
                }
            });
        })
        .catch((error) => {
            console.error("Checkout error:", error);
            alert("Terjadi kesalahan saat proses checkout.");
        });
    });

    function updateHarga() {
        const selectedOption = paketSelect.options[paketSelect.selectedIndex];
        const hargaPaket = parseFloat(selectedOption?.getAttribute("data-harga")) || 0;

        let totalTambahan = 0;

        document.querySelectorAll(".tambahan").forEach(item => {
            let jumlah = parseInt(item.value) || 0;
            let harga = parseFloat(item.getAttribute("data-harga")) || 0;

            totalTambahan += jumlah * harga;
        });

        let total = hargaPaket + totalTambahan;

        if (metodeSelect.value === "DP") {
            total = total * 0.5;
        }

        jumlahPembayaranInput.value = total;
        hargaTampil.textContent = "Rp " + total.toLocaleString("id-ID");
    }

    paketSelect.addEventListener("change", updateHarga);
    metodeSelect.addEventListener("change", updateHarga);

    cekTambahan.addEventListener("change", function () {
        if (this.checked) {
            boxTambahan.style.display = "block";
        } else {
            boxTambahan.style.display = "none";

            document.querySelectorAll(".tambahan").forEach(function(input) {
                input.value = 0;
            });

            updateHarga();
        }
    });

    document.querySelectorAll(".tambahan").forEach(function(input) {
        input.addEventListener("input", updateHarga);
    });

    updateHarga();
    </script>



    <section class="py-5 bg-white" id="portfolio">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="fw-bold text-uppercase" style="color: #4b0000;">Portofolio Kami</h2>
                <p class="text-muted">Kami telah menangani berbagai konsep pernikahan impian dengan
                    profesionalisme dan
                    sentuhan personal.</p>
            </div>

            <div class="row g-4">
                <!-- Portfolio Card -->
                <div class="col-md-6 col-lg-4">
                    <div class="card border-0 shadow-lg overflow-hidden rounded-4" data-bs-toggle="modal"
                        data-bs-target="#portfolioModal1">
                        <div class="portfolio-img-wrapper position-relative">
                            <img src="assets/img/FOTO 12.jpeg" class="w-100 h-100 object-fit-cover" alt="Wedding 1">
                            <div class="overlay d-flex align-items-center justify-content-center">
                                <h5 class="text-white text-center">Guntur & Caca<br><small>Adat Sunda
                                        Modern</small></h5>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4">
                    <div class="card border-0 shadow-lg overflow-hidden rounded-4" data-bs-toggle="modal"
                        data-bs-target="#portfolioModal2">
                        <div class="portfolio-img-wrapper position-relative">
                            <img src="assets/img/FOTO 16.jpeg" class="w-100 h-100 object-fit-cover" alt="Wedding 2">
                            <div class="overlay d-flex align-items-center justify-content-center">
                                <h5 class="text-white text-center">Chairul & Aulia<br><small>Adat Jawa
                                        Modern</small>
                                </h5>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4">
                    <div class="card border-0 shadow-lg overflow-hidden rounded-4" data-bs-toggle="modal"
                        data-bs-target="#portfolioModal3">
                        <div class="portfolio-img-wrapper position-relative">
                            <img src="assets/img/photo-8.jpg" class="w-100 h-100 object-fit-cover" alt="Wedding 3">
                            <div class="overlay d-flex align-items-center justify-content-center">
                                <h5 class="text-white text-center">Dito & Kia<br><small>Elegant Ballroom</small>
                                </h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Modal 1 -->
    <div class="modal fade" id="portfolioModal1" tabindex="-1" aria-labelledby="portfolioModal1Label"
        aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content border-0 rounded-4 overflow-hidden">
                <div class="modal-header bg-maroon text-white border-0">
                    <h5 class="modal-title fw-bold" id="portfolioModal1Label">Pernikahan Guntur & Caca</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-0">
                        <!-- Gambar dengan Carousel dan Padding -->
                        <div class="col-md-6">
                            <div class="p-3">
                                <!-- Padding semua sisi -->
                                <div id="portfolioCarousel1" class="carousel slide rounded" data-bs-ride="carousel">
                                    <div class="carousel-inner rounded-3">
                                        <div class="carousel-item active">
                                            <img src="assets/img/FOTO 12.jpeg" class="d-block w-100"
                                                style="max-height: 300px; object-fit: cover;" alt="Slide 1">
                                        </div>
                                        <div class="carousel-item">
                                            <img src="assets/img/FOTO 11.jpeg" class="d-block w-100"
                                                style="max-height: 300px; object-fit: cover;" alt="Slide 2">
                                        </div>
                                        <div class="carousel-item">
                                            <img src="assets/img/FOTO 13.jpeg" class="d-block w-100"
                                                style="max-height: 300px; object-fit: cover;" alt="Slide 3">
                                        </div>
                                    </div>
                                    <button class="carousel-control-prev" type="button"
                                        data-bs-target="#portfolioCarousel1" data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon"></span>
                                    </button>
                                    <button class="carousel-control-next" type="button"
                                        data-bs-target="#portfolioCarousel1" data-bs-slide="next">
                                        <span class="carousel-control-next-icon"></span>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Deskripsi -->
                        <div class="col-md-6 d-flex flex-column justify-content-center p-4">
                            <div>
                                <h4 class="fw-bold">Adat Sunda Modern</h4>
                                <p class="text-muted">
                                    Diselenggarakan di perumahan citra garden, Kalideres, Jakarta Barat, acara ini memadukan adat sunda klasik dengan
                                    sentuhan
                                    modern minimalis. Kami menangani semua aspek mulai dari dekorasi, tata rias,
                                    hingga
                                    pengaturan kursi VIP.
                                </p>
                                <ul class="list-unstyled text-muted">
                                    <li><i class="bi bi-calendar-event"></i> 18 November 2024</li>
                                    <li><i class="bi bi-geo-alt"></i> Citra 6, Kalideres, Jakarta Barat</li>
                                    <li><i class="bi bi-people-fill"></i> 500 Tamu Undangan</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal 2 -->
    <div class="modal fade" id="portfolioModal2" tabindex="-1" aria-labelledby="portfolioModal2Label"
        aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content border-0 rounded-4 overflow-hidden">
                <div class="modal-header bg-maroon text-white border-0">
                    <h5 class="modal-title fw-bold" id="portfolioModal2Label">Pernikahan Chairul & Aulia</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-0">
                        <!-- Gambar dengan Carousel dan Padding -->
                        <div class="col-md-6">
                            <div class="p-3">
                                <!-- Padding semua sisi -->
                                <div id="portfolioCarousel2" class="carousel slide rounded" data-bs-ride="carousel">
                                    <div class="carousel-inner rounded-3">
                                        <div class="carousel-item active">
                                            <img src="assets/img/FOTO 14.jpeg" class="d-block w-100"
                                                style="max-height: 300px; object-fit: cover;" alt="Slide 1">
                                        </div>
                                        <div class="carousel-item">
                                            <img src="assets/img/FOTO 15.jpeg" class="d-block w-100"
                                                style="max-height: 300px; object-fit: cover;" alt="Slide 2">
                                        </div>
                                        <div class="carousel-item">
                                            <img src="assets/img/FOTO 16.jpeg" class="d-block w-100"
                                                style="max-height: 300px; object-fit: cover;" alt="Slide 3">
                                        </div>
                                    </div>
                                    <button class="carousel-control-prev" type="button"
                                        data-bs-target="#portfolioCarousel2" data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon"></span>
                                    </button>
                                    <button class="carousel-control-next" type="button"
                                        data-bs-target="#portfolioCarousel2" data-bs-slide="next">
                                        <span class="carousel-control-next-icon"></span>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Deskripsi -->
                        <div class="col-md-6 d-flex flex-column justify-content-center p-4">
                            <div>
                                <h4 class="fw-bold">Adat Jawa Modern</h4>
                                <p class="text-muted">
                                    Diselenggarakan di Ballroom Walikota Jakarta Barat, acara ini memadukan adat Jawa klasik dengan
                                    sentuhan
                                    modern minimalis. Kami menangani semua aspek mulai dari dekorasi, tata rias,
                                    hingga
                                    pengaturan kursi VIP.
                                </p>
                                <ul class="list-unstyled text-muted">
                                    <li><i class="bi bi-calendar-event"></i> 08 Desember 2024</li>
                                    <li><i class="bi bi-geo-alt"></i> Ballroom Walikota Jakarta Barat, Jakarta Barat</li>
                                    <li><i class="bi bi-people-fill"></i> 1000 Tamu Undangan</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal 3 -->
    <div class="modal fade" id="portfolioModal3" tabindex="-1" aria-labelledby="portfolioModal3Label"
        aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content border-0 rounded-4 overflow-hidden">
                <div class="modal-header bg-maroon text-white border-0">
                    <h5 class="modal-title fw-bold" id="portfolioModal3Label">Pernikahan Dito & Kia</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-0">
                        <!-- Gambar dengan Carousel dan Padding -->
                        <div class="col-md-6">
                            <div class="p-3">
                                <!-- Padding semua sisi -->
                                <div id="portfolioCarousel3" class="carousel slide rounded" data-bs-ride="carousel">
                                    <div class="carousel-inner rounded-3">
                                        <div class="carousel-item active">
                                            <img src="assets/img/FOTO 17.jpeg" class="d-block w-100"
                                                style="max-height: 300px; object-fit: cover;" alt="Slide 1">
                                        </div>
                                        <div class="carousel-item">
                                            <img src="assets/img/photo-8.jpg" class="d-block w-100"
                                                style="max-height: 300px; object-fit: cover;" alt="Slide 2">
                                        </div>
                                        <div class="carousel-item">
                                            <img src="assets/img/FOTO 17.jpeg" class="d-block w-100"
                                                style="max-height: 300px; object-fit: cover;" alt="Slide 3">
                                        </div>
                                    </div>
                                    <button class="carousel-control-prev" type="button"
                                        data-bs-target="#portfolioCarousel3" data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon"></span>
                                    </button>
                                    <button class="carousel-control-next" type="button"
                                        data-bs-target="#portfolioCarousel3" data-bs-slide="next">
                                        <span class="carousel-control-next-icon"></span>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Deskripsi -->
                        <div class="col-md-6 d-flex flex-column justify-content-center p-4">
                            <div>
                                <h4 class="fw-bold">Adat Sunda</h4>
                                <p class="text-muted">
                                    Diselenggarakan di Ballroom Marqen Hotel, acara ini memadukan adat Jawa klasik dengan
                                    sentuhan
                                    modern minimalis. Kami menangani semua aspek mulai dari dekorasi, tata rias,
                                    hingga
                                    pengaturan kursi VIP.
                                </p>
                                <ul class="list-unstyled text-muted">
                                    <li><i class="bi bi-calendar-event"></i> 18 November 2024</li>
                                    <li><i class="bi bi-geo-alt"></i> Ballroom Marqen hotel, Jakarta Barat</li>
                                    <li><i class="bi bi-people-fill"></i> 700++ Tamu Undangan</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section id="testimoni" class="py-5" style="background: linear-gradient(to bottom right, #fff5e6, #f3c623);">
        <div class="container">
            <h2 class="text-center fw-bold mb-5 text-maroon">Apa Kata Klien Kami</h2>

                <?php
                $dataTestimoni = [];
                while ($t = $testimonies->fetch_assoc()) {
                    $dataTestimoni[] = $t;
                }

                $chunks = array_chunk($dataTestimoni, 6);
                ?>

                <div id="carouselTestimoni" class="carousel slide mb-5" data-bs-ride="false">
                    <div class="carousel-inner">

                        <?php foreach ($chunks as $index => $group): ?>
                            <div class="carousel-item <?= $index == 0 ? 'active' : '' ?>">
                                <div class="row g-4">

                                    <?php foreach ($group as $t): ?>
                                        <div class="col-md-4">
                                            <div class="card border-0 shadow-sm rounded-4 h-100">
                                                <div class="card-body bg-white rounded-4">
                                                    <p class="fst-italic mb-4">
                                                        "<?= htmlspecialchars($t['isiTestimoni']) ?>"
                                                    </p>
                                                    <hr>
                                                    <h6 class="fw-bold mb-0 text-maroon">
                                                        <?= htmlspecialchars($t['nama']) ?>
                                                    </h6>
                                                    <small class="text-muted">
                                                        <?= htmlspecialchars($t['tanggalTestimoni']) ?>
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>

                                </div>
                            </div>
                        <?php endforeach; ?>

                    </div>

                    <?php if (count($chunks) > 1): ?>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselTestimoni" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon bg-dark rounded-circle p-3"></span>
                        </button>

                        <button class="carousel-control-next" type="button" data-bs-target="#carouselTestimoni" data-bs-slide="next">
                            <span class="carousel-control-next-icon bg-dark rounded-circle p-3"></span>
                        </button>
                    <?php endif; ?>
                </div>

            <!-- Form Tambah Testimoni -->
                <div class="bg-white p-4 rounded-4 shadow-sm">
                    <h5 class="text-maroon mb-3">Buat Testimoni</h5>

                    <?php if(isset($_SESSION['ses_id']) && ($_SESSION['ses_level'] ?? '') == 'user'): ?>

                        <form action="proses_testimoni.php" method="POST" id="formTestimoni">
                            <div class="mb-3">
                                <label for="isiTestimoni" class="form-label">Isi Testimoni</label>
                                <textarea class="form-control" id="isiTestimoni" name="isiTestimoni" rows="3" required></textarea>
                            </div>

                            <button type="submit" class="btn btn-maroon" style="color:white;">
                                Kirim Testimoni
                            </button>
                        </form>

                    <?php else: ?>

                        <div class="mb-3">
                            <label class="form-label">Isi Testimoni</label>
                            <textarea class="form-control" rows="3"
                                placeholder="Silakan login terlebih dahulu untuk memberikan testimoni"></textarea>
                        </div>

                        <button type="button" class="btn btn-maroon" style="color:white;" onclick="peringatanLogin()">
                            Kirim Testimoni
                        </button>

                    <?php endif; ?>
                </div>

        </div>
    </section>


<!-- Bubble Icon -->
<div id="chatBubble">💬</div>

<!-- Chatbox -->
<div id="chatContainer">

  <div class="chat-header">
    SYF Wedding Planner
    <span id="chatClose">✖</span>
  </div>

  <div id="chatMessages"></div>

  <div id="quickQuestions">
      <button class="quick-btn">Apa saja paket yang tersedia?</button>
      <button class="quick-btn">Berapa harga Paket Silver?</button>
      <button class="quick-btn">Berapa harga Paket Gold?</button>
      <button class="quick-btn">Berapa harga Paket Platinum?</button>
      <button class="quick-btn">Bagaimana cara pemesanan?</button>
      <button class="quick-btn">Apakah bisa pembayaran DP?</button>
      <button class="quick-btn">Layanan tambahan apa saja?</button>
      <button class="quick-btn">Bagaimana cara menghubungi admin?</button>
  </div>

  <form id="chatForm">
    <input type="text" id="chatInput" placeholder="Ketik pesan..." required>
    <button type="submit">➤</button>
  </form>

</div>


    <!-- WhatsApp Button -->
    <div class="wa-button">
        <a href="https://wa.me/6281383021071" target="_blank">
            <img src="assets/img/whatsapp-icon.png" alt="Hubungi Kami via WhatsApp">
        </a>
    </div>


   <!-- Chatbot JS -->
<script>
const chatBubble = document.getElementById("chatBubble");
const chatContainer = document.getElementById("chatContainer");
const chatForm = document.getElementById("chatForm");
const chatInput = document.getElementById("chatInput");
const chatMessages = document.getElementById("chatMessages");
const chatClose = document.getElementById("chatClose");

chatBubble.addEventListener("click", () => {
    chatContainer.style.display = "flex";
});

chatClose.addEventListener("click", () => {
    chatContainer.style.display = "none";
});

chatForm.addEventListener("submit", async (e) => {
    e.preventDefault();

    const msg = chatInput.value.trim();
    if (!msg) return;

    const userMsg = document.createElement("div");
    userMsg.textContent = msg;
    userMsg.classList.add("user-message");
    chatMessages.appendChild(userMsg);

    chatInput.value = "";

    const typingMsg = document.createElement("div");
    typingMsg.classList.add("typing-message");
    typingMsg.id = "typingMessage";
    typingMsg.innerHTML = "SYF Wedding Planner sedang mengetik...";
    chatMessages.appendChild(typingMsg);

    chatMessages.scrollTop = chatMessages.scrollHeight;

    try {
        const response = await fetch("chat.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/x-www-form-urlencoded"
            },
            body: "message=" + encodeURIComponent(msg)
        });

        const answer = await response.text();

        const typingElement = document.getElementById("typingMessage");
        if (typingElement) typingElement.remove();

        const aiMsg = document.createElement("div");
        aiMsg.classList.add("ai-message");
        aiMsg.innerHTML = "<strong>SYF Wedding Planner:</strong><br><br>" + answer;

        chatMessages.appendChild(aiMsg);
        chatMessages.scrollTop = chatMessages.scrollHeight;

    } catch (error) {
        const typingElement = document.getElementById("typingMessage");
        if (typingElement) typingElement.remove();

        const errorMsg = document.createElement("div");
        errorMsg.classList.add("ai-message");
        errorMsg.innerHTML = "<strong>SYF Wedding Planner:</strong><br><br>Maaf, terjadi kesalahan. Silakan coba lagi.";

        chatMessages.appendChild(errorMsg);
        chatMessages.scrollTop = chatMessages.scrollHeight;
    }
});

document.querySelectorAll(".quick-btn").forEach(function(btn) {
    btn.addEventListener("click", function() {
        chatInput.value = this.innerText;
        chatForm.dispatchEvent(new Event("submit"));
    });
});
</script>

<!-- Auto buka modal orderModal jika datang dari header menu PESAN PAKET -->
<script>
document.addEventListener("DOMContentLoaded", function () {
    if (window.location.hash === "#orderModal") {
        const modalElement = document.getElementById("orderModal");

        if (modalElement) {
            const orderModal = new bootstrap.Modal(modalElement);
            orderModal.show();
        }
    }
});
</script>
 
<script>
function peringatanLogin() {
    Swal.fire({
        icon: 'warning',
        title: 'Login Diperlukan',
        text: 'Silakan login terlebih dahulu untuk mengirim testimoni.',
        confirmButtonColor: '#0D0F2B',
        confirmButtonText: 'Login Sekarang'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = 'login.php';
        }
    });
}
</script>

<script>
const formTestimoni = document.getElementById('formTestimoni');

if (formTestimoni) {
    formTestimoni.addEventListener('submit', function(e) {
        e.preventDefault();

        if (!formTestimoni.checkValidity()) {
            formTestimoni.reportValidity();
            return;
        }

        Swal.fire({
            title: 'Kirim Testimoni?',
            text: 'Apakah Anda yakin ingin mengirim testimoni ini?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#0D0F2B',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Kirim',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                formTestimoni.submit();
            }
        });
    });
}
</script>
</body>

</html>

<?php
include "footer.php"
?>