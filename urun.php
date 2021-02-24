<?php

session_start();
?>


<!DOCTYPE html>
<html>
<head>
<title>Dashboard Main</title>
<meta charset="utf-8">
<link href="urunstyle.css" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
<link rel="stylesheet" href="font-awesome/css/font-awesome.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js">
  </script>
   <script src="https://cdn.anychart.com/releases/8.9.0/js/anychart-base.min.js"></script>
   <script src="https://cdn.anychart.com/releases/8.9.0/js/anychart-base.min.js" type="text/javascript"></script>
<style>
body{
	font-family:'Graphik',Helvetica;
	height:1400px;
	display:flex;
	background:#d2d6de;
	margin:0;
}
.sidebar{
	width:500px;
	height:1400px;
	background-color:#1c223f;
	display:flex;
	flex-direction:column;
}
.sidebar .sidebarTop{
	width:200px;
	height:60px;
	background-color:#1c223f;
	color:fff;
	display:flex;
	align-items:center;
	justify-content:center;
	font-size:24px;
	color:white;
}
.sidebar .info #avatar{
	width:40px;
	height:40px;
	border-radius:20px;
	margin:10px;
} 
.sidebar .info{
	display:flex;
	width:100%;
} 
.sidebar .info .infoName{
	padding-top:20px;
	color:#fff;
}
.sidebar .search{
	display:flex;
}
.sidebar .search .arama{
	width:80%;
	margin-left:10px;
	background-color:#343a40;
	color:#fff;
}
.sidebar .search span{
	color: white;
	margin-left:2px;
}
.sidebar .mainNav{
  width:100%;
  height:50px;
  color:#dfd9d3;
  font-size:15px;
  display:flex;
  align-items:center;
  padding-left:28px;
}
a:link{ color: #dfd9d3;
             text-decoration:none; } 

a:visited{ color: #dfd9d3; 
             text-decoration:none; }  
a:hover{ color: black; 
             text-decoration:none; } 
			 
.sidebar .dash, .sube, .kategori, .urun, .musteri,.satis{
  background:#232b4e;
  width:100%;
  height:60px;
  padding:10px;
  box-sizing:border-box;
  display:flex;
  align-items:center;
  justify-content:space-between;
  font-size:15px;
  border-style: solid; 
  border-width: 1px;
  border-color: #dfd9d3;
}
.sidebar .dash span, .sube span, .kategori span, .urun span, .musteri span, .satis span{ 
  position:absolute;
  padding:20px;
  justify-content:space-between;
  color: #dfd9d3;
}
		 
.content{
	flex:1;
    flex-direction:column;
	background-color:#f1f1f1;
}
.content .header{
  width:1150px;
  height:60px;
  background:#99a2af;
  display:flex;
  align-items:center;
  padding-left:20px;
  box-sizing:border-box;
  color:#fff;
  justify-content:space-between;
}
.content .header img{
  width:40px;
  height:40px;
  border-radius:25px;
}
.content .header .not{
  margin-left:auto!important;
  width:100px;
  margin:800px;
  display:flex;
  justify-content:space-between;
}
.content .header .headerInfo{
  padding:25px;
  width:110px;
  display:flex;
  justify-content:space-between;
  align-items:center;
  font-size:14px;
}
.content .header .fa-cogs{
  margin-right:20px;
}
.content .main{
  width:1150px;
  height:60px;
  background:#f1f1f1; 
}
.content .main .nav{
  display:flex;
  width:100%;
  align-items:center;
  justify-content:space-between;
  padding:15px;
  box-sizing:border-box;
}
.content .main .nav .dash{
  font-size:22px;
}
.content .main .nav .navigation{
  font-size:12px;
  }
.content .tablolar{
    width:100%;
	display:flex;
}
.content .tablolar .tablolar1{
	width:430px;
	height:200px;	
	padding-top:30px;
	padding-left:90px;
}
.content .tablolar .tablolar2{
	width:420px;
	height:250px;	
	padding-top:30px;
	padding-left:100px;
}
.urunTablosu{
	border:2px solid black;
}
.urunTablosu td{
	border:1px solid black;
}
.urunTablosu tr{
	border:1px solid black;
}
.urunTablosu th{
	border:1px solid black;
}
.surunTablosu{
	border:2px solid black;
}
.surunTablosu td{
	border:1px solid black;
}
.surunTablosu tr{
	border:1px solid black;
}
.surunTablosu th{
	border:1px solid black;
}
.content .grafikler{
    width:100%;
	display:flex;
}
.content .icerik .grafikler #container{
	width:470px;
	height:330px;
	padding-top:0px;
	padding-left:80px;
}
.content .icerik .grafikler #container .button {
   background-color:white;
   padding-top:20px;
   padding-left:20px;
}
.content .icerik .grafikler .tablo{
	width:420px;
	height:250px;	
	padding-top:50px;
	padding-left:80px;
}
.degisimTablosu{
	border:2px solid black;
}
.degisimTablosu td{
	border:1px solid black;
}
.degisimTablosu tr{
	border:1px solid black;
}
.degisimTablosu th{
	border:1px solid black;
}
#baslik{
	font-size:20px;
	color:#354a5f;
	padding-left:100px;
}
#baslik1{
	font-size:20px;
	color:#354a5f;
	padding-left:100px;
}
#baslik2{
	font-size:20px;
	color:#354a5f;
	padding-left:100px;
}
#baslik3{
	font-size:18px;
	color:#354a5f;
	padding-left:50px;
}
</style>
<script>

</script>

</head>
<body>
<div class="sidebar">
<div class="sidebarTop">YöneticiPaneli</div>
<div class="info">
    <img id="avatar" src="<?php echo $_SESSION['resim'] ?>">
	     <span class="infoName"><?php echo $_SESSION['ad']," ",
		 $_SESSION['soyad'] ?></span>
</div>
<div class="search">
<input class="arama" type="text">
<span>
<i class="fas fa-search"></i>
</span> 
</div>
<div class="mainNav">Menü</div>
    <div class="dash">
      <span><i class="fas fa-tachometer-alt"></i>
      <a href="main.php">Ana Sayfa</a></span>
    </div>
<div class="sube">
      <span><i class="far fa-building"></i>
       <a href="subeler.php">Şubeler</a></span>
    </div>
<div class="kategori">
      <span><i class="fas fa-grip-horizontal"></i>
       <a href="kategori.php">Kategoriler</a></span>
    </div>
<div class="urun">
       <span><i class="fas fa-tags"></i>
       <a href="urun.php">Ürünler</a></span>
    </div>	
<div class="musteri">
      <span><i class="fas fa-users"></i>
       <a href="musteri.php">Müşteriler</a></span>
    </div>	
<div class="satis">
      <span><i class="fas fa-power-off"></i>
       <a href="index.php">Çıkış</a></span>
    </div>	
	
</div>
<div class="content">
<div class="header">
<i class="fas fa-align-justify"></i>

      <div class="not">
      <i class="far fa-envelope"></i>
      <i class="far fa-bell"></i>
      <i class="far fa-flag"></i>
      </div>
      <div class="headerInfo">
       <img src="https://totalconceptsroofing.com/wp-content/uploads/2018/06/people.png">
      <span>Elif Taşçı</span>
      </div>
      <i class="fas fa-cogs"></i>
</div>
 <div class="main">
      <div class="nav">
        <div>
        <span class="dash">Dashboard</span>
        <span>Ürünler</span>
        </div>
        <div class="navigation">
        <i class="fas fa-tachometer-alt"></i>
        <span>Ürünler</span>
        <span>></span>
        <span>Dashboard</span>
        </div>
    </div>
	</div>
<div class="icerik">
<div  class="tablolar">
<div class="tablolar1">
<span id="baslik">Hiç Satılmayan Ürünler</span>
<table class="urunTablosu">
<tr>
<th>Ürün Id</th>
<th>Ürün Adı</th>
<th>Kategori Adı</th>
<th>Fiyat</th>
</tr>

</table>
</div>
<div class="tablolar2">
<span id="baslik1">En Çok Satılan Ürünler</span>
<table class="surunTablosu">
<tr>
<th>Ürün Id</th>
<th>Ürün Adı</th>
<th>Fiyat</th>
<th>Satış Sayısı</th>
</tr>
</table>
</div>
</div>
<div class="grafikler">
<div id="container">
<span id="baslik3">Fiyatı Değişen Ürünlerin Satış Karşılaştırması</span>
<div class="button">
<button onclick="winter()">Fiyat Değişiminden Önce</button>
<button onclick="spring()">Fiyat Değişiminden Sonra</button>

</div>
</div>
<div class="tablo">
<span id="baslik2">Fiyatı Değişen Ürünler</span>
<table class="degisimTablosu">
<tr>
<th>Ürün Id</th>
<th>Ürün Adı</th>
<th>Eski Fiyat</th>
<th>Yeni Fiyat</th>
</tr>
<tr>
<td>59</td>
<td>kadın kürklü pembe mont</td>
<td>240</td>
<td>200</td>
</tr>
<tr>
<td>126</td>
<td>Erkek lacivert fermuarlı ceket</td>
<td>230</td>
<td>180</td>
</tr>
<tr>
<td>3</td>
<td>kadın beyaz kapüşonlu sweatshirt</td>
<td>75</td>
<td>50</td>
</tr>
<tr>
<td>130</td>
<td>Erkek mor basic sweatshirt</td>
<td>80</td>
<td>55</td>
</tr>
<tr>
<td>37</td>
<td>kadın beyaz yüksek bel pantolon</td>
<td>65</td>
<td>50</td>
</tr>
</table>
</div>
</div>

</div>

	</div>
	</body>
<script>
$(document).ready(function(){
	$.post("urunTablosuGetir.php",function(data,status){
		$(".urunTablosu").append(data);
	});
	
	$.post("surunTablosuGetir.php",function(data,status){
		$(".surunTablosu").append(data);
	});
	
});
</script>
<script>
anychart.onDocumentReady(function () {

    stage = anychart.graphics.create("container");

    layer_1 = stage.layer();
    layer_1.zIndex(80);
    layer_2 = stage.layer();
    layer_3 = stage.layer();
    layer_4 = stage.layer();
    layer_5 = stage.layer();
    layer_5.zIndex(100);
	
    var data_1 = [
      {x: "59", value: 2, fill:"#00FFFF"},
      {x: "126", value: 1, fill:"#0DD9E6"},
      {x: "3", value: 1, fill:"#1AB2CC"},
      {x: "130", value: 2, fill:"#268CB2"},
      {x: "37", value: 1, fill:"#336699"}
    ];

    var chart_1 = anychart.column();
    chart_1.title("Fiyat Değişiminden Önce");
    chart_1.padding(50, 0, 0, 0);
    var series_1 = chart_1.column(data_1);
    series_1.stroke(null);

    chart_1.container(layer_1).draw();

    var data_2 = [
      {x: "59", value: 5, fill:"#FFCC99"},
      {x: "126", value: 3, fill:"#F2BFB2"},
      {x: "3", value: 4, fill:"#E6B2CC"},
      {x: "130", value: 2, fill:"#D9A6E6"},
      {x: "37", value: 3, fill:"#CC99FF"}
    ];

    var chart_2 = anychart.column();
    chart_2.title("Fiyat Değişiminden Sonra");
    chart_2.padding(50, 0, 0, 0);
    var series_2 = chart_2.column(data_2);
    series_2.stroke(null);

    chart_2.container(layer_2).draw();


});

function winter() {
  stage.suspend();
  layer_1.zIndex(1000000);
  layer_2.zIndex(0);
  layer_3.zIndex(0);
  layer_4.zIndex(0);
  stage.resume();
};

function spring() {
  stage.suspend();
  layer_1.zIndex(0);
  layer_2.zIndex(1000000);
  layer_3.zIndex(0);
  layer_4.zIndex(0);
  stage.resume();
};


</script>	
	
	</html>