<?php
$baglanti=mysqli_connect("localhost","root","","2018469049");
mysqli_set_charset($baglanti, "UTF8");

if($baglanti){
	$sorgu=mysqli_query($baglanti,"SELECT musteriler.musteri_id, musteriler.musteri_ad, musteriler.musteri_soyad, COUNT(satilan.satis_id) as satis_sayisi
FROM musteriler,satilan
WHERE musteriler.musteri_id=satilan.musteri_id
GROUP BY musteriler.musteri_id
HAVING satis_sayisi>2
ORDER BY satis_sayisi");
	$dataRow="";
	while($row=mysqli_fetch_array($sorgu)){
		$dataRow=$dataRow."<tr><td>'".$row['musteri_id']."'</td><td>'".$row['musteri_ad']."'</td><td>'".$row['musteri_soyad']."'</td><td>'".$row['satis_sayisi']."'</td></tr>";
	}
	echo $dataRow;
	mysqli_close($baglanti);
}else{
	die("Baglanti Sağlanmadı");
}

?>