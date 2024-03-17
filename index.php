<?php
// Oturumu başlat
session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Panel</title>
    <link rel="stylesheet" href="style.css">

</head>
<body>

<div class="grid-container">
  <div class="item1">Login Panel</div>
  <div class="item2">Menu</div>
  <div class="item3">Main</div>  
  <div class="item4">
    <?php 
      // Eğer oturum açılmışsa
      if(isset($_SESSION['uye'])) {
        // Oturum açık olduğunda yapılacak işlemleri buraya yazabilirsiniz
        echo "Hoş geldiniz, " . $_SESSION['uye'] . "!";

        // Örnek olarak oturum kapama bağlantısı ekleyebiliriz
        echo '<br><a href="logout.php">Çıkış yap</a>';
      } else {
        // Oturum açılmamışsa, giriş sayfasına yönlendirme yapabiliriz
    
      ?>
      <form action="login.php" method="post">
        <input type="text" name="uye_adi">
        <input type="password" name="sifre">
        <input type="checkbox" name="hatirla">
        <input type="submit" value="Giriş Yap">
      </form>
    <?php
      }
      ?>

  </div>
  <div class="item5">Footer</div>
</div>

<script src="script.js"></script>

</body>
</html>
