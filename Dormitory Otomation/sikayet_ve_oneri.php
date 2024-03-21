<?php

$servername = "localhost";
$username = "root";
$password = "abdullah";
$dbname = "otomasyon";

$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Veritabanına bağlanırken hata oluştu: " . $conn->connect_error);
}


$sql = "SELECT * FROM sikayet WHERE okundu = 0 ORDER BY tarih DESC";
$result = $conn->query($sql);


$sql2 = "SELECT * FROM sikayet WHERE okundu = 1 ORDER BY tarih DESC";
$result2 = $conn->query($sql2);


$sikayetler = array();
$oneler = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $row['tarih'] = date('d.m.Y', strtotime($row['tarih']));
        $sikayetler[] = $row;
    }
}

if ($result2->num_rows > 0) {
    while ($row2 = $result2->fetch_assoc()) {
        $row2['tarih'] = date('d.m.Y', strtotime($row2['tarih']));
        $oneler[] = $row2;
    }
}
?>

<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Şikayet ve Öneriler</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <h1 class="text-center mt-5">       </h1>

         
        <?php if (count($sikayetler) > 0) : ?>
            <h2 class="mt-4">Okunmamış Şikayetler</h2>
            <?php foreach ($sikayetler as $sikayet) : ?>
                <div class="card mt-3">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $sikayet['baslik']; ?></h5>
                        <p class="card-text"><?php echo $sikayet['metin']; ?></p>
                        <p class="card-text text-right"><?php echo $sikayet['tarih']; ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>

         
        <?php if (count($oneler) > 0) : ?>
            <h2 class="mt-4">Okunmuş Şikayetler</h2>
            <?php foreach ($oneler as $oneri) : ?>
                <div class="card mt-3">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $oneri['baslik']; ?></h5>
                        <p class="card-text"><?php echo $oneri['metin']; ?></p>
                        <p class="card-text text-right"><?php echo $oneri['tarih']; ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</body>

</html>
