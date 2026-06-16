<?php
include "config.php";
session_start();

if (isset($_POST['btnRegister'])) {

    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $alamat = mysqli_real_escape_string($conn, $_POST['alamat']);
    $telepon = mysqli_real_escape_string($conn, $_POST['telepon']);

    if ($password != $confirm_password) {

        $error_message = "Konfirmasi kata sandi tidak sesuai!";

    } else {

        $check_user = mysqli_query($conn, "SELECT * FROM pelanggan WHERE email='$email'");

        if (mysqli_num_rows($check_user) > 0) {

            $error_message = "Email sudah digunakan!";

        } else {

            $query = mysqli_query($conn, "SELECT idPelanggan FROM pelanggan ORDER BY idPelanggan DESC LIMIT 1");
            $last_id = mysqli_fetch_assoc($query);

            $last_id_pelanggan = $last_id ? $last_id['idPelanggan'] : 'P000';

            $last_num = intval(substr($last_id_pelanggan, 1)) + 1;
            $new_id = 'P' . str_pad($last_num, 3, '0', STR_PAD_LEFT);

            $password_hash = password_hash($password, PASSWORD_DEFAULT);

            $insert = mysqli_query($conn, "
                INSERT INTO pelanggan
                (idPelanggan, nama, email, password, alamat, telepon)
                VALUES
                ('$new_id','$nama','$email','$password','$alamat','$telepon')
            ");

            if ($insert) {

                echo "
                <script>
                    alert('Registrasi berhasil! Silakan login.');
                    window.location.href='login.php';
                </script>";
                exit();

            } else {

                $error_message = "Gagal mendaftar. Coba lagi.";

            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Register - Wedding Organizer</title>

<link rel="icon" type="image/jpeg" href="/w.o/assets/img/profile%20foto%20syf%20wedding%20planners.jpeg?v=999">

<link rel="shortcut icon" type="image/jpeg" href="/w.o/assets/img/profile%20foto%20syf%20wedding%20planners.jpeg?v=999">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

body{
    background-image:url('assets/img/bg_login.jpg');
    background-size:cover;
    background-position:center;
    background-repeat:no-repeat;
    min-height:100vh;
}

.container{
    margin-top:100px;
    margin-bottom:30px;
}

.login-card{
    border:none;
    border-radius:18px;
    box-shadow:0 8px 20px rgba(0,0,0,0.2);
}

.logo-img{
    max-width:95px;
}

.form-label{
    font-size:14px;
    margin-bottom:4px;
}

.form-control{
    height:38px;
    font-size:14px;
    padding:6px 12px;
}

.form-control:focus{
    border-color:#F3C623;
    box-shadow:0 0 0 0.2rem rgba(243,198,35,.25);
}

.btn-orange{
    background:#F3C623;
    color:white;
    font-weight:600;
    padding:8px;
}

.btn-orange:hover{
    background:rgb(237,210,152);
    color:white;
}

.alert{
    padding:8px 12px;
    font-size:14px;
}

.card-title{
    font-size:20px;
    font-weight:600;
}

small{
    font-size:13px;
}

</style>

</head>
<body>

<div class="container">

    <div class="row justify-content-center align-items-center">

        <div class="col-lg-4 col-md-5 col-sm-8">

            <div class="card login-card p-3">

                <div class="text-center mb-3">

                    <img src="assets/img/profile foto syf wedding planners.jpeg"
                         alt="Logo"
                         class="img-fluid logo-img">

                </div>

                <h5 class="text-center card-title mb-3">
                    Registrasi Akun
                </h5>

                <?php if(isset($error_message)){ ?>
                    <div class="alert alert-danger">
                        <?= $error_message ?>
                    </div>
                <?php } ?>

                <form method="POST">

                    <div class="mb-2">
                        <label class="form-label">Nama Lengkap</label>
                        <input type="text"
                               class="form-control"
                               name="nama"
                               placeholder="Masukkan nama lengkap"
                               required>
                    </div>

                    <div class="mb-2">
                        <label class="form-label">Email</label>
                        <input type="email"
                               class="form-control"
                               name="email"
                               placeholder="you@gmail.com"
                               required>
                    </div>

                    <div class="mb-2">
                        <label class="form-label">Kata Sandi</label>
                        <input type="password"
                               class="form-control"
                               name="password"
                               placeholder="Masukkan kata sandi"
                               required>
                    </div>

                    <div class="mb-2">
                        <label class="form-label">Konfirmasi Kata Sandi</label>
                        <input type="password"
                               class="form-control"
                               name="confirm_password"
                               placeholder="Ulangi kata sandi"
                               required>
                    </div>

                    <div class="mb-2">
                        <label class="form-label">Alamat</label>
                        <input type="text"
                               class="form-control"
                               name="alamat"
                               placeholder="Masukkan alamat"
                               required>
                    </div>

                    <div class="mb-2">
                        <label class="form-label">No Telepon</label>
                        <input type="tel"
                               class="form-control"
                               name="telepon"
                               placeholder="081234567890"
                               pattern="[0-9]{10,15}"
                               required>
                    </div>

                    <div class="d-grid mt-3">
                        <button type="submit"
                                name="btnRegister"
                                class="btn btn-orange">
                            Daftar
                        </button>
                    </div>

                    <div class="text-center mt-3">
                        <small>
                            Sudah punya akun?
                            <a href="login.php">Login</a>
                        </small>
                    </div>

                </form>

            </div>

        </div>

    </div>

</div>

</body>
</html>