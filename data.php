<?php
 header('Content-Type:application/json');
 $baglanti=mysqli_connect("localhost","root","","2018469049");
 mysqli_set_charset($baglanti, "UTF8");
 $sonuc=mysqli_query($baglanti,"SELECT subeler.sube_adi as subeAdi, sum(satilan.adet) as toplamSatis
FROM satilan, urunler, subeler
WHERE satilan.urun_id=urunler.urun_id
AND subeler.sube_id=satilan.sube_id
GROUP BY subeler.sube_id
ORDER BY toplamSatis");
 $data=array(); 
 foreach($sonuc as $row){
	 $data[]=$row;
};
mysqli_close($baglanti);
echo json_encode($data);
?>