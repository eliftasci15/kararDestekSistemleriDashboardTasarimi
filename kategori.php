<?php

session_start();
?>


<!DOCTYPE html>
<html>
<head>
<title>Dashboard Main</title>
<meta charset="utf-8">
<link href="kategoristyle.css" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
<link rel="stylesheet" href="font-awesome/css/font-awesome.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js">
  </script>
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
  font-size:12px;}
.boxes{
	width:100%;
	display:flex;
}
.content .grafikler .grafikler1{
	width:100%;
	
}
.content .grafikler .grafikler2{
	width:100%;
	display:flex;
	padding-top:70px;
	
}
.content .grafikler .grafikler3{
	width:100%;
	display:flex;
	padding-top:70px;
	
}
.content .grafikler .grafikler4{
	width:100%;
	display:flex;
	padding-top:70px;
	
}
.content .grafikler .grafikler2 .grafik1{
	width:400px;
	height:200px;
	padding-left:100px;
}
.content .grafikler .grafikler2 .grafik2{
	width:400px;
	height:200px;
	padding-left:120px;
}
.content .grafikler .grafikler3 .grafik3{
	width:400px;
	height:200px;
	padding-left:100px;
}
.content .grafikler .grafikler3 .grafik4{
	width:400px;
	height:200px;
	padding-left:120px;
}
.content .grafikler .grafikler4 .grafik5{
	width:400px;
	height:200px;
	padding-left:100px;
}
.content .grafikler .grafikler4 .grafik6{
	width:400px;
	height:200px;
	padding-left:120px;
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
        <span>Kategoriler</span>
        </div>
        <div class="navigation">
        <i class="fas fa-tachometer-alt"></i>
        <span>Kategoriler</span>
        <span>></span>
        <span>Dashboard</span>
        </div>
    </div>
	</div>
<div class="grafikler">
<div class="grafikler1">
  <div id="columnSütunchart" style="width: 1100px; height: 450px; padding-top:20px; padding-left:50px; float: left; background-color: transparent;"></div>
	</div>
<div class="grafikler2">	
<div class="grafik1">	
<canvas id="myChart"></canvas>
</div>
<div class="grafik2">	
<canvas id="myChart1"></canvas>
</div>
</div>
<div class="grafikler3">	
<div class="grafik3">	
<canvas id="myChart2"></canvas>
</div>
<div class="grafik4">	
<canvas id="myChart3"></canvas>
</div>
</div>
<div class="grafikler4">	
<div class="grafik5">	
<canvas id="myChart4"></canvas>
</div>
<div class="grafik6">	
<canvas id="myChart5"></canvas>
</div>
</div>
</div>
	</div>
	</body>
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
 <script type="text/javascript">
 google.load("visualization", "1", {packages:["corechart"]});
 google.setOnLoadCallback(drawSütunChart);
 function drawSütunChart() {
 var data_val = google.visualization.arrayToDataTable([

 ['Kategori', 'Satılan Ürün Sayısı'],
 <?php 
 $baglanti=mysqli_connect("localhost","root","","2018469049");
 mysqli_set_charset($baglanti, "UTF8");
 $select_query = "SELECT kategori.kategori_id, kategori.kategori_adi, sum(satilan.adet) as kategori_satis
FROM satilan, urunler, kategori
WHERE satilan.urun_id=urunler.urun_id
AND urunler.kategori_id=kategori.kategori_id
GROUP BY kategori.kategori_id
ORDER BY kategori_satis";

 $query_result = mysqli_query($baglanti,$select_query);
 while($row_val = mysqli_fetch_array($query_result)){

 echo "['".$row_val['kategori_adi']."',".$row_val['kategori_satis']."],";
 }
 ?>
 
 ]);

 var options_val = {
 'title': 'Kategoriye Göre Satış Sayıları',
 'backgroundColor':'transparent'
 };
 var chart_val = new google.visualization.ColumnChart(document.getElementById("columnSütunchart"));
 chart_val.draw(data_val, options_val);
 }
 </script>

  <script>
  var ctx = document.getElementById('myChart').getContext('2d');
var chart = new Chart(ctx, {
    // The type of chart we want to create
    type: 'bar',

    // The data for our dataset
    data: {
        labels: ['Şort', 'Tayt', 'Kazak', 'Etek', 'Eşofman', 'Elbise', 'Gömlek', 'Pantolon', 'Ceket', 'Mont', 'T-shirt', 'Sweatshirt'],
        datasets: [{
            label: 'Karşıyaka Ş. Kategoriye Göre Satışlar',
            
            borderColor: '#ccb2b3',
			backgroundColor: '#ccb2b3',
            data: [2, 1, 5, 2, 1, 4, 4, 5, 5, 2, 7, 15]
        }]
    },

    // Configuration options go here
    options: {}
});
  </script>
    <script>
  var ctx = document.getElementById('myChart1').getContext('2d');
var chart = new Chart(ctx, {
    // The type of chart we want to create
    type: 'bar',

    // The data for our dataset
    data: {
        labels: ['Şort', 'Tayt', 'Kazak', 'Etek', 'Eşofman', 'Elbise', 'Gömlek', 'Pantolon', 'Ceket', 'Mont', 'T-shirt', 'Sweatshirt'],
        datasets: [{
            label: 'Konak Ş. Kategoriye Göre Satışlar',
            
            borderColor: '#eb8d69',
			backgroundColor: '#eb8d69',
            data: [2, 1, 1, 2, 5, 6, 4, 2, 2, 6, 8, 7]
        }]
    },

    // Configuration options go here
    options: {}
});
  </script>
     <script>
  var ctx = document.getElementById('myChart2').getContext('2d');
var chart = new Chart(ctx, {
    // The type of chart we want to create
    type: 'bar',

    // The data for our dataset
    data: {
        labels: ['Şort', 'Tayt', 'Kazak', 'Etek', 'Eşofman', 'Elbise', 'Gömlek', 'Pantolon', 'Ceket', 'Mont', 'T-shirt', 'Sweatshirt'],
        datasets: [{
            label: 'Buca Ş. Kategoriye Göre Satışlar',
            
            borderColor: '#d97b66',
			backgroundColor: '#d97b66',
            data: [1, 1, 2, 4, 3, 4, 5, 2, 3, 4, 5, 4]
        }]
    },

    // Configuration options go here
    options: {}
});
  </script>
      <script>
  var ctx = document.getElementById('myChart3').getContext('2d');
var chart = new Chart(ctx, {
    // The type of chart we want to create
    type: 'bar',

    // The data for our dataset
    data: {
        labels: ['Şort', 'Tayt', 'Kazak', 'Etek', 'Eşofman', 'Elbise', 'Gömlek', 'Pantolon', 'Ceket', 'Mont', 'T-shirt', 'Sweatshirt'],
        datasets: [{
            label: 'Balçova Ş. Kategoriye Göre Satışlar',
            borderColor: '#ffbd8b',
			backgroundColor: '#ffbd8b',
            data: [1, 1, 1, 2, 2, 2, 3, 3, 3, 6, 2, 2]
        }]
    },

    // Configuration options go here
    options: {}
});
  </script>
       <script>
  var ctx = document.getElementById('myChart4').getContext('2d');
var chart = new Chart(ctx, {
    // The type of chart we want to create
    type: 'bar',

    // The data for our dataset
    data: {
        labels: ['Şort', 'Tayt', 'Kazak', 'Etek', 'Eşofman', 'Elbise', 'Gömlek', 'Pantolon', 'Ceket', 'Mont', 'T-shirt', 'Sweatshirt'],
        datasets: [{
            label: 'Bornova Ş. Kategoriye Göre Satışlar',
            
            borderColor: '#fdc2be',
			backgroundColor: '#fdc2be',
            data: [1, 2, 3, 3, 5, 3, 2, 6, 5, 6, 3, 3]
        }]
    },

    // Configuration options go here
    options: {}
});
  </script>
        <script>
  var ctx = document.getElementById('myChart5').getContext('2d');
var chart = new Chart(ctx, {
    // The type of chart we want to create
    type: 'bar',

    // The data for our dataset
    data: {
        labels: ['Şort', 'Tayt', 'Kazak', 'Etek', 'Eşofman', 'Elbise', 'Gömlek', 'Pantolon', 'Ceket', 'Mont', 'T-shirt', 'Sweatshirt'],
        datasets: [{
            label: 'Bayraklı Ş. Kategoriye Göre Satışlar',
          
            borderColor: '#c5e2f6',
			backgroundColor: '#c5e2f6',
            data: [1, 1, 2, 3, 2, 1, 1, 4, 4, 1, 2, 4]
        }]
    },

    // Configuration options go here
    options: {}
});
  </script>
	</html>