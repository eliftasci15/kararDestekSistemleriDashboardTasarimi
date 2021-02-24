<?php
$baglanti=mysqli_connect("localhost","root","","2018469049");
mysqli_set_charset($baglanti, "UTF8");

if(mysqli_connect_errno($baglanti)){
	echo "Bağlantı Hatası<br />";
	echo "Hata açıklaması : " .mysqli_connect_error();
	die();
}
$sorgu = mysqli_query($baglanti, "SELECT COUNT(sube_id) AS ToplamSube FROM subeler");
if($sorgu){
	$SubeSayisi=mysqli_num_rows($sorgu);
	if($SubeSayisi>0){
		$Subeler = mysqli_fetch_assoc($sorgu);
		
		
		echo "" .$Subeler["ToplamSube"]. "<br />";
		
	}else{
		echo "Kayıt Yok";
	}

}else{
	echo "Sorgu Hatası";
}
mysqli_close($baglanti);

?>