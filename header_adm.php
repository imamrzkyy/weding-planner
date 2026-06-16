<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Admin</title>
    <link rel="icon" type="image/jpeg"
          href="assets/img/profile%20foto%20syf%20wedding%20planners.jpeg?v=99">

    <link rel="shortcut icon" type="image/jpeg"
          href="assets/img/profile%20foto%20syf%20wedding%20planners.jpeg?v=99">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.css' rel='stylesheet' />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.css' rel='stylesheet' />
    <style>
    body { background-color: #f4f7fe; margin: 0; padding: 0; }
    
    /* 1. Sidebar Fixed - Jangan gunakan col-md-2 di sini */
    .sidebar { 
        background: #0D0F28; 
        color: #fff; 
        height: 100vh; 
        position: fixed; 
        width: 250px; 
        left: 0;
        top: 0;
        z-index: 1000;
        padding-top: 20px;
    }
    
    .sidebar a { 
        color: white; 
        text-decoration: none; 
        display: block; 
        padding: 12px 20px; 
        transition: 0.3s; 
    }
    
    .sidebar a:hover { 
        background-color: #a52a2a; 
        padding-left: 30px; 
    }
    
    /* 2. Main Content - Inilah kunci agar konten terdorong ke kanan */
    .main-content { 
        margin-left: 250px; /* Harus sama dengan lebar sidebar */
        padding: 40px;      
        min-height: 100vh;
        width: calc(100% - 250px); /* Mengambil sisa lebar layar */
    }

    .bg-maroon { background-color: #0D0F28 !important; color: white; }
    </style>
</head>
<body>

<!-- Sidebar tanpa class 'col-md-2' agar tidak bentrok dengan CSS fixed -->
<div class="sidebar">
    <h5 class="text-center mb-4">Admin Panel</h5>
    <a href="dashbordadm.php">Dashboard</a>
    <a href="paket_adm.php">Kelola Paket Pernikahan</a>
    <a href="pelanggan_adm.php">Kelola Data Pelanggan</a>
    <a href="pesanan_adm.php">Kelola Pesanan</a>
    <a href="jadwal_adm.php">Kelola Jadwal Acara</a>
    <a href="testimoni_adm.php">Kelola Testimoni</a>
    <a href="laporan_adm.php">Laporan Transaksi</a>
    <hr>
    <a href="login.php" class="text-warning">Logout</a>
</div>

<!-- Main content yang akan otomatis menampung isi dari file lain -->
<div class="main-content">