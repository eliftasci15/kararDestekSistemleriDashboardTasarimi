<?php
$baglanti=mysqli_connect("localhost","root","","2018469049");
mysqli_set_charset($baglanti, "UTF8");

if($baglanti){
	$sorgu=mysqli_query($baglanti,"SELECT urunler.urun_id, urunler.urun_adi, urunler.fiyat, COUNT(satilan.satis_id) as satış_sayısı
FROM urunler LEFT JOIN satilan
ON urunler.urun_id=satilan.urun_id
GROUP BY urunler.urun_id
HAVING satış_sayısı>4");
	$dataRow="";
	while($row=mysqli_fetch_array($sorgu)){
		$dataRow=$dataRow."<tr><td>'".$row['urun_id']."'</td><td>'".$row['urun_adi']."'</td><td>'".$row['fiyat']."'</td><td>'".$row['satış_sayısı']."'</td></tr>";
	}
	echo $dataRow;
	mysqli_close($baglanti);
}else{
	die("Baglanti Sağlanmadı");
}

?>