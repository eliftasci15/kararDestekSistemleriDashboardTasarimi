<?php
$baglanti=mysqli_connect("localhost","root","","2018469049");
mysqli_set_charset($baglanti, "UTF8");

if($baglanti){
	$sorgu=mysqli_query($baglanti,"SELECT urunler.urun_id, urunler.urun_adi, kategori.kategori_adi, urunler.fiyat
FROM satilan RIGHT JOIN urunler on satilan.urun_id=urunler.urun_id
LEFT JOIN kategori on kategori.kategori_id=urunler.kategori_id WHERE satilan.satis_id is null");
	$dataRow="";
	while($row=mysqli_fetch_array($sorgu)){
		$dataRow=$dataRow."<tr><td>'".$row['urun_id']."'</td><td>'".$row['urun_adi']."'</td><td>'".$row['kategori_adi']."'</td><td>'".$row['fiyat']."'</td></tr>";
	}
	echo $dataRow;
	mysqli_close($baglanti);
}else{
	die("Baglanti Sağlanmadı");
}

?>