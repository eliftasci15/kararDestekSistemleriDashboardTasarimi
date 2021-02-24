<!DOCTYPE html>
<html>
<head>
<title>Dashboard Index</title>
<meta charset="utf-8">
<link href="style.css" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
$("#giris").click(function(){

if($("#eposta").val()=="" || $("#sifre").val()==""){
alert("Lütfen bilgileri giriniz");
}else{

$.post("kontrol.php",
{
eposta:$("#eposta").val(),
sifre:$("#sifre").val()
},
function(data,status){
if(data==1){
$(location).attr("href","main.php");
}else{
alert("Kullanıcı Adınız veya Şifreniz Yanlış");
}
}
);
}

});

});
</script>
</head>
<body>
<label class="adminLabel">Yönetici Paneli</label>
<div class="girisEkrani">
<label class="girisYazi">Giriş için bilgileri doldurunuz</label>
<input type="email" id="eposta" placeholder="Eposta">
<input type="password" id="sifre" placeholder="Şifre">
<button id="giris">Giriş</button>

</div>
</body>
</html>