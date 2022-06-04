<!DOCTYPE html>
<html>
<head> 
	<meta charset="utf-8">
	<title>비교 견적 사이트</title>
	<link rel="stylesheet" type="text/css" href="./css/common.css">
	<link rel="stylesheet" type="text/css" href="./css/search.css">
	<link rel="stylesheet" type="text/css" href="./css/board.css">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="icon" type="image/png" href="https://colorlib.com/etc/tb/Table_Responsive_v1/images/icons/favicon.ico">
	<link rel="stylesheet" type="text/css" href="./js/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="./js/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="./js/animate.css">
	<link rel="stylesheet" type="text/css" href="./js/select2.min.css">
	<link rel="stylesheet" type="text/css" href="./js/perfect-scrollbar.css">
	<link rel="stylesheet" type="text/css" href="./js/util.css">
	<link rel="stylesheet" type="text/css" href="./js/main.css">
	<meta name="robots" content="noindex, follow">
	<script type="text/javascript" src="./js/search.js"></script>
	<script type="text/javascript" async="" src="./js/analytics.js.다운로드" nonce="e4dbe109-d41c-4a25-8281-663bc2b5c3da"></script><script defer="" referrerpolicy="origin" src="./js/s.js.다운로드"></script>
	
	<style type="text/css">
		tbody tr{
			height: 80px;
		}
		tbody td:nth-child(1) { width: 50px; }
		tbody td:nth-child(2) { width: 150px; }
		tbody td:nth-child(3) { width: 150px; }
		tbody td:nth-child(3) { width: 150px; }


		.footerSc{

			bottom:140px;
			bottom: 0;
			width:100%;
			margin-top: 320px;
		}
		td {
			font-size: 20px;
		}

	</style>
</head>
<body> 

	<header>
		<?php include "header.php";?>
	</header>
	<br><br> 

	<div id="btn_group" style="margin-left:40%"><br><br>
		<button id="search_case1" onclick='find_normal1()'>검색 결과</button>
		<button id="search_case2" onclick='find_num1()'>평균 시세</button>
	</div>

	<br><br><br>
	<center>
		<div id="wrapper">
			<div class="limiter">
				<div class="wrap-table100">
					<div class="table100">

						<table>
							<thead >
								<tr class="table100-head">
									<th class="column1" >부품번호</th>
									<th class="column3" >세부사항</th>
									<th class="column4">가격</th>
								</tr>
							</thead>

							<?php

							if(isset($_POST["partnum"]))
								$partnum = $_POST["partnum"];
							else{
								$partnum=null;
								echo "<br>   <br>";
							}
							$con = mysqli_connect("localhost", "user1", "12345", "userdata");
							$sql = "select * from board WHERE partnum = '$partnum' order by partnum";

							$result = mysqli_query($con, $sql);
							$row=mysqli_fetch_array($result);
  	$total_record = mysqli_num_rows($result); // 전체 글 수
  	$num_match = mysqli_num_rows($result);

  	$image = array("01.jpg", "02.jpg", "03.jpg", "04.jpg", "05.jpg", "06.jpg", "07.jpg", "08.jpg");
  	$v_location=array("서울","부산","대구","인천","광주","대전","울산","강원","경기","경남","경북","전남","전북","제주","충남","충북");
  	$partname_arr=array("범퍼","보넷","트렁크","루프","도어","스테프","휀더","기타");

  	if(!$num_match) 
  	{
  		echo("
  			<script>
  			window.alert('등록되지 않은 데이터입니다!')
  			history.go(-1)
  			</script>
  			");
  	}
  	else{

  		for ($i = 0;  $i < $num_match; $i++) {
  			$k=0;
  			mysqli_data_seek($result, $i);
               // 가져올 레코드로 위치(포인터) 이동
  			$row = mysqli_fetch_array($result);
               // 하나의 레코드 가져오기
  			$partnum        = $row["partnum"];
  			$partname        = $row["partname"];
  			$cartype    = $row["cartype"];
  			$location   = $row["location"];
  			$price    = $row["price"];

  			// for($k=0; $k<8; $k++){
  			// 	if($partname_arr[$k]==$partname){
  			// 		$imgnum=$k+1;
  			// 	}
  			// }
  			?>



  			<tbody align="center">
  				<tr>
  					<td rowspan="3"class="column1" align="center"><?= $partnum ?></td>

  					<td class="column2" style="text-align: left"><b>부품명&nbsp;:&emsp;</b><?= $partname ?></td>

  					<td rowspan="3"class="column3"  style="text-align: center"><?= number_format($price)?>원</td>
  				</tr>
  				<tr>

  					<td class="column2"style="text-align: left"><b>차종&nbsp;:&emsp;</b><?= $cartype ?></td>

  				</tr>
  				<tr style="border-bottom:1px solid #444">

  					<td class="column2"style="text-align: left"><b>지역&nbsp;:&emsp;</b><?= $v_location[$location-1]?></td>
  					
  				</tr>
  				<?php
  			}

  		}?>
  	</tbody>
  </table>
</div>
</center>
<?php
  

$sql = "select round(avg(price),0) as avg 
from board 
where partnum=$partnum";

$result = mysqli_query($con, $sql);
$row=mysqli_fetch_array($result);

?>

<br>
<script type="text/javascript">
	$(function() {
		$('.table100 #btn1').on('click', function() {
			$('#avg_norm').show();
			$('#avg_date').hide();
			$('#avg_loc').hide();
		});

		$('.table100 #btn2').on('click', function() {
			$('#avg_date').show();
			$('#avg_norm').hide();
			$('#avg_loc').hide();
		});

		$('.table100 #btn3').on('click', function() {
			$('#avg_loc').show();
			$('#avg_norm').hide();
			$('#avg_date').hide();
		});
	});
</script>
<center>
	<div id="wrapper2">


		<div class="limiter">
			<div class="wrap-table100">
				<div class="table100">
					<div style="text-align: center; font-weight: bold; float: right;">
						<button type="button" id="btn1" style="color:white; border-right: none; padding: 5px 10px; background-color: darkgray;" >평균 시세</button>
						<button type="button" id="btn2"style="color:white; border-right: none; padding: 5px 10px; background-color: #444;" >주간 시세</button>
						<button type="button" id="btn3" style="color:white; padding: 5px 10px; background-color: #444;">월별 시세</button>
					</div>
					<table  id = "avg_norm" style="display:">
						<thead >
							<tr class="table100-head" style="text-align: center;">
								<th class="column1" >부품번호</th>
								<th class="column3" >세부사항</th>
								<th class="column4">가격</th>
							</tr>
						</thead>



						<tbody align="center">
							<tr>
								<td rowspan="3"class="column1" align="center"><?= $partnum ?></td>
								
								<td class="column2"style="text-align: left"><b>부품명&nbsp;:&emsp;</b><?= $partname ?></td>

							</tr>
							<tr>
								<td class="column2" style="text-align: left"><b>차종&nbsp;:&emsp;</b><?= $cartype ?></td>
								<td class="column3"><?= number_format($row['avg'])?>원</td>
							</tr>
							<tr>
								<td class="column2" style="text-align: left"><b>지역&nbsp;:&emsp;</b><?= $v_location[$location-1]?></td>
							</tr>
						</tbody>
					</table>


					<table id = "avg_date" style="display:none">
						<thead >
							<tr class="table100-head" style="text-align: center;">

								<th class="column1" >부품번호</th>
								<th class="column3" >세부사항</th>
								<th class="column4">개수</th>
								<th class="column5">평균 시세</th>
							</tr>
						</thead>


						<?php


						$sql="select partname, count(price) as count, avg(price) as avg from board where regist_day > date_add(now(),interval -7 day)
						group by partname asc";

						$result = mysqli_query($con, $sql);
						$row=mysqli_fetch_array($result);

$total_record = mysqli_num_rows($result); // 전체 글 수
$num_match = mysqli_num_rows($result);
if(!$num_match) 
{
	echo("
		<script>
		window.alert('등록되지 않은 데이터입니다!')
		history.go(-1)
		</script>
		");
}
else{

	for ($i = 0;  $i < $num_match; $i++) {
		mysqli_data_seek($result, $i);
               // 가져올 레코드로 위치(포인터) 이동
		$row = mysqli_fetch_array($result);
               // 하나의 레코드 가져오기
		$partname        = $row["partname"];
		$avg       = $row["avg"];
		$count = $row["count"];		

		?>

		<tbody align="center">
			<tr>
				<td rowspan="3"class="column1" align="center"><?= $partnum ?></td>
				<td class="column3"style="text-align: left"><b>부품명&nbsp;:&emsp;</b><?= $partname ?></td>
			</tr>
			<tr>
				<td class="column3" style="text-align: left"><b>차종&nbsp;:&emsp;</b><?= $cartype ?></td>
				<td class="column4"><?= number_format($row['count'])?>개</td>
				<td class="column4"><?= number_format($row['avg'])?></td>
			</tr>
			<tr>
				<td class="column3" style="text-align: left"><b>지역&nbsp;:&emsp;</b><?= $v_location[$location-1]?></td>
			</tr>
		</tbody>
	</table>

	<table  id = "avg_loc" style="display:none">
		<thead >
			<tr class="table100-head" style="text-align: center;">

				<th class="column1" >부품번호</th>
				<th class="column3" >세부사항</th>
				<th class="column3" >개수</th>
				<th class="column4">가격</th>
			</tr>
		<?php } }?>
	</thead>



	<?php

	$image = array("01.jpg", "02.jpg", "03.jpg", "04.jpg", "05.jpg", "06.jpg", "07.jpg", "08.jpg");
	$v_location=array("서울","부산","대구","인천","광주","대전","울산","강원","경기","경남","경북","전남","전북","제주","충남","충북");

	?>

	<tbody align="center">
		<tr>
			<td rowspan="3"class="column1" align="center"><?= $partnum ?></td>
			<td rowspan="3" class="column2"><img src="img/<?=$image[$imgnum]?>" width="250px" height="130px"></td>
			<td class="column3"style="text-align: left"><b>부품명&nbsp;:&emsp;</b><?= $partname ?></td>

		</tr>
		<tr>
			<td class="column3" style="text-align: left"><b>차종&nbsp;:&emsp;</b><?= $cartype ?></td>
			<td class="column4"><?= number_format($row['avg'])?>다</td>
		</tr>
		<tr>
			<td class="column3" style="text-align: left"><b>지역&nbsp;:&emsp;</b><?= $v_location[$rslocation-1]?></td>
		</tr>
	</tbody>
</table>
</div>
</center>
<?php

mysqli_close($con);

?>


<center>
	<br><br><br>

	<button id="search_btn2" value="재검색" height = "150px"action="search_db.php" onclick="location.href='search_db.php'">재검색
	</button> 
</center>


<br><br><br>
</div> <!-- main_content -->

</div></center></div></div></div></center>
<?php include "graph.php"; ?>
<footer class="footerSc">
	<?php include "footer.php";?>
</footer>
<script src="./js/jquery-3.2.1.min.js.다운로드"></script>

<script src="./js/popper.js.다운로드"></script>
<script src="./js/bootstrap.min.js.다운로드"></script>

<script src="./js/select2.min.js.다운로드"></script>

<script src="./js/main.js.다운로드"></script>

<script async="" src="./js/js"></script>
<script>
	window.dataLayer = window.dataLayer || [];
	function gtag(){dataLayer.push(arguments);}
	gtag('js', new Date());

	gtag('config', 'UA-23581568-13');
</script>
<script defer="" src="./js/v652eace1692a40cfa3763df669d7439c1639079717194" integrity="sha512-Gi7xpJR8tSkrpF7aordPZQlW2DLtzUlZcumS8dMQjwDHEnw9I7ZLyiOj/6tZStRBGtGgN6ceN6cMH8z7etPGlw==" data-cf-beacon="{&quot;rayId&quot;:&quot;711e791889e712e6&quot;,&quot;token&quot;:&quot;cd0b4b3a733644fc843ef0b185f98241&quot;,&quot;version&quot;:&quot;2021.12.0&quot;,&quot;si&quot;:100}" crossorigin="anonymous">


</script>
</body>
</html>