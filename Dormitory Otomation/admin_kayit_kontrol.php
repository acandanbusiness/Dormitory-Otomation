<?php

$servername = "localhost";
$username = "root";
$password = "abdullah";
$dbname = "otomasyon";


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Veritabanına bağlantı hatası: " . $conn->connect_error);
}


$sql = "SELECT COUNT(*) as count FROM admin";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $count = $row["count"];

    if ($count > 0) {
        
        echo "has_records";
    } else {
        
        echo "no_records";
    }
} else {
    
    echo "no_records";
}


$conn->close();
?>
