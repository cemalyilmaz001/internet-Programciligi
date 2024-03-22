<?php
//oturum ifadesi sesion'dır
@session_start();

$s = 0;
$risk = 0;
if(isset($_POST["isim"]) and  isset($_POST["sifre"]) and isset($_POST["sifre1"])) {
  if(!empty($_POST["isim"]) and  !empty($_POST["sifre"]) and !empty($_POST["sifre1"])) {
    $username  = $_POST['isim'];
    $password  = $_POST['sifre'];
    $password1 = $_POST['sifre1'];
  
    if($password == $password1) {
      $file = 'uyeler.txt';

      if(file_exists($file)){
        $dd=fopen($file,"r");
      
        while(!feof($dd)) {
          $veri=trim(fgets($dd,110));
          $dizi=explode(":",$veri);
          if($dizi[0]==$username) {
            //echo "Üye bulundu.....";
            $risk += 1;
          }
        }fclose($dd);
      }
      else {
        echo "Error Kod=2"; exit;
      }

      if($risk == 0) {
          $currentContent = file_get_contents($file);
      
          $currentContent .=  "\n". $username . ":" . $password . ":";
      
          file_put_contents($file, $currentContent);
          
          $root="Kayıt Başarılı Lütfen Giriş Yapınız ..  ";
          $s += 1;
      }
      
    }else {
      //echo '<script> 
        //        alert("Parolalar Eşleşmiyor");
          //  </script>';
    }
    
  } else {
      //echo '<script> 
        //        alert("Lütfen tüm alanları doldurun");
         //   </script>';
  }
  
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kayit Ol</title>
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
        <a class="nav-link fw-bold py-1 px-0" href="/">Ana Sayfa</a>
        <a class="nav-link fw-bold py-1 px-0" href="magaza.php">Mağaza</a>
        <?php 
        // Eğer oturum açılmışsa
        if(isset($_SESSION['uye'])) {
          // Örnek olarak oturum kapama bağlantısı ekleyebiliriz
          echo '<a class="nav-link fw-bold py-1 px-0" href="logout.php">Çıkış Yap</a>';
        } else {
          echo '<a class="nav-link fw-bold py-1 px-0 active" aria-current="page" href="kayit.php">Kayıt Ol</a>';
          echo '<a class="nav-link fw-bold py-1 px-0" href="login.php">Giriş Yap</a>';
        }
        ?>
      </nav>
    </div>
  </header>

  <div class="container px-3 mt-5 pt-5" style="margin-top:200px !important;">
	<div class="row">
		<div class="col-sm-6">
			<img src="images/xLogin.png" style="position:relative; top:-100px; left:-40px; width:400px; height:400px; border-radius:100%;">
		</div>
		<div class="col-sm-6">
			<h2 style="position:relative; left:-250px; bottom:20px;">Kayit Ol</h2>
			<form action="kayit.php" method="POST"> 
				<div class="form-group">
					<input type="text" class="form-control" name="isim" id="exampleInputEmail1" placeholder="Kullanıcı Adı">
				</div>
          <br>
				<div class="form-group">
          <input type="password" class="form-control" name="sifre" id="exampleInputPassword1" placeholder="Password">
          <br>
					<input type="password" class="form-control" name="sifre1" id="exampleInputPassword1" placeholder="Password Tekrar">
				</div>
				<div class="form-group form-check">
          <?php
            if($s == 1) {
              echo '<small id="emailHelp" class="form-text text-muted" style="position:relative; color:white !important; left: -210px; top:10px;">'. $root .'</small>';
            } else {
              echo '<small id="emailHelp" class="form-text text-muted" style="position:relative; left: -200px; top:10px;">Kullanıcı adlarınız eşsiz olmak zorunda.</small>';
            }
          ?>
				</div>
				<button type="submit" class="btn btn-primary" style="position:relative; left:-265px; top:40px;">Kayit Ol</button>
			</form>
		</div>
	</div>
</div>

  <footer class="mt-auto text-white-50" style="position:absolute; bottom:10px !important; left:850px;">
    <p>Powered by <a href="#">Cemal Yilmaz</a> </p>
  </footer>
</div>

<script src="js/color-modes.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/poper.min.js"></script>
</body>
</html>
