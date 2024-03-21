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


if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    $user_username = $_POST["admin_email"];
    $user_password = $_POST["admin_password"];

   
    $sql = "SELECT * FROM ogrenci WHERE ogrenci_tc = '$user_username' AND ogrenci_no = '$user_password'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
  
  
      
      $row = $result->fetch_assoc();
      $ogrenciAdi = $row['ogrenci_adi'];
      $ogrenciSoyadi = $row['ogrenci_soyadi'];
      $ogrenciNo = $row['ogrenci_no'];
      $ogrenciTc = $row['ogrenci_tc'];
  
      
      $_SESSION['ogrenci_adi'] = $ogrenciAdi;
      $_SESSION['ogrenci_soyadi'] = $ogrenciSoyadi;
      $_SESSION['ogrenci_no'] = $ogrenciNo;
      $_SESSION['ogrenci_tc'] = $ogrenciTc;
  
      header("Location: ogrenci_panel.php");
      exit();
  }
   else {
  
        echo "Kullanıcı adı veya şifre hatalı.";
    }
}



$conn->close();
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Öğrenci Giriş</title>
    <link rel="canonical" href="https://getbootstrap.com/docs/5.2/examples/sign-in/">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link href="https://getbootstrap.com/docs/5.2/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <meta name="theme-color" content="#712cf9">


    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }
        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
        .b-example-divider {
            height: 3rem;
            background-color: rgba(0, 0, 0, .1);
            border: solid rgba(0, 0, 0, .15);
            border-width: 1px 0;
            box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
        }
        .b-example-vr {
            flex-shrink: 0;
            width: 1.5rem;
            height: 100vh;
        }
        .bi {
            vertical-align: -.125em;
            fill: currentColor;
        }
        .nav-scroller {
            position: relative;
            z-index: 2;
            height: 2.75rem;
            overflow-y: hidden;
        }
        .nav-scroller .nav {
            display: flex;
            flex-wrap: nowrap;
            padding-bottom: 1rem;
            margin-top: -1px;
            overflow-x: auto;
            text-align: center;
            white-space: nowrap;
            -webkit-overflow-scrolling: touch;
        }
    </style>
    
    <link href="https://getbootstrap.com/docs/5.2/examples/sign-in/signin.css" rel="stylesheet">

</head>


<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<body class="text-center">

<main class="form-signin w-100 m-auto">
<form action="ogrenci_giris.php" method="POST">
            <img class="mb-4" src="https://kygm.gsb.gov.tr/assets/img/kygmlogo-2019.svg" alt="" width="288" height="288">
            <h1 class="h3 mb-3 fw-normal">Lütfen Giriş Yapın</h1>
            <div class="form-floating mb-2">
            <input type="text" name="admin_email" id="admin_email" required class="form-control">
                <label for="user_name">Öğrenci TC:<label!>
                        <br><br>
            </div>
            <div class="form-floating">
            <input type="text" name="admin_password" id="admin_password" required class="form-control">
                <label for="user_password">Öğrenci No:<label!>
                        <br><br>
            </div>
            <h6 id="div1" class="text-dark text-center"></h6>
            <button class="w-100 btn btn-lg btn-primary" type="submit">Giriş</button><br><br>


            <p class="mt-5 mb-3 text-muted">&copy; 2023 Candansoft Ltd. Şti.</p>
        </form>


<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</main>
      </body>
</html>