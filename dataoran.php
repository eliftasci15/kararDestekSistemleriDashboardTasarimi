<?php
 header('Content-Type:application/json');
 $baglanti=mysqli_connect("localhost","root","","2018469049");
 $sonuc=mysqli_query($baglanti,"SELECT subeler.sube_id AS subeId, round((sum(urunler.fiyat*satilan.adet)/(SELECT sum(urunler.fiyat*satilan.adet)  
 FROM magaza,subeler,satilan,urunler WHERE magaza.magaza_id=subeler.magaza_id AND subeler.sube_id=satilan.sube_id AND urunler.urun_id=satilan.urun_id)*100),2) as yuzdeOlarakGelir
FROM satilan, urunler, subeler
WHERE satilan.urun_id=urunler.urun_id AND subeler.sube_id=satilan.sube_id
GROUP BY subeler.sube_id
ORDER BY yuzdeOlarakGelir");
 $data=array(); 
 foreach($sonuc as $row){
	 $data[]=$row;
};
mysqli_close($baglanti);
echo json_encode($data);
?>