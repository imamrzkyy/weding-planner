<?php
include 'config.php';
session_start();

if (isset($_POST['btnLogin'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $sql_admin = "SELECT * FROM admin WHERE email_admin='$email' AND password_admin='$password'";
    $query_admin = mysqli_query($conn, $sql_admin);

    $sql_pelanggan = "SELECT * FROM pelanggan WHERE email='$email' AND password='$password'";
    $query_pelanggan = mysqli_query($conn, $sql_pelanggan);

    if (mysqli_num_rows($query_admin) == 1) {
        $data = mysqli_fetch_assoc($query_admin);

        $_SESSION["ses_id"] = $data["id_admin"];
        $_SESSION["ses_nama"] = $data["nama_admin"];
        $_SESSION["ses_email"] = $data["email_admin"];
        $_SESSION["ses_level"] = "admin";

        echo "
        <!DOCTYPE html>
        <html>
        <head>
            <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        </head>
        <body>
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Login Berhasil!',
                    text: 'Selamat datang Admin',
                    timer: 2000,
                    timerProgressBar: true,
                    showConfirmButton: false
                }).then(function() {
                    window.location.href = 'dashbordadm.php';
                });
            </script>
        </body>
        </html>";
        exit();

    } elseif (mysqli_num_rows($query_pelanggan) == 1) {
        $data = mysqli_fetch_assoc($query_pelanggan);

        $_SESSION["ses_id"] = $data["idPelanggan"];
        $_SESSION["ses_nama"] = $data["nama"];
        $_SESSION["ses_email"] = $data["email"];
        $_SESSION["ses_level"] = $data["ses_level"];

        echo "
        <!DOCTYPE html>
        <html>
        <head>
            <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        </head>
        <body>
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Login Berhasil!',
                    text: 'Selamat datang, {$data['nama']}',
                    timer: 2000,
                    timerProgressBar: true,
                    showConfirmButton: false
                }).then(function() {
                    window.location.href = 'index.php';
                });
            </script>
        </body>
        </html>";
        exit();

    } else {
        $error_message = true;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - Wedding Organizer</title>

    <link rel="icon" type="image/jpeg" href="/w.o/assets/img/profile%20foto%20syf%20wedding%20planners.jpeg?v=999">
    <link rel="shortcut icon" type="image/jpeg" href="/w.o/assets/img/profile%20foto%20syf%20wedding%20planners.jpeg?v=999">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

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

    .login-card {
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

    .forgot-link {
        font-size: 14px;
        text-decoration: none;
        color: #0D0F2B;
    }

    .forgot-link:hover {
        color: #F3C623;
    }
    </style>
</head>

<body>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card login-card p-4">
                <div class="text-center mb-4">
                    <img src="assets/img/profile foto syf wedding planners.jpeg" alt="Logo Wedding Organizer"
                        class="img-fluid" style="max-width: 80px;">
                </div>

                <form method="POST" action="">
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email"
                            placeholder="Masukkan email" required>
                    </div>

                    <div class="mb-2">
                        <label for="password" class="form-label">Kata Sandi</label>
                        <div class="input-group">
                            <input type="password" class="form-control" id="password" name="password"
                                placeholder="••••••••" required>
                            <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                <i class="bi bi-eye-slash" id="iconPassword"></i>
                            </button>
                        </div>
                    </div>

                    <div class="text-end mb-3">
                        <a href="lupa_password.php" class="forgot-link">Lupa Password?</a>
                    </div>

                    <div class="d-grid">
                        <button type="submit" name="btnLogin" class="btn btn-orange">Masuk</button>
                    </div>
                </form>

                <div class="mt-3 text-center">
                    <small>Belum punya akun? <a href="register.php">Daftar</a></small>
                </div>
            </div>
        </div>
    </div>
</div>

<?php if (!empty($error_message)): ?>
<script>
document.addEventListener("DOMContentLoaded", function() {
    Swal.fire({
        icon: 'error',
        title: 'Login Gagal!',
        text: 'Email atau password salah!',
        confirmButtonColor: '#F3C623'
    });
});
</script>
<?php endif; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
document.getElementById("togglePassword").addEventListener("click", function () {
    const passwordInput = document.getElementById("password");
    const iconPassword = document.getElementById("iconPassword");

    if (passwordInput.type === "password") {
        passwordInput.type = "text";
        iconPassword.classList.remove("bi-eye-slash");
        iconPassword.classList.add("bi-eye");
    } else {
        passwordInput.type = "password";
        iconPassword.classList.remove("bi-eye");
        iconPassword.classList.add("bi-eye-slash");
    }
});
</script>

</body>
</html>