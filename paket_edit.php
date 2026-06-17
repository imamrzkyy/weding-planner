<?php
include 'config.php';

$id = $_GET['id'] ?? '';

$data = $conn->query("SELECT * FROM paketpernikahan WHERE idPaket = '$id'")->fetch_assoc();

if (!$data) {
    echo "Data paket tidak ditemukan.";
    exit;
}

if (isset($_POST['update'])) {
    $nama = $_POST['namaPaket'];
    $deskripsi = $_POST['deskripsi'];
    $harga = $_POST['harga'];

    $query = "UPDATE paketpernikahan SET 
                namaPaket = '$nama', 
                deskripsi = '$deskripsi', 
                harga = '$harga' 
              WHERE idPaket = '$id'";

    if ($conn->query($query)) {
        header("Location: paket_admin.php");
        exit;
    } else {
        echo "Gagal update: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Paket</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #f5f5f5;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .edit-card {
            width: 100%;
            max-width: 650px;
            border: none;
            border-radius: 20px;
            box-shadow: 0 8px 25px rgba(0,0,0,0.12);
        }

        .btn-maroon {
            background-color: #0D0F2B;
            color: white;
        }

        .btn-maroon:hover {
            background-color: #F3C623;
            color: #0D0F2B;
        }

        .form-control:focus {
            border-color: #F3C623;
            box-shadow: 0 0 0 0.2rem rgba(243,198,35,.25);
        }

        @media (max-width: 576px) {
            body {
                align-items: flex-start;
                padding-top: 30px;
            }

            .edit-card {
                border-radius: 15px;
            }

            .card-body {
                padding: 20px !important;
            }

            h4 {
                font-size: 20px;
            }
        }
    </style>
</head>

<body>

<div class="card edit-card">
    <div class="card-body p-4">

        <h4 class="fw-bold text-center mb-4">Edit Paket Pernikahan</h4>

        <form method="POST">

            <div class="mb-3">
                <label class="form-label">Nama Paket</label>
                <input type="text" name="namaPaket" class="form-control"
                       value="<?= htmlspecialchars($data['namaPaket']) ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Deskripsi</label>
                <textarea name="deskripsi" class="form-control" rows="5" required><?= htmlspecialchars($data['deskripsi']) ?></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Harga</label>
                <input type="number" name="harga" class="form-control"
                       value="<?= htmlspecialchars($data['harga']) ?>" required>
            </div>

            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <a href="paket_admin.php" class="btn btn-secondary">Kembali</a>
                <button type="submit" name="update" class="btn btn-maroon">Simpan</button>
            </div>

        </form>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html> 