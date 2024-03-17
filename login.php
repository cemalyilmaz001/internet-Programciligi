<?php
//oturum ifadesi sesion'dır
@session_start();
$uye_adi=$_POST["uye_adi"];
$sifre=$_POST["sifre"];
$hatirla=$_POST["hatirla"];
//echo "Kontrol sayfasına geldi....";
$dosya="uyeler.txt";
 
if(file_exists($dosya))
{
	$dd=fopen($dosya,"r");
	while(!feof($dd))
	{
		$veri=trim(fgets($dd,110));
		$dizi=explode(":",$veri);
		if(isset($_COOKIE["kisi"])) $uye_adi=$_COOKIE["kisi"]; 
		if($dizi[0]==$uye_adi and $dizi[1]==$sifre)
		{
			//echo "Üye bulundu.....";
			//Üye varsa Oturum (ziyaretçi kartı)açılacak
			$_SESSION["uye"]=$uye_adi;
			if($hatirla)
			{
				//üç parametre ile çalışır. 1-Cookie değişkenidir,2.Cookie değeridir,3.Cookie süresidir(saniye!!!!)
				setcookie("kisi",$uye_adi,time()+60);
			}
		}
		
	}fclose($dd);
}
else
{
	echo "Error Kod=2"; exit;
	
}
header("location: index.php");

?>
