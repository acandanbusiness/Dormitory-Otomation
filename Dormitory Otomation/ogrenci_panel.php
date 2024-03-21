<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Öğrenci Paneli</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">

    <style>
        
        .sidebar {
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            z-index: 100;
            padding: 48px 20px;
            background-color: #f8f9fa;
            overflow-x: hidden;
            overflow-y: auto; 
            margin-top: 86px;
        }
        .navbar-custom {
            background-color: #EAE3E3;
            background-image: none;
            padding-left: 10px;
            padding-right: 10px;
        }
        .sidebar .nav-link {
            font-weight: 500;
            color: #333;
        }
        .navbar-nav {
            margin: 0 auto;
            display: fixed;
            justify-content: center;
        }

        .sidebar .nav-link:hover {
            color: #0069d9;
        }

        .sidebar .nav-link.active {
            color: #0069d9;
        }

        
        .content {
            margin-left: 220px;
            padding: 20px;
        }
       
    </style>


</head>

<body>
    
<nav class="navbar navbar-expand-lg navbar-light  navbar-custom sticky-top">
        <a class="navbar-brand" href="https://kygm.gsb.gov.tr/"><img src="https://kygm.gsb.gov.tr/assets/img/kygmlogo-2019.svg"
                 width="200px" height="100%"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="#">Anasayfa</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Hakkımızda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Hizmetler</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">İletişim</a>
                </li>
            </ul>
        </div>
        <div class="ml-auto"></div>
        <a class="btn btn-danger" href="http://127.0.0.1/abdullah/FinalYurt/" role="button" aria-expanded="false">
    Çıkış Yap
</a>

       
    </nav>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

  <div class="sidebar">
        <nav class="nav flex-column fixed-left">
            
            <a class="nav-link" href="izin_alma.php">İzin Alma</a>
            <a class="nav-link" href="sikayet_oneri_ogrenci.php">Şikayet ve Öneri</a>
            <a class="nav-link" href="yemek_listesi_ogrenci.php">Yemek Listesi</a>
            
        </nav>
    </div> 





<div class="container">
        

    
        <ul class="list-group mt-4">
            <?php
            
            $servername = "localhost";
            $username = "root";
            $password = "abdullah";
            $dbname = "otomasyon";

            
            $conn = new mysqli($servername, $username, $password, $dbname);

            session_start();


if (!isset($_SESSION['ogrenci_adi'])) {
    
    header("Location: ogrenci_giris.php");
    exit;
}

$ogrenciAdi = $_SESSION['ogrenci_adi'];
$ogrenciSoyadi = $_SESSION['ogrenci_soyadi'];
$ogrenciNo = $_SESSION['ogrenci_no'];
$ogrenciTc = $_SESSION['ogrenci_tc'];




            
            if ($conn->connect_error) {
                die("Veritabanına bağlanılamadı: " . $conn->connect_error);
            }

            
            $sql = "SELECT * FROM duyuru";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<li class="list-group-item">' . $row['duyuru'] . '</li>';
                }
            } else {
                echo '<li class="list-group-item">Duyuru bulunamadı.</li>';
            }

            $conn->close();
            ?>
        </ul>
    </div>
</body>

</html>
