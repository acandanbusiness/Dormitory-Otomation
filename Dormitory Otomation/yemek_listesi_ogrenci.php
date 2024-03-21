<?php

$servername = "localhost";
$username = "root";
$password = "abdullah";
$dbname = "otomasyon";

$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Veritabanına bağlanırken hata oluştu: " . $conn->connect_error);
}



$sqlRecent = "SELECT * FROM yemek ORDER BY tarih DESC LIMIT 8";
$resultRecent = $conn->query($sqlRecent);

$yemekListeleri = array();

if ($resultRecent->num_rows > 0) {
    while ($row = $resultRecent->fetch_assoc()) {
        $row['tarih'] = date('d.m.Y', strtotime($row['tarih']));
        $yemekListeleri[] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yemek Listesi</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <h1 class="text-center mt-5">Yemek Listesi</h1>



        
        <div class="mt-5">
            <?php if (count($yemekListeleri) > 0) : ?>
                <?php foreach ($yemekListeleri as $yemek) : ?>
                    <div class="card mt-3">
                        <div class="card-body">
                            <h5 class="card-title">Tarih: <?php echo $yemek['tarih']; ?></h5>
                            <p class="card-text"><?php echo $yemek['liste']; ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</body>

</html>

<?php

$conn->close();
?>
