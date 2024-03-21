<?php

$servername = "localhost";
$username = "root";
$password = "abdullah";
$dbname = "otomasyon";


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Veritabanı bağlantısı başarısız oldu: " . $conn->connect_error);
}

session_start();


if (!isset($_SESSION['ogrenci_adi'])) {
   
    die("Yetkisiz erişim.");
}

$ogrenciAdi = $_SESSION['ogrenci_adi'];
$ogrenciSoyadi = $_SESSION['ogrenci_soyadi'];
$ogrenciNo = $_SESSION['ogrenci_no'];
$ogrenciTc = $_SESSION['ogrenci_tc'];


$servername = "localhost";
$username = "root";
$password = "abdullah";
$dbname = "otomasyon";






$baslangic = $_POST['baslangic'];
$bitis = $_POST['bitis'];
$metin = $_POST['metin'];
$ogrenciAdi = "Öğrenci Adı"; 
$ogrenciSoyadi = "Öğrenci Soyadı";
$ogrenciNo = "Öğrenci No";


$sql = "INSERT INTO izin (baslangic, bitis, metin, ogrenci_adi, ogrenci_soyadi, ogrenci_no)
        VALUES ('$baslangic', '$bitis', '$metin', '$ogrenciAdi', '$ogrenciSoyadi', '$ogrenciNo')";

if ($conn->query($sql) === TRUE) {
    echo "İzin talebi başarıyla eklendi";
} else {
    echo "İzin talebi eklenirken hata oluştu: " . $conn->error;
}


$conn->close();
?>
