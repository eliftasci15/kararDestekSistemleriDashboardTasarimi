<?php

session_start();
?>


<!DOCTYPE html>
<html>
<head>
<title>Dashboard Main</title>
<meta charset="utf-8">
<link href="satisstyle.css" rel="stylesheet">
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
.grafikler{	
	display:flex;
	padding-left:20px;	
}


.content .icerik .grafikler .grafik1{
	width:500px;
	height:300px;
	padding-top:50px;
	padding-left:40px;
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
      <a href="main.php">Gösterge Paneli</a></span>
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
      <span><i class="fas fa-shopping-cart"></i>
       <a href="satis.php">Satışlar</a></span>
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
        <span>Satışlar</span>
        </div>
        <div class="navigation">
        <i class="fas fa-tachometer-alt"></i>
        <span>Satışlar</span>
        <span>></span>
        <span>Dashboard</span>
        </div>
    </div>
	</div>
	<div class="icerik">

<div class="grafikler">
<div class="grafik1">
<canvas id="myChart"></canvas>
</div>
<div class="grafik2">
<canvas id="myChart1"></canvas>
</div>
</div>


</div>
	</div>
	</body>
<script> 
$.post("data.php",
 function(data){ 
 console.log(data);
 var subeId=[];
 var toplamSatis=[];
 for (var i in data){ 
 subeId.push(data[i].subeId); 
 toplamSatis.push(data[i].toplamSatis);
 };
 console.log(subeId);
 console.log(toplamSatis);

 var chartdata={ 
 labels:subeId,
 datasets:[{ 
 label:"Şubelere Göre Toplam Satış Sayıları",
 data:toplamSatis ,
  backgroundColor: [
                '#dda8b5',
                '#b87d95',
                '#4d2a4f',
                '#7b81a6',
                '#74828f',
                '#29102e'
            ],
            borderColor: [
                '#fccdd3',
                '#c25b56',
                '#beb9b5',
                '#96c0ce',
                '#74828f',
                '#525564'
            ],
 }] 
 }; 
 var myChart=$("#myChart");
 var barGrafik=new Chart(myChart,{
	 type:"bar",
	 data:chartdata,
	
	 options: { 
	 scales: { 
	 yAxes: [{
		 stacked: true 
		 }]
	 
		 } 
		 }
	
		 }); 
		 })
		


</script>
	</html>