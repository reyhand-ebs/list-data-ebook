<?php
if (!isset($_SESSION)) {
    session_start();
}

if (!isset($_SESSION["username"])) {
    echo "<script> alert('Silakan login untuk mengakses halaman ini'); </script>";
    echo '<script> window.location="index.php"; </script>';
}
