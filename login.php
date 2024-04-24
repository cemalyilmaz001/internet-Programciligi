<?php
//oturum ifadesi sesion'dır
@session_start();

$uye_adi	= $_POST["uye_adi"];
$sifre		= $_POST["sifre"];
$hatirla	= $_POST["hatirla"];

//echo "Kontrol sayfasına geldi....";
$dosya="uyeler.txt";
 
if(file_exists($dosya)){
	$dd=fopen($dosya,"r");

	while(!feof($dd)) {
		$veri=trim(fgets($dd,110));
		$dizi=explode(":",$veri);
		if(isset($_COOKIE["kisi"])) $uye_adi=$_COOKIE["kisi"]; 
		if($dizi[0]==$uye_adi and $dizi[1]==$sifre) {
			//echo "Üye bulundu.....";
			//Üye varsa Oturum (ziyaretçi kartı)açılacak
			$_SESSION["uye"]=$uye_adi;
			if($hatirla) {
				//üç parametre ile çalışır. 1-Cookie değişkenidir,2.Cookie değeridir,3.Cookie süresidir(saniye!!!!)
				setcookie("kisi",$uye_adi,time()+60);
			}
			header("location: index.php");
      break; // Giriş başarılıysa döngüyü sonlandır

		}
		
	}fclose($dd);

}
else {
	echo "Error Kod=2"; exit;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Giriş Yap</title>
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
<body class="d-flex h-100 text-center text-bg-dark">

<div class="container d-flex w-100 h-100 p-3 mx-auto flex-column">
<header class="mb-auto" style="width:1200px !important; position:relative; left:40px;">
    <div>
    <h3 class="float-md-start mb-0">
        <a class="nav-link fw-bold py-1 px-0" href="index.php">
          Vize Project
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
          echo '<a class="nav-link fw-bold py-1 px-0 active" aria-current="page" href="login.php">Giriş Yap</a>';
        }
        ?>
      </nav>
    </div>
  </header>

  <div class="container px-3 mt-5 pt-5" style="margin-top:200px !important;">
	<div class="row">
		<div class="col-sm-6">
			<img src="images/yKayit.png" style="position:relative; top:-100px; left:-40px; width:400px; height:400px; border-radius:100%;">
		</div>
		<div class="col-sm-6">
			<h2 style="position:relative; left:-250px; bottom:20px;">Giriş Yap</h2>
			<form action="login.php" method="POST">
				<div class="form-group">
					<input type="text" class="form-control" id="exampleInputEmail1" name="uye_adi" aria-describedby="emailHelp" placeholder="Enter Name">
				</div>
				<br>
				<div class="form-group">
					<input type="password" class="form-control" id="exampleInputPassword1" name="sifre" placeholder="Password">
				</div>
				<div class="form-group form-check" style="position:relative; top:10px;">
					<input type="checkbox" class="form-check-input" id="exampleCheck1" name="hatirla">
					<label class="form-check-label" for="exampleCheck1" style="position:relative; left: -250px; top:0px;">Beni Hatırla.</label>
				</div>
				<button type="submit" class="btn btn-primary" style="position:relative; left: -260px; top:40px;">Giriş Yap</button>
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
