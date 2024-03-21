<?php

$servername = "localhost";
$username = "root";
$password = "abdullah";
$dbname = "otomasyon";

$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Veritabanına bağlanırken hata oluştu: " . $conn->connect_error);
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tarih = $_POST["tarih"];
    $yemekListesi = $_POST["yemekListesi"];

   
    $sql = "SELECT * FROM yemek WHERE tarih = '$tarih'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        
        $sqlUpdate = "UPDATE yemek SET liste = '$yemekListesi' WHERE tarih = '$tarih'";
        if ($conn->query($sqlUpdate) === TRUE) {
            echo "Yemek listesi başarıyla güncellendi.";
        } else {
            echo "Yemek listesi güncellenirken hata oluştu: " . $conn->error;
        }
    } else {
        
        $sqlInsert = "INSERT INTO yemek (tarih, liste) VALUES ('$tarih', '$yemekListesi')";
        if ($conn->query($sqlInsert) === TRUE) {
            echo "Yemek listesi başarıyla eklendi.";
        } else {
            echo "Yemek listesi eklenirken hata oluştu: " . $conn->error;
        }
    }
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

       
        <div class="mt-4">
            <form method="POST">
                <div class="form-group">
                    <label for="tarih">Tarih</label>
                    <input type="date" class="form-control" id="tarih" name="tarih" required>
                </div>
                <div class="form-group">
                    <label for="yemekListesi">Yemek Listesi</label>
                    <textarea class="form-control" id="yemekListesi" name="yemekListesi" rows="5" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Onayla</button>
            </form>
        </div>

        
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
