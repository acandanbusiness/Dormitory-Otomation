<?php
session_start();

if ($_SESSION["user_type"] !== "admin") {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Paneli</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
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

    
    
    <div class="sidebar">
        <nav class="nav flex-column">
            <a class="nav-link" aria-current="page" href="yeni_kayit.php">Yeni Kayıt</a>
            <a class="nav-link" href="izin_degerlendirme.php">İzin Degerlendirme</a>
            <a class="nav-link" href="duyuru.php">Duyuru</a>
            <a class="nav-link" href="sikayet_ve_oneri.php">Şikayet ve Öneri</a>
            <a class="nav-link" href="yemek_listesi.php">Yemek Listesi</a>
            <a class="nav-link" href="admin_kayit.php">Admin Kaydı</a>
            <a class="nav-link" href="ogrenci_listesi.php">Öğrenci Listesi</a>
        </nav>
    </div>

    
    
    <div class="content">
    <img src="https://kygm.gsb.gov.tr//public/Images/KYGM/012014/thumbs/kapak_site_31$930x520.jpg" class="bannerimage d-block mx-auto" width="1400px" height="100%" >
    </div>
</div>






                <p class="text-center fixed-bottom text-muted">&copy; 2023 Candansoft Ltd. Şti.</p>
            
    <script type="text/javascript">
        (function() {
            var options = {
                whatsapp: "+905070202916", // WhatsApp number
                button_color: "#FF6550", // Color of button
                position: "right", // Position may be 'right' or 'left'
            };
            var proto = 'https:',
                host = "getbutton.io",
                url = proto + '//static.' + host;
            var s = document.createElement('script');
            s.type = 'text/javascript';
            s.async = true;
            s.src = url + '/widget-send-button/js/init.js';
            s.onload = function() {
                WhWidgetSendButton.init(host, proto, options);
            };
            var x = document.getElementsByTagName('script')[0];
            x.parentNode.insertBefore(s, x);
        })();
    </script>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>

</html>
