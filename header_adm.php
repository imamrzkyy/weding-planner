<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="icon" type="image/jpeg" href="assets/img/profile%20foto%20syf%20wedding%20planners.jpeg?v=99">
    <link rel="shortcut icon" type="image/jpeg" href="assets/img/profile%20foto%20syf%20wedding%20planners.jpeg?v=99">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f4f7fe;
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', sans-serif;
            overflow-x: hidden;
        }

        .bg-maroon {
            background-color: #0D0F28 !important;
            color: white;
        }

        .main-content {
            min-height: 100vh;
            transition: .3s;
        }

        /* DESKTOP: sidebar kiri seperti awal */
        .desktop-sidebar {
            background: #0D0F28;
            color: #fff;
            height: 100vh;
            position: fixed;
            width: 250px;
            left: 0;
            top: 0;
            z-index: 1000;
            padding-top: 20px;
            overflow-y: auto;
        }

        .desktop-sidebar h5 {
            color: white;
            font-weight: bold;
        }

        .desktop-sidebar a {
            color: white;
            text-decoration: none;
            display: block;
            padding: 12px 20px;
            transition: 0.3s;
        }

        .desktop-sidebar a:hover {
            background-color: #F3C623;
            color: #0D0F28;
            padding-left: 30px;
        }

        .desktop-sidebar .logout-sidebar {
            color: #F3C623;
            font-weight: bold;
        }

        /* MOBILE NAVBAR */
        .navbar-admin {
            background-color: #0D0F28;
            box-shadow: 0 4px 15px rgba(0,0,0,0.15);
            padding: 12px 0;
            display: none;
        }

        .navbar-brand {
            display: flex;
            align-items: center;
            gap: 10px;
            color: white !important;
            font-weight: bold;
            font-size: 18px;
        }

        .logo-admin {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            object-fit: cover;
        }

        .navbar-toggler {
            border: 1px solid #F3C623;
            padding: 8px 12px;
        }

        .navbar-toggler:focus {
            box-shadow: none;
        }

        /* MOBILE SIDEBAR */
        .mobile-sidebar {
            position: fixed;
            top: 0;
            left: -290px;
            width: 280px;
            height: 100vh;
            background: #0D0F28;
            z-index: 9999;
            transition: 0.3s ease;
            padding: 20px;
            overflow-y: auto;
        }

        .mobile-sidebar.active {
            left: 0;
        }

        .sidebar-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            color: white;
            margin-bottom: 20px;
        }

        .sidebar-header button {
            background: none;
            border: none;
            color: white;
            font-size: 28px;
            line-height: 1;
        }

        .sidebar-logo {
            text-align: center;
            margin-bottom: 25px;
        }

        .sidebar-logo img {
            width: 85px;
            height: 85px;
            object-fit: cover;
            border-radius: 50%;
            margin-bottom: 10px;
        }

        .sidebar-logo h6 {
            color: white;
            font-weight: bold;
            margin: 0;
        }

        .mobile-sidebar a {
            display: block;
            color: white;
            text-decoration: none;
            padding: 13px 15px;
            border-radius: 10px;
            margin-bottom: 6px;
            transition: 0.3s;
            font-size: 15px;
        }

        .mobile-sidebar a:hover {
            background: #F3C623;
            color: #0D0F28;
        }

        .mobile-sidebar .logout-sidebar {
            color: #F3C623;
            font-weight: bold;
        }

        .sidebar-overlay {
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.55);
            z-index: 9998;
            display: none;
        }

        .sidebar-overlay.active {
            display: block;
        }

        /* Desktop */
        @media (min-width: 992px) {
            body {
                padding-top: 0;
            }

            .desktop-sidebar {
                display: block;
            }

            .navbar-admin,
            .mobile-sidebar,
            .sidebar-overlay {
                display: none !important;
            }

            .main-content {
                margin-left: 250px;
                width: calc(100% - 250px);
                padding: 40px;
            }
        }

        /* Tablet & HP */
        @media (max-width: 991px) {
            body {
                padding-top: 80px;
            }

            .desktop-sidebar {
                display: none;
            }

            .navbar-admin {
                display: flex;
            }

            .main-content {
                margin-left: 0;
                width: 100%;
                padding: 18px;
            }

            .navbar-brand {
                font-size: 15px;
            }

            .logo-admin {
                width: 40px;
                height: 40px;
            }
        }

        @media (max-width: 576px) {
            .main-content {
                padding: 15px 10px;
            }

            .navbar-brand span {
                font-size: 14px;
            }

            .container-fluid {
                padding-left: 16px !important;
                padding-right: 16px !important;
            }
        }
    </style>
</head>

<body>

<div class="desktop-sidebar">
    <h5 class="text-center mb-4">Admin Panel</h5>
    <a href="dashbordadm.php">Dashboard</a>
    <a href="paket_adm.php">Kelola Paket Pernikahan</a>
    <a href="pelanggan_adm.php">Kelola Data Pelanggan</a>
    <a href="pesanan_adm.php">Kelola Pesanan</a>
    <a href="jadwal_adm.php">Kelola Jadwal Acara</a>
    <a href="testimoni_adm.php">Kelola Testimoni</a>
    <a href="laporan_adm.php">Laporan Transaksi</a>
    <hr style="border-color: rgba(255,255,255,0.25);">
    <a href="login.php" class="logout-sidebar">Logout</a>
</div>

<div class="mobile-sidebar" id="mobileSidebar">
    <div class="sidebar-header">
        <strong>Menu Admin</strong>
        <button type="button" onclick="toggleSidebar()">×</button>
    </div>

    <div class="sidebar-logo">
        <img src="assets/img/profile foto syf wedding planners.jpeg" alt="Logo">
        <h6>Admin SYF Wedding</h6>
    </div>

    <a href="dashbordadm.php">Dashboard</a>
    <a href="paket_adm.php">Kelola Paket Pernikahan</a>
    <a href="pelanggan_adm.php">Kelola Data Pelanggan</a>
    <a href="pesanan_adm.php">Kelola Pesanan</a>
    <a href="jadwal_adm.php">Kelola Jadwal Acara</a>
    <a href="testimoni_adm.php">Kelola Testimoni</a>
    <a href="laporan_adm.php">Laporan Transaksi</a>

    <hr style="border-color: rgba(255,255,255,0.25);">

    <a href="login.php" class="logout-sidebar">Logout</a>
</div>

<div class="sidebar-overlay" id="sidebarOverlay" onclick="toggleSidebar()"></div>

<nav class="navbar navbar-dark fixed-top navbar-admin">
    <div class="container-fluid px-4">
        <a class="navbar-brand" href="dashbordadm.php">
            <img src="assets/img/profile foto syf wedding planners.jpeg" alt="Logo" class="logo-admin">
            <span>Admin SYF Wedding</span>
        </a>

        <button class="navbar-toggler" type="button" onclick="toggleSidebar()">
            <span class="navbar-toggler-icon"></span>
        </button>
    </div>
</nav>

<div class="main-content">

<script>
function toggleSidebar() {
    document.getElementById("mobileSidebar").classList.toggle("active");
    document.getElementById("sidebarOverlay").classList.toggle("active");
}
</script>