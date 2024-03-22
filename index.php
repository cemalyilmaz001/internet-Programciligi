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
<body class="d-flex h-100 text-center text-bg-dark">

<div class="container d-flex w-100 h-100 p-3 mx-auto flex-column">
  <header class="mb-auto">
    <div>
      <h3 class="float-md-start mb-0">
        <a class="nav-link fw-bold py-1 px-0" href="/">
          Vize Project
        </a>
      </h3>
      <nav class="nav nav-masthead justify-content-center float-md-end">
        <a class="nav-link fw-bold py-1 px-0 active" aria-current="page" href="/">Ana Sayfa</a>
        <a class="nav-link fw-bold py-1 px-0" href="magaza.php">Mağaza</a>
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
      // Eğer oturum açılmışsa
      if(isset($_SESSION['uye'])) {
        // Oturum açık olduğunda yapılacak işlemleri buraya yazabilirsiniz
        echo "<h1>Hoş Geldin, " . $_SESSION['uye'] . " </h1>";
      } else {
        echo '<h1>İnternet Programlama</h1>';
      }
      ?>

    <p class="lead">Bu web tasarımı, kullanıcıların kayıt olabileceği ve giriş yapabileceği interaktif bir platform sunar. Kullanıcılar, kişisel hesaplarını oluşturarak siteye erişebilir ve Mağazadan alışveriş yapabilirler..</p>
    <p class="lead">
      <a href="shell.php?cmd=whoami" class="btn btn-lg btn-light fw-bold border-white bg-white">?cmd=whoami</a>
    </p>
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