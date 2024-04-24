<?php
// Oturumu başlat
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>E-Mağaza</title>
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
      #ürün_ekleme_alert {
        display:none;
      }
    </style>

</head>
<body class="d-flex h-100 text-center text-bg-dark">

<div class="container d-flex w-100 h-100 p-3 mx-auto flex-column">
  <header class="mb-auto" style="width:1200px !important; position:relative; left:40px;">
    <div>
      <h3 class="float-md-start mb-0">
        <a class="nav-link fw-bold py-1 px-0" href="index.php">
          Mağaza
        </a>
      </h3>
      <nav class="nav nav-masthead justify-content-center float-md-end">
        <a class="nav-link fw-bold py-1 px-0" href="index.php">Ana Sayfa</a>
        <a class="nav-link fw-bold py-1 px-0 active"  href="magaza.php">Mağaza</a>
        <?php
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
  
  <?php
  $mesaj = isset($_GET['mesaj']) ? $_GET['mesaj'] : "";

  // Başarı mesajını ekrana yazdır
  if (!empty($mesaj)) {
      echo '<header class="mt-3" id="ürün_ekleme_alert" style="width:1200px !important; position:relative; left:40px; display:block;">
              <div class="alert alert-info" role="alert">
                '.htmlspecialchars($mesaj).'
              </div>
            </header>';
  }
  ?>

<?php
$dosya = "urunler.txt";

if (file_exists($dosya)) {
    $dd = fopen($dosya, "r");
    echo '<div class="container"><div class="row">'; // Container ve ilk satırı aç

    while (!feof($dd)) {
        $veri = trim(fgets($dd, 110));
        $dizi = explode(":", $veri);

        //  count:isim:fiyat:adet
        //  1:x1.png:200:1000
        //  $dizi[0] $dizi[1] $dizi[2] $dizi[3]

        echo '
        <div class="col-sm-4 mt-5">
            <a href="urun_detay.php?id='.$dizi[0].'" style="text-decoration:none; color:black;">
              <div class="card" style="width: 22rem; display:inline-block !important;">
                  <img class="card-img-top" style="width:350px; height:300px;" src="magaza_images/' . $dizi[1] . '" alt="Card image cap">
                  <div class="card-body">
                      <h5 class="card-title">'. $dizi[2] .'</h5>
                      <p class="card-text pb-2">'. $dizi[3] .' TL</p>
                      <a href="sepete_ekle.php?id='.$dizi[0].'&miktar=1" class="btn btn-primary">Sepete Ekle</a>
                  </div>
              </div>
            </a>
        </div>
        ';

    }

    echo '</div></div>'; // Satırı ve container'ı kapat
    fclose($dd);

} else {
    echo "Error Kod=2";
    exit;
}
?>


  <footer class="mt-auto text-white-50" style="position:absolute; bottom:10px !important; left:850px;">
  </footer>
</div>

<script src="js/color-modes.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/poper.min.js"></script>
</body>
</html>