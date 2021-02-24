<?php
$baglanti=mysqli_connect("localhost","root","","2018469049");
mysqli_set_charset($baglanti, "UTF8");

if(mysqli_connect_errno($baglanti)){
	echo "Bağlantı Hatası<br />";
	echo "Hata açıklaması : " .mysqli_connect_error();
	die();
}
$sorgu = mysqli_query($baglanti, "SELECT COUNT(musteri_id) AS ToplamMusteri FROM musteriler");
if($sorgu){
	$MusteriSayisi=mysqli_num_rows($sorgu);
	if($MusteriSayisi>0){
		$Musteriler = mysqli_fetch_assoc($sorgu);
		
		
		echo "" .$Musteriler["ToplamMusteri"]. "<br />";
		
	}else{
		echo "Kayıt Yok";
	}

}else{
	echo "Sorgu Hatası";
}
mysqli_close($baglanti);

?>