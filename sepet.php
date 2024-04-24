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
    </style>

</head>
<body class="d-flex w-100 h-100 text-center text-bg-dark">

<div class="container d-flex w-100 h-100 p-3 mx-auto flex-column">
  <header class="mb-auto" style="width:1200px !important; position:relative; left:40px;">
    <div>
      <h3 class="float-md-start mb-0">
        <a class="nav-link fw-bold py-1 px-0" href="index.php">
            Sepetim
        </a>
      </h3>
      <nav class="nav nav-masthead justify-content-center float-md-end">
        <a class="nav-link fw-bold py-1 px-0 active" aria-current="page" href="index.php">Ana Sayfa</a>
        <a class="nav-link fw-bold py-1 px-0" href="magaza.php">Mağaza</a>
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

  <main class="px-3" style="margin-top:100px !important;">
    <?php
        // Sepet boşsa mesaj göster
        if (empty($_SESSION['sepet'])) {
            echo "<h3>Sepetiniz boş.</h3>";
            echo "<a href='magaza.php'>Alışverişe Devam Et</a>";
        } else {
            echo "<h3>Sepetinizdeki Ürünler:</h3>";
            echo "<ul class='list-group'>";
            foreach ($_SESSION['sepet'] as $index => $urun) {
                $dosya = "urunler.txt";

                if (file_exists($dosya)) {
                    $dd = fopen($dosya, "r");

                    while (!feof($dd)) {
                        $veri = trim(fgets($dd, 110));
                        $dizi = explode(":", $veri);

                        if ($dizi[0] == $urun['id']) { 
                            echo '
<li style="" class="list-group-item">
  <img style="width:50px; position:relative; left: -470px; height:50px;" src="magaza_images/' . $dizi[1] . '">
  <span style="position:relative; left: -430px;" style="margin-left: 10px;">'. $dizi[2] .'</span>
  <span style="margin-left: 10px;">'. $dizi[3] .' TL</span>
  <a style="position:relative; right: -470px;" href="sepetten_cikar.php?index='.$index.'">'. $urun['miktar'] .' Adet Çıkar</a>
</li>';
                        }
                    }

                    fclose($dd);
                } else {
                    echo "Error Kod=2";
                    exit;
                }
            }
            echo "</ul>";
            echo "<a href='sepeti_temizle.php' style='position:relative; top:50px; left:650px;'>
                    <button type='button' class='btn btn-danger'>Sepeti Temizle</button>
                  </a>";

                  $total = 0;
                  if(isset($_SESSION['uye'])) {

                     foreach ($_SESSION['sepet'] as $index => $urun) {
                      $dosya = "urunler.txt";

                      if (file_exists($dosya)) {
                          $dd = fopen($dosya, "r");

                          while (!feof($dd)) {
                              $veri = trim(fgets($dd, 110));
                              $dizi = explode(":", $veri);

                              if ($dizi[0] == $urun['id']) {
                                $miktar = intval($urun['miktar']);

                                if ($miktar != 1) {
                                  $totalekle = $miktar * $dizi[3];
                                  $total += $totalekle;
                                }else {
                                  $total += $dizi[3];
                                }
                              }
                            }
                          }
                      }
                    // Örnek olarak oturum kapama bağlantısı ekleyebiliriz
                    echo "<a href='ödeme_ekrani.php' style='position:relative; top:50px; right:614px;'>
                    <button type='button' class='btn btn-info'>
                    ".$total." TL
                    Ödeme Yap
                    </button>
                    </a>";
                  } else {
                    echo "<a href='login.php' style='position:relative; top:50px; right:650px;'>
                    <button type='button' class='btn btn-info'>Giriş Yap</button>
                    </a>";
                  }
        }
        // Sepeti temizleme bağlantısı
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