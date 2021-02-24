<?php

session_start();
?>


<!DOCTYPE html>
<html>
<head>
<title>Dashboard Main</title>
<meta charset="utf-8">
<link href="genelstyle.css" rel="stylesheet">
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
  font-size:12px;}
.boxes{
	width:100%;
	display:flex;
}

.content .boxes .box{
	width:240px;
	height:130px;
	background:#575f94;
	margin-top:25px;
	margin-right:15px;
	margin-left:33px;
	box-sizing:border-box;
	display:flex;
	justify-content:space-between;
	font-size:22px;
	padding-top:45px;
	padding-left:35px;
	color: white;
	border-width: 6px;
	border-style: double;
    border-color: white;
}
.content .boxes .box1{
	width:240px;
	height:130px;
	background:#575f94;
	margin-top:25px;
	margin-right:15px;
	margin-left:33px;
	box-sizing:border-box;
	display:flex;
	justify-content:space-between;
	font-size:22px;
	padding-top:30px;
	padding-left:35px;
	color: white;
	border-width: 6px;
	border-style: double;
    border-color: white;
}
.content .boxes .box2{
	width:240px;
	height:130px;
	background:#575f94;
	margin-top:25px;
	margin-right:15px;
	margin-left:33px;
	box-sizing:border-box;
	display:flex;
	justify-content:space-between;
	font-size:22px;
	padding-top:45px;
	padding-left:23px;
	color: white;
	border-width: 6px;
	border-style: double;
    border-color: white;
}
.content .boxes .box4{
	width:240px;
	height:130px;
	background:#575f94;
	margin-top:25px;
	margin-right:15px;
	margin-left:33px;
	box-sizing:border-box;
	display:flex;
	justify-content:space-between;
	font-size:22px;
	padding-top:45px;
	padding-left:28px;
	color: white;
	border-width: 6px;
	border-style: double;
    border-color: white;
}
.grafikler{	
	display:flex;
	padding-left:20px;	
}
.grafikler2{	
	display:flex;
	padding-left:20px;	
}
.grafikler3{	
	display:flex;
	
}

.content .icerik .grafikler .grafik1{
	width:520px;
	height:300px;
	padding-top:70px;
	padding-left:35px;
	
}
.content .icerik .grafikler .grafik2{
	width:520px;
	height:300px;
	padding-top:70px;
	padding-left:40px;

}
.content .icerik .grafikler2 .grafik3{
	width:500px;
	height:300px;
	padding-top:50px;
	padding-left:40px;

}
.content .icerik .grafikler2 #container{
	width:520px;
	height:320px;
	padding-top:40px;
	padding-left:60px;
}
.content .icerik .grafikler2 .grafik2{
	width:470px;
	height:320px;
	padding-top:60px;
	padding-left:50px;

}
.content .icerik .grafikler3 .grafik3{
	width:290px;
	height:100px;
	margin-top:15px;
	padding-left:90px;

}
.content .icerik .grafikler3 .grafik4{
    width:550px;
	height:300px;
	padding-top:50px;
	padding-left:70px;
}



</style>


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
        <span>Ana Sayfa</span>
        </div>
        <div class="navigation">
        <i class="fas fa-tachometer-alt"></i>
        <span>Ana Sayfa</span>
        <span>></span>
        <span>Dashboard</span>
        </div>
    </div>
</div>	
<div class="icerik">
<div class="boxes">
<div id="box1" class="box1">
    
</div>
<div id="box2" class="box2">
         
       </div>

<div id="box3" class="box">

</div>
<div id="box4" class="box4">

</div>
</div>
<div class="grafikler">
<div class="grafik1">
<canvas id="myChart"></canvas>
</div>
<div class="grafik2">
<canvas id="myChart1"></canvas>
</div>
</div>
<div class="grafikler2">
<div id="container"></div>

<div class="grafik2">	
<canvas id="myChart2"></canvas>
</div>
</div>
<div class="grafikler3">
<div class="grafik4">
<canvas id="myChart4"></canvas>
</div>
<div class="grafik3">
<canvas id="myChart3"></canvas>
</div>

</div>


</div>

</body>
<script>
$(document).ready(function(){
	$.post("getir.php",
	function(data,status){
		//console.log("Bounce rate:"+data);
		$("#box1").html("Toplam Satılan Ürün Sayısı:"+data);
	});
	$.post("getirGelir.php",
	function(data,status){
		//console.log("Bounce rate:"+data);
		$("#box2").html("Toplam Gelir:"+data);
	});
	$.post("getirSubeler.php",
	function(data,status){
		//console.log("Bounce rate:"+data);
		$("#box3").html("Şube Sayısı:"+data);
	});
	$.post("getirMusteri.php",
	function(data,status){
		//console.log("Bounce rate:"+data);
		$("#box4").html("Müşteri Sayısı:"+data);
	});
$("#ara").click(function(){
	$.post("ara.php",{
		kelime:$(".arama").val()
	},
	function(data,status){
		console.log(data);
	}
	)
});
});
</script>

<script> 
$.post("dateGelir.php",
 function(data){ 
 console.log(data);
 var subeAdi=[];
 var toplamGelir=[];
 for (var i in data){ 
 subeAdi.push(data[i].subeAdi); 
 toplamGelir.push(data[i].toplamGelir);
 };
 console.log(subeAdi);
 console.log(toplamGelir);

 var chartdata={ 
 labels:subeAdi,
 datasets:[{ 
 label:"Şubelere Göre Toplam Gelir",
 data:toplamGelir ,
  backgroundColor: [
                '#eea7b0',
                '#c25b56',
                '#beb9b5',
                '#96c0ce',
                '#1b0141',
                '#424370'
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
<script> 
$.post("dataMaliyet.php",
 function(data){ 
 console.log(data);
 var subeAdi=[];
 var toplamMaliyet=[];
 for (var i in data){ 
 subeAdi.push(data[i].subeAdi); 
 toplamMaliyet.push(data[i].toplamMaliyet);
 };
 console.log(subeAdi);
 console.log(toplamMaliyet);

 var chartdata={ 
 labels:subeAdi,
 datasets:[{ 
 label:"Şubelere Göre Maliyet",
 data:toplamMaliyet ,
  backgroundColor: [
                '#c9463d',
                '#ed6353',
                '#962e40',
                '#5e1742',
                '#b87d95',
                '#330136'
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
 var myChart=$("#myChart1");
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
<script>
anychart.onDocumentReady(function () {

    // create a data set
    var data = anychart.data.set([
      ["Karşıyaka", 2500, 2905],
      ["Konak", 2000, 2305],
      ["Buca", 1800, 1875],
      ["Balçova", 1500, 1430],
      ["Bornova", 2000, 2215],
	  ["Bayraklı", 1500, 1065]
    ]);

    // map the data
    var seriesData_1 = data.mapAs({x: 0, value: 1});
    var seriesData_2 = data.mapAs({x: 0, value: 2});

    // create a chart
    var chart = anychart.column();
    var chart = anychart.column();
    // set the interactivity mode
    chart.interactivity().hoverMode("single");

    // create the first series, set the data and name
    var series1 = chart.column(seriesData_1);
    series1.name("Planlanan");

    // configure the visual settings of the first series
    series1.normal().stroke("#3f5866", 1, "10 5", "round");
    series1.hovered().stroke("#b9dcf4", 2, "10 5", "round");
    series1.selected().stroke("#b9dcf4", 4, "10 5", "round");

    // create the second series, set the data and name  
    var series2 = chart.column(seriesData_2);
    series2.name("Gerçekleşen");

    // configure the visual settings of the second series
    series2.normal().stroke("#3f5866");
    series2.hovered().stroke("#3f5866", 2);
    series2.selected().stroke("#3f5866", 4);

    // set the chart title
    chart.title("Şubelerin Planlanan-Gerçekleşen Kârı");

    // set the titles of the axes
    chart.xAxis().title("Şubeler");
    chart.yAxis().title("Kâr Miktarları");
	
	chart.dataArea().background().enabled(true);
    chart.dataArea().background().fill("#ffd54f 0.2");

    // set the container id
    chart.container("container");

    // initiate drawing the chart
    chart.draw();
});

</script>
   <script>
var ctx = document.getElementById('myChart2').getContext('2d');
var chart = new Chart(ctx, {
    // The type of chart we want to create
    type: 'line',

    // The data for our dataset
    data: {
        labels: ['Ocak', 'Şubat', 'Mart', 'Nisan', 'Mayıs', 'Haziran', 'Temmuz', 'Ağustos', 'Eylül', 'Ekim', 'Kasım', 'Aralık'],
        datasets: [{
            label: 'Mağaza Genelinde Aylara Göre Satış Sayıları',
            
            borderColor: '#c04b44',
			backgroundColor:'',
            data: [22, 10, 10, 10, 11, 15, 12, 8, 10, 29, 42, 16]
        }]
    },

    // Configuration options go here
    options: {}
});
  </script>
  <script> 
$.post("data.php",
 function(data){ 
 console.log(data);
 var subeAdi=[];
 var toplamSatis=[];
 for (var i in data){ 
 subeAdi.push(data[i].subeAdi); 
 toplamSatis.push(data[i].toplamSatis);
 };
 console.log(subeAdi);
 console.log(toplamSatis);

 var chartdata={ 
 labels:subeAdi,
 datasets:[{ 
 label:"Şubelere Göre Toplam Satış Sayıları",
 data:toplamSatis ,
  backgroundColor: [
                '#79a7a8',
                '#ff8984',
                '#4d2a4f',
                '#f28c0f',
                '#d95043',
                '#202d54'
            ],
            borderColor: [
                '#79a7a8',
                '#ff8984',
                '#beb9b5',
                '#f28c0f',
                '#d95043',
                '#202d54'
            ],
 }] 
 }; 
 var myChart=$("#myChart3");
 var barGrafik=new Chart(myChart,{
	 type:"doughnut",
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
  <script> 
$.post("data.php",
 function(data){ 
 console.log(data);
 var subeAdi=[];
 var toplamSatis=[];
 for (var i in data){ 
 subeAdi.push(data[i].subeAdi); 
 toplamSatis.push(data[i].toplamSatis);
 };
 console.log(subeAdi);
 console.log(toplamSatis);
 
 var chartdata={ 
 labels:subeAdi,
 datasets:[{ 
 label:"Şubelere Göre Toplam Satış Sayıları",
 data:toplamSatis ,
  backgroundColor: [
                '#79a7a8',
                '#ff8984',
                '#4d2a4f',
                '#f28c0f',
                '#d95043',
                '#202d54'
            ],
            borderColor: [
                '#79a7a8',
                '#ff8984',
                '#beb9b5',
                '#f28c0f',
                '#d95043',
                '#202d54'
            ],
 }] 
 }; 
 var myChart=$("#myChart4");
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