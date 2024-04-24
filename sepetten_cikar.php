<?php
session_start();

$index = isset($_GET['index']) ? $_GET['index'] : null;

if ($index !== null && isset($_SESSION['sepet'][$index])) {
    unset($_SESSION['sepet'][$index]);
}

// Sepete çıkarıldıktan sonra sepet sayfasına geri dön
header("Location: sepet.php");
exit;
?>
