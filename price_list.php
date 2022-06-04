<!DOCTYPE html>
<html>
<head> 
	<meta charset="utf-8">
	<title>비교 견적 사이트</title>
	<link rel="stylesheet" type="text/css" href="./css/common.css">
	<link rel="stylesheet" type="text/css" href="./css/board.css">

</head>
<body> 
	<header>
		<?php include "header.php";?>
	</header>

	<div id="board_box"> 
		<h1 id="board_title"></h1>
		<h3><center>검색 결과</center></h3>
	</div>
	<style>
		.footerSc{

			bottom:140px;
			bottom: 0;
			width:100%;
			margin-top: 320px;
		}
		table{
			width:60%;
			background-color: #929292;}
			th, td{
				padding:8px;
				text-align: center;
				background-color: white;
			}
			td:nth-child(1){width: 100px;}
			td:nth-child(2){width: 170px;}
			td:nth-child(3){width: 170px;}
			td:nth-child(4){width: 170px;}
			td:nth-child(5){width: 170px;}
		</style>
		<center>
			<table class="search_result" border ="0" align="center">

				<tr>
					<th width="100">부품번호</th><th width="170">부품명</th><th width="170">차종</th><th width="170">카센터 위치</th><th width="170">가격</th>
				</tr><br>

			</table>
		</center>

		<?php
		if(isset($_POST["name"]) && isset($_POST["location"] && isset($_POST["num"])
		 || isset($_POST["cartype"] || isset($_POST["price"])){
			$name = $_POST["name"];
			$location = $_POST["location"];
			$num = $_POST["num"];}
			// $price = $_POST["price"];
			else{
				$name=null;
				echo "<br>   <br>";
			}
			$con = mysqli_connect("localhost", "user1", "12345", "carinfo");
			$sql = "select * from usercar WHERE num LIKE '%$num%' order by name asc";           
			$result = mysqli_query($con, $sql);
			$row=mysqli_fetch_array($result);
  	$total_record = mysqli_num_rows($result); // 전체 글 수
           // $total_rows=$row[0];
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
  		?>
  		<?php
  		for ($i = 0;  $i < $num_match; $i++) {
  			mysqli_data_seek($result, $i);
               // 가져올 레코드로 위치(포인터) 이동
  			$row = mysqli_fetch_array($result);
               // 하나의 레코드 가져오기
  			$num        = $row["num"];
  			$name        = $row["name"];
  			$location   = $row["location"];
  			$cartype    = $row["cartype"];
  			$price    = $row["price"];
  			?>

  			<center>
  				<table class="search_result" border ="0" style="height: 100px;">
  					<tr>
  						<td><mark><?= $num ?></mark></td>
  						<td><?= $name ?></td>
  						<td><?= $location ?></td>
  						<td><?= $cartype ?></td>
  						<td><?= $price?></td>
  					</tr>
  				</table>
  			</center>
  			<?php
  		}
  	}
  	mysqli_close($con);

  	?>
  </ul>


  <center>
  	<br><br><br>
  	<form class="search_view" method="post" action="price_list.php">
  		<input type="text" name="name" placeholder="부품명"> 
  		<input class="search_btn" type="submit" value="재검색" action="price_list.php"> </form> </center>
  		<br><br><br>
  	</div> <!-- main_content -->

  	<footer class="footerSc">
  		<?php include "footer.php";?>
  	</footer>
  </body>
  </html>