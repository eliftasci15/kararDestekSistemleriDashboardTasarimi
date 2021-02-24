<?php
 header('Content-Type:application/json');
 $baglanti=mysqli_connect("localhost","root","","2018469049");
 $sonuc=mysqli_query($baglanti,"SELECT subeler.sube_id AS subeId, round((sum(satilan.adet)/(SELECT sum(satilan.adet) 
 FROM magaza,subeler,satilan WHERE magaza.magaza_id=subeler.magaza_id AND subeler.sube_id=satilan.sube_id)*100),2) as yuzdeOlarakSatis
FROM satilan, urunler, subeler
WHERE satilan.urun_id=urunler.urun_id AND subeler.sube_id=satilan.sube_id
GROUP BY subeler.sube_id
ORDER BY yuzdeOlarakSatis");
 $data=array(); 
 foreach($sonuc as $row){
	 $data[]=$row;
};
mysqli_close($baglanti);
echo json_encode($data);
?>