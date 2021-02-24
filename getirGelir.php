<?php
$baglanti=mysqli_connect("localhost","root","","2018469049");
mysqli_set_charset($baglanti, "UTF8");

if(mysqli_connect_errno($baglanti)){
	echo "Bağlantı Hatası<br />";
	echo "Hata açıklaması : " .mysqli_connect_error();
	die();
}
$sorgu = mysqli_query($baglanti, "SELECT SUM(urunler.fiyat*satilan.adet) AS MagazadakiTümSatisGeliri
FROM magaza, subeler, satilan, urunler
WHERE magaza.magaza_id=subeler.magaza_id AND subeler.sube_id=satilan.sube_id AND urunler.urun_id=satilan.urun_id");
if($sorgu){
	$ToplamGelir=mysqli_num_rows($sorgu);
	if($ToplamGelir>0){
		$Gelir = mysqli_fetch_assoc($sorgu);
		
		
		echo "" .$Gelir["MagazadakiTümSatisGeliri"]. "<br />";
		
	}else{
		echo "Kayıt Yok";
	}

}else{
	echo "Sorgu Hatası";
}
mysqli_close($baglanti);

?>