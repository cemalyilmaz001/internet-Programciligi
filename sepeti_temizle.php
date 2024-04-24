<?php
session_start();

// Tüm sepeti temizle
unset($_SESSION['sepet']);

// Ana sayfaya yönlendir
header("Location: magaza.php");
exit;
?>
