<?php
session_start();

$id = isset($_GET['id']) ? $_GET['id'] : null;
$miktar = isset($_GET['miktar']) ? $_GET['miktar'] : 1;

if (!isset($_SESSION['sepet'])) {
    $_SESSION['sepet'] = array();
}

$urun_eklendi = false;

foreach ($_SESSION['sepet'] as &$urun) {
    if ($urun['id'] == $id) {
        $urun['miktar'] += $miktar;
        $urun_eklendi = true;
        break;
    }
}

if (!$urun_eklendi) {
    $_SESSION['sepet'][] = array('id' => $id, 'miktar' => $miktar);
}

$mesaj = "Ürün başarıyla sepete eklendi!";
if ($urun_eklendi) {
    $mesaj = "Ürün başarıyla sepete eklendi!";
}

// Sepete eklendikten sonra sepete yönlendir
header("Location: magaza.php?mesaj=" . urlencode($mesaj));
exit;
?>
