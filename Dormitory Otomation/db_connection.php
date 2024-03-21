<?php
$servername = "localhost";
$username = "root";
$password = "abdullah";
$dbname = "otomasyon";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Veritabanı bağlantısı başarısız: " . $conn->connect_error);
}
?>
