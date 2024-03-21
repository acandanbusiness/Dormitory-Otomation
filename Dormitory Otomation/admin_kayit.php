<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Kaydı</title>
    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <h1 class="mt-5">Admin Kaydı</h1>

        <form method="POST" action="admin_kayit.php" class="mt-4">
            <div class="form-group">
                <label for="email">Kullanıcı Adı:</label>
                <input type="text" id="email" name="email" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="sifre">Şifre:</label>
                <input type="password" id="sifre" name="sifre" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">Kaydet</button>
        </form>
    </div>

    
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</body>

<?php
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["email"];
    $password = $_POST["sifre"];

    
    $sql = "INSERT INTO admin (email, sifre) VALUES ('$username', '$password')";
    if ($conn->query($sql) === TRUE) {
        echo "Admin başarıyla kaydedildi.";
    } else {
        echo "Hata: " . $conn->error;
    }
}
$conn->close();
?>

</html>
