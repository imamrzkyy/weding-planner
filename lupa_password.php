<?php
include 'config.php';

if (isset($_POST['btnUbah'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $passwordBaru = mysqli_real_escape_string($conn, $_POST['password_baru']);
    $konfirmasiPassword = mysqli_real_escape_string($conn, $_POST['konfirmasi_password']);

    if ($passwordBaru != $konfirmasiPassword) {
        $status = "beda";
    } else {
        $cek = mysqli_query($conn, "SELECT * FROM pelanggan WHERE email='$email'");

        if (mysqli_num_rows($cek) > 0) {
            mysqli_query($conn, "UPDATE pelanggan SET password='$passwordBaru' WHERE email='$email'");
            $status = "berhasil";
        } else {
            $status = "email_tidak_ada";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Password</title>

    <link rel="icon" type="image/jpeg" href="/w.o/assets/img/profile%20foto%20syf%20wedding%20planners.jpeg?v=999">
    <link rel="shortcut icon" type="image/jpeg" href="/w.o/assets/img/profile%20foto%20syf%20wedding%20planners.jpeg?v=999">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
    body {
        background-image: url('assets/img/bg_login.jpg');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
    }

    .reset-card {
        border: none;
        border-radius: 20px;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
    }

    .form-control:focus {
        border-color: #F3C623;
        box-shadow: 0 0 0 0.2rem rgba(243, 198, 35, 0.25);
    }

    .btn-orange {
        background-color: #F3C623;
        color: white;
    }

    .btn-orange:hover {
        background-color: rgb(237, 210, 152);
        color: white;
    }

    .back-link {
        text-decoration: none;
        color: #0D0F2B;
        font-size: 14px;
    }

    .back-link:hover {
        color: #F3C623;
    }
    </style>
</head>

<body>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card reset-card p-4">

                <div class="text-center mb-4">
                    <img src="assets/img/profile foto syf wedding planners.jpeg" 
                         alt="Logo Wedding Organizer" 
                         class="img-fluid" 
                         style="max-width: 80px;">
                    <h4 class="mt-3">Lupa Password</h4>
                    <small class="text-muted">Silakan buat password baru Anda</small>
                </div>

                <form method="POST" action="">
                    <div class="mb-3">
                        <label class="form-label">Email Terdaftar</label>
                        <input type="email" name="email" class="form-control"
                               placeholder="Masukkan email terdaftar" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Password Baru</label>
                        <div class="input-group">
                            <input type="password" name="password_baru" id="passwordBaru"
                                   class="form-control" placeholder="Masukkan password baru" required>
                            <button class="btn btn-outline-secondary" type="button" id="togglePasswordBaru">
                                <i class="bi bi-eye-slash" id="iconPasswordBaru"></i>
                            </button>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Konfirmasi Password Baru</label>
                        <div class="input-group">
                            <input type="password" name="konfirmasi_password" id="konfirmasiPassword"
                                   class="form-control" placeholder="Ulangi password baru" required>
                            <button class="btn btn-outline-secondary" type="button" id="toggleKonfirmasiPassword">
                                <i class="bi bi-eye-slash" id="iconKonfirmasiPassword"></i>
                            </button>
                        </div>
                    </div>

                    <div class="d-grid">
                        <button type="submit" name="btnUbah" class="btn btn-orange">
                            Ubah Password
                        </button>
                    </div>
                </form>

                <div class="mt-3 text-center">
                    <a href="login.php" class="back-link">Kembali ke Login</a>
                </div>

            </div>
        </div>
    </div>
</div>

<script>
function togglePassword(inputId, iconId) {
    const input = document.getElementById(inputId);
    const icon = document.getElementById(iconId);

    if (input.type === "password") {
        input.type = "text";
        icon.classList.remove("bi-eye-slash");
        icon.classList.add("bi-eye");
    } else {
        input.type = "password";
        icon.classList.remove("bi-eye");
        icon.classList.add("bi-eye-slash");
    }
}

document.getElementById("togglePasswordBaru").addEventListener("click", function () {
    togglePassword("passwordBaru", "iconPasswordBaru");
});

document.getElementById("toggleKonfirmasiPassword").addEventListener("click", function () {
    togglePassword("konfirmasiPassword", "iconKonfirmasiPassword");
});
</script>

<?php if (isset($status) && $status == "berhasil"): ?>
<script>
Swal.fire({
    icon: 'success',
    title: 'Berhasil!',
    text: 'Password berhasil diubah. Silakan login kembali.',
    confirmButtonColor: '#F3C623'
}).then(function() {
    window.location.href = 'login.php';
});
</script>
<?php endif; ?>

<?php if (isset($status) && $status == "beda"): ?>
<script>
Swal.fire({
    icon: 'warning',
    title: 'Password Tidak Sama!',
    text: 'Password baru dan konfirmasi password harus sama.',
    confirmButtonColor: '#F3C623'
});
</script>
<?php endif; ?>

<?php if (isset($status) && $status == "email_tidak_ada"): ?>
<script>
Swal.fire({
    icon: 'error',
    title: 'Email Tidak Ditemukan!',
    text: 'Email yang Anda masukkan belum terdaftar.',
    confirmButtonColor: '#F3C623'
});
</script>
<?php endif; ?>

</body>
</html>