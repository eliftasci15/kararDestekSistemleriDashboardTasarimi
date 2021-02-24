<?php
session_start();
$baglanti=mysqli_connect("localhost","root","","2018469049");
if($baglanti){
if($_POST){
if(strip_tags(trim(isset($_POST["eposta"])))){
$kullaniciEposta=$_POST["eposta"];
}
if(strip_tags(trim(isset($_POST["sifre"])))){
$kullaniciSifre=$_POST["sifre"];
}
$sorgu=mysqli_query($baglanti,"SELECT * FROM kullanici WHERE eposta='".$kullaniciEposta."' AND sifre='".$kullaniciSifre."'");

if(mysqli_num_rows($sorgu)>0){
$row=mysqli_fetch_assoc($sorgu);
session_regenerate_id();
$_SESSION['loggedin'] = FALSE;
$_SESSION['gelenid'] = $row["id"];
$_SESSION['ad'] = $row["kullaniciAdi"];
$_SESSION['soyad'] = $row["kullaniciSoyadi"];
$_SESSION['resim'] = $row["avatar"];
echo 1;
}else{
echo 0;
}
mysqli_close($baglanti);
}else{
echo "Veriler Gelmedi";
}

}else {
die("Bağlantı Sağlanamadı");
};

?>