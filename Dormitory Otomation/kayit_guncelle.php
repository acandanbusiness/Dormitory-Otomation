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


if (isset($_POST["update"])) {
    $id = $_POST["update"];
    $ogrenci_adi = $_POST["ogrenci_adi"][$id];
    $ogrenci_soyadi = $_POST["ogrenci_soyadi"][$id];
    $ogrenci_no = $_POST["ogrenci_no"][$id];
    $ogrenci_tc = $_POST["ogrenci_tc"][$id];

    $sql = "UPDATE ogrenci SET ogrenci_adi='$ogrenci_adi', ogrenci_soyadı='$ogrenci_soyadı', ogrenci_no='$ogrenci_no', ogrenci_tc='$ogrenci_tc' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo "Kayıt güncellendi.";
    } else {
        echo "Hata: " . $conn->error;
    }
}


$sql = "SELECT * FROM ogrenci";
$result = $conn->query($sql);


$records = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $records[] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kayıt Güncelle</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <h1 class="text-center mt-5">Kayıt Güncelle</h1>
        <form action="kayit_guncelle.php" method="POST">
            <table class="table mt-4">
                <thead>
                    <tr>
                        <th scope="col">Öğrenci Adı</th>
                        <th scope="col">Öğrenci Soyadı</th>
                        <th scope="col">Öğrenci No</th>
                        <th scope="col">TC Kimlik No</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($records as $record) : ?>
                        <tr>
                            <td>
                                <input type="text" name="ogrenci_adi[<?php echo $record['id']; ?>]" value="<?php echo $record['ogrenci_adi']; ?>">
                            </td>
                            <td>
                                <input type="text" name="ogrenci_soyadi[<?php echo $record['id']; ?>]" value="<?php echo $record['ogrenci_soyadi']; ?>">
                            </td>
                            <td>
                                <input type="text" name="ogrenci_no[<?php echo $record['id']; ?>]" value="<?php echo $record['ogrenci_no']; ?>">
                            </td>
                            <td>
                                <input type="text" name="ogrenci_tc[<?php echo $record['id']; ?>]" value="<?php echo $record['ogrenci_tc']; ?>">
                            </td>
                            <td>
                                <button type="submit" class="btn btn-primary" name="update" value="<?php echo $record['id']; ?>">Kaydet</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@1.0.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</body>

</html>
