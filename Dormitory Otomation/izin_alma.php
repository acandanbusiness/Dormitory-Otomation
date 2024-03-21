<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>İzin Talebi</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <h1 class="mt-4">İzin Talebi</h1>

        <?php

        $servername = "localhost";
        $username = "root";
        $password = "abdullah";
        $dbname = "otomasyon";

        
        $conn = new mysqli($servername, $username, $password, $dbname);

        
        if ($conn->connect_error) {
            die("Veritabanı bağlantısı başarısız: " . $conn->connect_error);

    
        }

        session_start();


if (!isset($_SESSION['ogrenci_adi'])) {
    
    header("Location: ogrenci_giris.php");
    exit;
}

$ogrenciAdi = $_SESSION['ogrenci_adi'];
$ogrenciSoyadi = $_SESSION['ogrenci_soyadi'];
$ogrenciNo = $_SESSION['ogrenci_no'];
$ogrenciTc = $_SESSION['ogrenci_tc'];




        
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $baslangic = $_POST["baslangic"];
            $bitis = $_POST["bitis"];
            $metin = $_POST["metin"];

            
            $sql = "INSERT INTO izin (baslangic, bitis, metin) VALUES ('$baslangic', '$bitis', '$metin')";

            if ($conn->query($sql) === TRUE) {
                echo "<div class='alert alert-success'>İzin talebi başarıyla gönderildi.</div>";
            } else {
                echo "<div class='alert alert-danger'>İzin talebi gönderilirken hata oluştu: " . $conn->error . "</div>";
            }
        }

        
        $conn->close();
        ?>

        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <div class="form-group">
                <label for="baslangic">Başlangıç Tarihi:</label>
                <input type="date" class="form-control" id="baslangic" name="baslangic">
            </div>

            <div class="form-group">
                <label for="bitis">Bitiş Tarihi:</label>
                <input type="date" class="form-control" id="bitis" name="bitis">
            </div>

            <div class="form-group">
                <label for="metin">Metin:</label>
                <textarea class="form-control" id="metin" name="metin" rows="4"></textarea>
            </div>

            <button type="submit" class="btn btn-primary">İzin Talebi Gönder</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/js/bootstrap.min.js"></script>
</body>

</html>
