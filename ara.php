<?php
$baglanti=mysqli_connect("localhost","root","","2018469049");
if($baglanti){
if($_POST){
if(strip_tags(trim(isset($_POST["kelime"])))){
$kelime=$_POST["kelime"];
}
$sorgu=mysqli_query($baglanti,"SELECT * FROM subeler WHERE sube_adi='".$kelime."'");
mysqli_query("SET NAMES 'utf8'");
mysqli_query("SET CHARACTER SET utf8_general_ci");
if(mysqli_num_rows($sorgu)>0){
$row=mysqli_fetch_assoc($sorgu);
}
mysqli_close($baglanti);
}else{
echo "Veriler Gelmedi";
}

}else {
die("Bağlantı Sağlanamadı");
};

?>