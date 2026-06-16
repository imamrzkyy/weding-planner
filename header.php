<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include 'config.php';

$currentPage = basename($_SERVER['PHP_SELF']);

$jumlah_pesanan = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;

$namaUser = "User";

if (isset($_SESSION['ses_id']) && ($_SESSION['ses_level'] ?? '') == 'user') {
    $idPelanggan = $_SESSION['ses_id'];

    $query = mysqli_query($conn, "SELECT nama FROM pelanggan WHERE idPelanggan = '$idPelanggan'");

    if ($query && mysqli_num_rows($query) > 0) {
        $data = mysqli_fetch_assoc($query);
        $namaUser = $data['nama'];
    }
}
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-maroon">
    <div class="container-fluid px-4">

        <!-- Logo -->
        <a class="navbar-brand" href="index.php">
            <img src="assets/img/profile foto syf wedding planners.jpeg"
                 alt="Logo SYF Wedding Planner"
                 class="logo-navbar">
        </a>

        <!-- Tombol hamburger mobile -->
        <button class="navbar-toggler"
                type="button"
                data-bs-toggle="offcanvas"
                data-bs-target="#mobileMenu"
                aria-controls="mobileMenu">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Menu desktop -->
        <div class="collapse navbar-collapse d-none d-lg-flex" id="navbarNav">

            <ul class="navbar-nav me-auto main-menu">
                <li class="nav-item">
                    <a class="nav-link <?= ($currentPage == 'index.php') ? 'active' : '' ?>" href="index.php">
                        BERANDA
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link <?= ($currentPage == 'about.php') ? 'active' : '' ?>" href="about.php">
                        TENTANG KAMI
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link <?= ($currentPage == 'pricelist.php') ? 'active' : '' ?>" href="pricelist.php">
                        DAFTAR HARGA
                    </a>
                </li>

                <li class="nav-item">
                    <?php if (isset($_SESSION['ses_id']) && ($_SESSION['ses_level'] ?? '') == 'user') { ?>

                        <?php if ($currentPage == 'index.php') { ?>
                            <a class="nav-link"
                               href="#"
                               data-bs-toggle="modal"
                               data-bs-target="#orderModal">
                                PESAN PAKET
                            </a>
                        <?php } else { ?>
                            <a class="nav-link" href="index.php#orderModal">
                                PESAN PAKET
                            </a>
                        <?php } ?>

                    <?php } else { ?>
                        <a class="nav-link" href="#" onclick="peringatanLoginPesan()">
                            PESAN PAKET
                        </a>
                    <?php } ?>
                </li>
            </ul>

            <ul class="navbar-nav user-menu align-items-lg-center">

                <?php if (isset($_SESSION['ses_id']) && ($_SESSION['ses_level'] ?? '') == 'user') { ?>

                    <li class="nav-item">
                        <a class="nav-link text-white position-relative" href="keranjang.php">
                            <i class="bi bi-cart cart-icon"></i>
                            <?php if ($jumlah_pesanan > 0): ?>
                                <span class="cart-badge position-absolute top-0 start-100 translate-middle badge rounded-pill bg-warning text-dark">
                                    <?= $jumlah_pesanan ?>
                                </span>
                            <?php endif; ?>
                        </a>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                           aria-expanded="false">
                            Hai, <strong><?= htmlspecialchars($namaUser) ?></strong>
                        </a>

                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <a class="dropdown-item" href="profil.php">
                                    <i class="bi bi-person-circle me-2"></i>Profil
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item">
                        <a href="#" onclick="confirmLogout()" class="btn btn-warning text-dark fw-semibold px-3 py-1">
                            Keluar
                        </a>
                    </li>

                <?php } else { ?>

                    <li class="nav-item">
                        <a href="login.php" class="btn btn-warning text-dark fw-semibold px-3 py-1">
                            Login
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="register.php" class="btn btn-outline-light fw-semibold px-3 py-1">
                            Daftar
                        </a>
                    </li>

                <?php } ?>

            </ul>

        </div>

    </div>
</nav>

<!-- Sidebar Mobile -->
<div class="offcanvas offcanvas-start mobile-sidebar" tabindex="-1" id="mobileMenu">

    <div class="offcanvas-header mobile-sidebar-header">

        <div class="d-flex align-items-center gap-3">
            <img src="assets/img/profile foto syf wedding planners.jpeg"
                 alt="Logo SYF Wedding Planner"
                 class="mobile-sidebar-logo">

            <div>
                <div class="mobile-title">SYF Wedding Planner</div>

                <?php if (isset($_SESSION['ses_id']) && ($_SESSION['ses_level'] ?? '') == 'user') { ?>
                    <div class="mobile-subtitle">
                        Hai, <?= htmlspecialchars($namaUser) ?>
                    </div>
                <?php } else { ?>
                    <div class="mobile-subtitle">
                        Selamat datang
                    </div>
                <?php } ?>
            </div>
        </div>

        <button type="button"
                class="btn-close btn-close-white"
                data-bs-dismiss="offcanvas"
                aria-label="Close">
        </button>

    </div>

    <div class="offcanvas-body p-0">

        <div class="mobile-menu-title">MENU UTAMA</div>

        <a href="index.php" class="mobile-link <?= ($currentPage == 'index.php') ? 'active' : '' ?>">
            <span>🏠</span> BERANDA
        </a>

        <a href="about.php" class="mobile-link <?= ($currentPage == 'about.php') ? 'active' : '' ?>">
            <span>💍</span> TENTANG KAMI
        </a>

        <a href="pricelist.php" class="mobile-link <?= ($currentPage == 'pricelist.php') ? 'active' : '' ?>">
            <span>📋</span> DAFTAR HARGA
        </a>

        <?php if (isset($_SESSION['ses_id']) && ($_SESSION['ses_level'] ?? '') == 'user') { ?>

            <?php if ($currentPage == 'index.php') { ?>
                <a href="#"
                   class="mobile-link"
                   data-bs-dismiss="offcanvas"
                   data-bs-toggle="modal"
                   data-bs-target="#orderModal">
                    <span>🛒</span> PESAN PAKET
                </a>
            <?php } else { ?>
                <a href="index.php#orderModal" class="mobile-link">
                    <span>🛒</span> PESAN PAKET
                </a>
            <?php } ?>

            <div class="mobile-menu-title">AKUN SAYA</div>

            <a href="keranjang.php" class="mobile-link">
                <span>🛍️</span> KERANJANG
            </a>

            <a href="profil.php" class="mobile-link">
                <span>👤</span> PROFIL
            </a>

            <a href="#" onclick="confirmLogout()" class="mobile-link text-warning">
                <span>🚪</span> KELUAR
            </a>

        <?php } else { ?>

            <a href="#" onclick="peringatanLoginPesan()" class="mobile-link">
                <span>🛒</span> PESAN PAKET
            </a>

            <div class="mobile-menu-title">AKUN</div>

            <a href="login.php" class="mobile-link">
                <span>🔐</span> LOGIN
            </a>

            <a href="register.php" class="mobile-link">
                <span>📝</span> DAFTAR
            </a>

        <?php } ?>

    </div>

</div>

<style>
.bg-maroon {
    background-color: #0D0F2B;
}

.navbar {
    padding-top: 12px !important;
    padding-bottom: 12px !important;
}

.logo-navbar {
    height: 70px;
    width: auto;
    border-radius: 8px;
}

.navbar-brand {
    margin-left: 10px;
}

.navbar-nav {
    align-items: center;
}

.main-menu {
    margin-left: 55px;
    gap: 38px;
}

.user-menu {
    gap: 14px;
}

.navbar-nav .nav-link {
    font-size: 16px;
    font-weight: 700;
    letter-spacing: 0.5px;
    color: white !important;
    transition: all 0.3s ease;
}

.navbar-nav .nav-link.active {
    color: #F3C623 !important;
}

.navbar-nav .nav-link:hover {
    color: #F3C623 !important;
    transform: translateY(-1px);
}

.cart-icon {
    font-size: 1.2rem;
    color: #F3C623;
}

.cart-badge {
    font-size: 0.75rem;
    font-weight: bold;
}

/* SIDEBAR MOBILE */
.mobile-sidebar {
    background: #0D0F2B !important;
    width: 285px !important;
    color: white;
}

.mobile-sidebar-header {
    padding: 18px;
    min-height: 105px;
    background: #0D0F2B;
    border-bottom: 1px solid rgba(243,198,35,0.25);
}

.mobile-sidebar-logo {
    width: 62px;
    height: 62px;
    border-radius: 12px;
    object-fit: cover;
}

.mobile-title {
    color: #F3C623;
    font-weight: 700;
    font-size: 15px;
}

.mobile-subtitle {
    color: white;
    font-size: 13px;
}

.mobile-menu-title {
    background: #15183d;
    color: #F3C623;
    font-weight: 700;
    padding: 13px 22px;
    font-size: 14px;
}

.mobile-link {
    display: flex;
    align-items: center;
    gap: 14px;
    color: white !important;
    background: #0D0F2B !important;
    text-decoration: none !important;
    padding: 15px 22px;
    font-weight: 600;
    font-size: 15px;
    border-bottom: 1px solid rgba(255,255,255,0.08);
}

.mobile-link i {
    width: 22px;
    color: #F3C623;
    font-size: 18px;
}

.mobile-link:hover,
.mobile-link.active {
    background: #15183d !important;
    color: #F3C623 !important;
}

.mobile-link.text-warning {
    color: #F3C623 !important;
}
</style>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
function confirmLogout() {
    Swal.fire({
        title: 'Keluar dari akun?',
        text: 'Apakah Anda yakin ingin keluar?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#0D0F2B',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, keluar',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = 'logout.php';
        }
    });
}

function peringatanLoginPesan() {
    Swal.fire({
        icon: 'warning',
        title: 'Login Diperlukan',
        text: 'Silakan login terlebih dahulu untuk melakukan pemesanan paket.',
        confirmButtonColor: '#0D0F2B',
        confirmButtonText: 'Login Sekarang',
        showCancelButton: true,
        cancelButtonText: 'Batal',
        cancelButtonColor: '#d33'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = 'login.php';
        }
    });
}
</script>