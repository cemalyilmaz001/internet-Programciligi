<?php
// Oturumu başlat
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>İtrn Prgm Ders Ödevi</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="icon" type="image/png" href="images/favicon.ico">
    <style>
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

      .btn-bd-primary {
        --bd-violet-bg: #712cf9;
        --bd-violet-rgb: 112.520718, 44.062154, 249.437846;

        --bs-btn-font-weight: 600;
        --bs-btn-color: var(--bs-white);
        --bs-btn-bg: var(--bd-violet-bg);
        --bs-btn-border-color: var(--bd-violet-bg);
        --bs-btn-hover-color: var(--bs-white);
        --bs-btn-hover-bg: #6528e0;
        --bs-btn-hover-border-color: #6528e0;
        --bs-btn-focus-shadow-rgb: var(--bd-violet-rgb);
        --bs-btn-active-color: var(--bs-btn-hover-color);
        --bs-btn-active-bg: #5a23c8;
        --bs-btn-active-border-color: #5a23c8;
      }

      .bd-mode-toggle {
        z-index: 1500;
      }

      .bd-mode-toggle .dropdown-menu .active .bi {
        display: block !important;
      }
    </style>

</head>
<body class="d-flex w-100 h-100 text-center text-bg-dark">

<div class="container d-flex w-100 h-100 p-3 mx-auto flex-column">
  <header class="mb-auto" style="width:1200px !important; position:relative; left:40px;">
    <div>
      <h3 class="float-md-start mb-0">
        <a class="nav-link fw-bold py-1 px-0" href="index.php">
          Ürün Detay
        </a>
      </h3>
      <nav class="nav nav-masthead justify-content-center float-md-end">
        <a class="nav-link fw-bold py-1 px-0" href="index.php">Ana Sayfa</a>
        <a class="nav-link fw-bold py-1 px-0" href="magaza.php">Mağaza</a>
        <?php
          session_start();

          $toplam_urun = 0;

          if (isset($_SESSION['sepet'])) {
              foreach ($_SESSION['sepet'] as $urun) {
                  $toplam_urun += $urun['miktar'];
              }
          }
        echo'<a class="nav-link fw-bold py-1 px-0" href="sepet.php">Sepetim <span class="badge text-bg-secondary">'. $toplam_urun .'</span></a>';
        ?>
        <?php 
        // Eğer oturum açılmışsa
        if(isset($_SESSION['uye'])) {
          // Örnek olarak oturum kapama bağlantısı ekleyebiliriz
          echo '<a class="nav-link fw-bold py-1 px-0" href="logout.php">Çıkış Yap</a>';
        } else {
          echo '<a class="nav-link fw-bold py-1 px-0" href="kayit.php">Kayıt Ol</a>';
          echo '<a class="nav-link fw-bold py-1 px-0" href="login.php">Giriş Yap</a>';
        }
        ?>
      </nav>
    </div>
  </header>

  <main class="px-3 mt-5 pt-5" style="margin-top:200px !important;">
  <?php
$dosya = "urunler.txt";
$id = isset($_GET['id']) ? $_GET['id'] : null;

if (file_exists($dosya) && is_numeric($id)) {
    $dd = fopen($dosya, "r");

    while (!feof($dd)) {
        $veri = trim(fgets($dd, 110));
        $dizi = explode(":", $veri);

        if ($dizi[0] == $id) {
            echo '
                <div class="row">
                    <div class="col-sm-6">
                        <img style=position:relative;top:-120px;left:-40px;width:500px;height:500px; src="magaza_images/' . $dizi[1] . '" class="img-fluid" alt="Product Image">
                    </div>
                    <div class="col-sm-6">
                        <h2>' . $dizi[2] . '</h2>
                        <p>Fiyat: ' . $dizi[3] . ' TL</p>
                        <p>Stok Adedi: ' . $dizi[4] . '</p>
                        <p>Açıklama: ' . $dizi[5] . '</p>
                        <a href="sepete_ekle.php?id='.$dizi[0].'&miktar=1" class="btn btn-primary">Sepete Ekle</a>
                    </div>
                </div>
            ';
            $found = true;
            break; // İlgili ürünü bulduğumuzda döngüden çık
        }
    }

    fclose($dd);

    if (!$found) {
        header("Location: magaza.php"); // Ürün bulunamadıysa anasayfaya yönlendir
        exit;
    }
} else {
	header("location: magaza.php");
    exit;
}
?>
  </main>

  <footer class="mt-auto text-white-50" style="position:absolute; bottom:10px !important; left:850px;">
    <p>Powered by <a href="#">Cemal Yilmaz</a> </p>
  </footer>
</div>

<script src="js/color-modes.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/poper.min.js"></script>
</body>
</html>
