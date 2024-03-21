<?php
session_start();


$veli_tc = $_SESSION['veli_tc'];
$ogrenci_tc = $_SESSION['ogrenci_tc'];


$servername = "localhost";
$username = "root";
$password = "abdullah";
$dbname = "otomasyon";


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Veritabanına bağlanırken hata oluştu: " . $conn->connect_error);
}


$veli_adi = "";
$veli_soyadi = "";

$sql = "SELECT veli_adi, veli_soyadi FROM veli WHERE veli_tc = '$veli_tc'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $veli_adi = $row['veli_adi'];
        $veli_soyadi = $row['veli_soyadi'];
    }
}


$ogrenci_adi = "";
$ogrenci_soyadi = "";
$ogrenci_no = "";

$sql = "SELECT ogrenci_adi, ogrenci_soyadi, ogrenci_no FROM ogrenci WHERE ogrenci_tc = '$ogrenci_tc'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $ogrenci_adi = $row['ogrenci_adi'];
        $ogrenci_soyadi = $row['ogrenci_soyadi'];
        $ogrenci_no = $row['ogrenci_no'];
    }
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   

  
    $mesaj = $_POST['mesaj'];

    

    
    $sql = "INSERT INTO iletisim (veli_adi, veli_soyadi, veli_tc, ogrenci_adi, ogrenci_soyadi, ogrenci_no, mesaj) VALUES ('$veli_adi', '$veli_soyadi', '$veli_tc', '$ogrenci_adi', '$ogrenci_soyadi', '$ogrenci_no', '$mesaj')";
    if ($conn->query($sql) === TRUE) {
        echo "Mesajınız başarıyla iletilmiştir.";
    } else {
        echo "Mesajı ileterken hata oluştu: " . $conn->error;
    }
}


$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Veli İletişim</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <h1>Veli İletişim</h1>
        <p>Merhaba <?php echo $veli_adi . " " . $veli_soyadi; ?>, buradan admin ile iletişime geçebilirsiniz.</p>
        <form method="POST" action="">
            <div class="form-group">
                <label for="mesaj">Mesajınız:</label>
                <textarea class="form-control" id="mesaj" name="mesaj" rows="5" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Gönder</button>
        </form>
    </div>
</body>

</html>
