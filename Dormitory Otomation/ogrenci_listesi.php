<?php

$servername = "localhost";
$username = "root";
$password = "abdullah";
$dbname = "otomasyon";

$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Veritabanına bağlanırken hata oluştu: " . $conn->connect_error);
}


$sql = "SELECT ogrenci.ogrenci_adi, ogrenci.ogrenci_soyadi, ogrenci.ogrenci_no, ogrenci.ogrenci_tc, veli.veli_adi, veli.veli_soyadi, veli.veli_tc
        FROM ogrenci
        INNER JOIN veli ON ogrenci.ogrenci_veli_tc = veli.veli_tc";

$result = $conn->query($sql);

$ogrenciler = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $ogrenci = array(
            'ogrenci_adi' => $row['ogrenci_adi'],
            'ogrenci_soyadi' => $row['ogrenci_soyadi'],
            'ogrenci_no' => $row['ogrenci_no'],
            'ogrenci_tc' => $row['ogrenci_tc'],
            'veli_adi' => $row['veli_adi'],
            'veli_soyadi' => $row['veli_soyadi'],
            'veli_tc' => $row['veli_tc']
        );
        $ogrenciler[] = $ogrenci;
    }
}
?>

<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Öğrenci Listesi</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>

<body>
    <div class="container">
        <h1 class="text-center mt-5">Öğrenci Listesi</h1>

        
        <div class="row mt-4">
            <div class="col-md-6 offset-md-3">
                <input type="text" id="arama" class="form-control" placeholder="Öğrenci Ara">
            </div>
        </div>

        
        <div class="row mt-4" id="ogrenci-listesi">
            <?php foreach ($ogrenciler as $ogrenci) : ?>
                <div class="col-md-12 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $ogrenci['ogrenci_adi']; ?> <?php echo $ogrenci['ogrenci_soyadi']; ?></h5>
                            <p class="card-text">Öğrenci No: <?php echo $ogrenci['ogrenci_no']; ?></p>
                            <p class="card-text">Öğrenci TC: <?php echo $ogrenci['ogrenci_tc']; ?></p>
                            <p class="card-text">Veli Adı: <?php echo $ogrenci['veli_adi']; ?></p>
                            <p class="card-text">Veli Soyadı: <?php echo $ogrenci['veli_soyadi']; ?></p>
                            <p class="card-text">Veli TC: <?php echo $ogrenci['veli_tc']; ?></p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            
            $('#arama').on('keyup', function() {
                var value = $(this).val().toLowerCase();
                $('#ogrenci-listesi .card').filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
    </script>
</body>

</html>
