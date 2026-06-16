<?php
$host = getenv('DB_HOST') ? : "127.0.0.1";
$user = getenv('DB_USERNAME') ? : "root";
$password = getenv('DB_PASSWORD') ? : "";
$database = getenv('DB_DATABASE') ? : "wo_web";
$port = getenv('DB_PORT') ? : 3306;


$conn = new mysqli($host, $user, $password, $database, $port);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>