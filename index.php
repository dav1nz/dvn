<?php
session_start();

if (isset($_SESSION['role'])) {

    if ($_SESSION['role'] == 'administrator') {
        header("Location: dashboard.php");
        exit;
    }

    if ($_SESSION['role'] == 'petugas') {
        header("Location: dashboard.php");
        exit;
    }

}

header("Location: login.php");
exit;
?>