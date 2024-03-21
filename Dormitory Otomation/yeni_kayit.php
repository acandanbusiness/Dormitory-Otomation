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


if ($_SESSION["user_type"] !== "admin") {
    header("Location: admin_giris.php");
    exit();
}


if (isset($_GET["id"])) {
    $ogrenci_id = $_GET["id"];

    
    $sql = "SELECT * FROM ogrenci WHERE id = $ogrenci_id";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $ogrenci_adi = $row["ogrenci_adi"];
        $ogrenci_soyadi = $row["ogrenci_soyadi"];
        $ogrenci_no = $row["ogrenci_no"];
        $ogrenci_tc = $row["ogrenci_tc"];
        $ogrenci_veli_tc = $row["ogrenci_veli_tc"];

        
        $sql = "SELECT * FROM veli WHERE veli_tc = '$ogrenci_veli_tc'";
        $result = $conn->query($sql);

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $veli_adi = $row["veli_adi"];
            $veli_soyadi = $row["veli_soyadi"];
        } else {
            $veli_adi = "";
            $veli_soyadi = "";
        }
    } else {
        echo "Öğrenci bulunamadı.";
        exit();
    }
} else {
    $ogrenci_adi = "";
    $ogrenci_soyadi = "";
    $ogrenci_no = "";
    $ogrenci_tc = "";
    $ogrenci_veli_tc = "";
    $veli_adi = "";
    $veli_soyadi = "";
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ogrenci_adi = $_POST["ogrenci_adi"];
    $ogrenci_soyadi = $_POST["ogrenci_soyadi"];
    $ogrenci_no = $_POST["ogrenci_no"];
    $ogrenci_tc = $_POST["ogrenci_tc"];
    $ogrenci_veli_tc = $_POST["ogrenci_veli_tc"];
    $veli_adi = $_POST["veli_adi"];
    $veli_soyadi = $_POST["veli_soyadi"];

    if (isset($_POST["ogrenci_id"])) {
        
        $ogrenci_id = $_POST["ogrenci_id"];

        
        $sql = "UPDATE ogrenci SET ogrenci_adi = '$ogrenci_adi', ogrenci_soyadi = '$ogrenci_soyadi', ogrenci_no = '$ogrenci_no', ogrenci_tc = '$ogrenci_tc', ogrenci_veli_tc = '$ogrenci_veli_tc' WHERE id = $ogrenci_id";
        if ($conn->query($sql) === TRUE) {
            echo "Kayıt güncellendi.";
        } else {
            echo "Kayıt güncellenirken hata oluştu: " . $conn->error;
        }

        
        $sql = "SELECT * FROM veli WHERE veli_tc = '$ogrenci_veli_tc'";
        $result = $conn->query($sql);

        if ($result->num_rows == 1) {
            
            $sql = "UPDATE veli SET veli_adi = '$veli_adi', veli_soyadi = '$veli_soyadi' WHERE veli_tc = '$ogrenci_veli_tc'";
            if ($conn->query($sql) !== TRUE) {
                echo "Veli kaydı güncellenirken hata oluştu: " . $conn->error;
            }
        } else {
            
            $sql = "INSERT INTO veli (veli_adi, veli_soyadi, veli_tc) VALUES ('$veli_adi', '$veli_soyadi', '$ogrenci_veli_tc')";
            if ($conn->query($sql) !== TRUE) {
                echo "Veli kaydı oluşturulurken hata oluştu: " . $conn->error;
            }
        }
    } else {
        
        $sql = "INSERT INTO ogrenci (ogrenci_adi, ogrenci_soyadi, ogrenci_no, ogrenci_tc, ogrenci_veli_tc) VALUES ('$ogrenci_adi', '$ogrenci_soyadi', '$ogrenci_no', '$ogrenci_tc', '$ogrenci_veli_tc')";
        if ($conn->query($sql) === TRUE) {
            echo "Yeni kayıt oluşturuldu.";
        } else {
            echo "Yeni kayıt oluşturulurken hata oluştu: " . $conn->error;
        }

       
        $sql = "INSERT INTO veli (veli_adi, veli_soyadi, veli_tc) VALUES ('$veli_adi', '$veli_soyadi', '$ogrenci_veli_tc')";
        if ($conn->query($sql) !== TRUE) {
            echo "Veli kaydı oluşturulurken hata oluştu: " . $conn->error;
        }
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yeni Kayıt</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <h1 class="text-center mt-5">      </h1>
        <form action="yeni_kayit.php" method="POST">
            <?php if (isset($_GET["id"])) : ?>
                <input type="hidden" name="ogrenci_id" value="<?php echo $_GET["id"]; ?>">
            <?php endif; ?>
            <div class="form-group">
                <label for="ogrenci_adi">Adı:</label>
                <input type="text" name="ogrenci_adi" id="ogrenci_adi" class="form-control" value="<?php echo $ogrenci_adi; ?>" required>
            </div>
            <div class="form-group">
                <label for="ogrenci_soyadi">Soyadı:</label>
                <input type="text" name="ogrenci_soyadi" id="ogrenci_soyadi" class="form-control" value="<?php echo $ogrenci_soyadi; ?>" required>
            </div>
            <div class="form-group">
                <label for="ogrenci_no">Öğrenci No:</label>
                <input type="text" name="ogrenci_no" id="ogrenci_no" class="form-control" value="<?php echo $ogrenci_no; ?>" required>
            </div>
            <div class="form-group">
                <label for="ogrenci_tc">TC Kimlik No:</label>
                <input type="text" name="ogrenci_tc" id="ogrenci_tc" class="form-control" value="<?php echo $ogrenci_tc; ?>" required>
            </div>
            <div class="form-group">
                <label for="veli_adi">Veli Adı:</label>
                <input type="text" name="veli_adi" id="veli_adi" class="form-control" value="<?php echo $veli_adi; ?>" required>
            </div>
            <div class="form-group">
                <label for="veli_soyadi">Veli Soyadı:</label>
                <input type="text" name="veli_soyadi" id="veli_soyadi" class="form-control" value="<?php echo $veli_soyadi; ?>" required>
            </div>
            <div class="form-group">
                <label for="ogrenci_veli_tc">Veli TC Kimlik No:</label>
                <input type="text" name="ogrenci_veli_tc" id="ogrenci_veli_tc" class="form-control" value="<?php echo $ogrenci_veli_tc; ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Kaydet</button>
        </form>

        <a href="kayit_guncelle.php" class="btn btn-secondary mt-3">Mevcut Kaydı Güncelle</a>
    </div>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</body>

</html>
