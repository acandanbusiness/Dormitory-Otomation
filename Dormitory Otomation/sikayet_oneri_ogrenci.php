<?php
session_start();


$servername = "localhost";
$username = "root";
$password = "abdullah";
$dbname = "otomasyon";


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Veritabanına bağlanılamadı: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $metin = $_POST["metin"];
    $tarih = date("Y-m-d"); 

    
    $sql = "INSERT INTO sikayet (metin, tarih, okundu) VALUES ('$metin', '$tarih', 0)";
    if ($conn->query($sql) === TRUE) {
        echo "Şikayet veya öneri başarıyla gönderildi.";
    } else {
        echo "Hata: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <title>Şikayet veya Öneriniz</title>
    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <h2>Şikayet veya Öneriniz</h2>
        <form action="sikayet_oneri_ogrenci.php" method="POST">
            <div class="form-group">
                
                <textarea class="form-control" name="metin" id="metin" rows="5"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Gönder</button>
        </form>
    </div>

    
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>

</html>
