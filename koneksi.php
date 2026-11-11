<?php
$koneksi = mysqli_connect(
    "localhost", 
    "root",      
    "",          
    "dvn"       
);

if (!$koneksi) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

session_start();
?>
