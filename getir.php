<?php
$baglanti=mysqli_connect("localhost","root","","2018469049");
mysqli_set_charset($baglanti, "UTF8");

if(mysqli_connect_errno($baglanti)){
	echo "Bağlantı Hatası<br />";
	echo "Hata açıklaması : " .mysqli_connect_error();
	die();
}
$sorgu = mysqli_query($baglanti, "SELECT SUM(satilan.adet) AS ToplamSatir
FROM magaza, subeler, satilan
WHERE magaza.magaza_id=subeler.magaza_id AND subeler.sube_id=satilan.sube_id");
if($sorgu){
	$SatilanSayisi=mysqli_num_rows($sorgu);
	if($SatilanSayisi>0){
		$Satislar = mysqli_fetch_assoc($sorgu);
		
		
		echo "" .$Satislar["ToplamSatir"]. "<br />";
		
	}else{
		echo "Kayıt Yok";
	}

}else{
	echo "Sorgu Hatası";
}
mysqli_close($baglanti);

?>
	