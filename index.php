<!DOCTYPE html>
<html>
<head> 
	<meta charset="utf-8">
	<title>비교견적사이트</title>
	<link rel="stylesheet" type="text/css" href="./css/common.css">
	<link rel="stylesheet" type="text/css" href="./css/main.css">
	<link rel="stylesheet" type="text/css" href="./css/style.css">
	<link href="css/bootstrap.min.css" rel ="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:100,300" rel="stylesheet" type="text/css">
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.1/jquery.min.js"></script>
	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

	<style type="text/css">
		#latest{
			background-color: white; height: 120%; width: 55%; border: 2px solid #444;
		}
		#point_rank{
			background-color: white; height: 120%; width: 55%;  border: 2px solid #444;
		}
		#data_sta{
			background-color: white; border: 2px solid #444; width: 100%;text-align: center; 
		}
		table{float: left;}
	</style>
	<?php
	session_start();
	if (isset($_SESSION["userid"])) $userid = $_SESSION["userid"];
	else $userid = "";
	if (isset($_SESSION["username"])) $username = $_SESSION["username"];
	else $username = "";
	?>
	
</head><br><br><br>

<div id="main_content">
	<div id="latest1">
		<h3><b>최신 글 목록</b></h3>

		<h5><label><b><a href="./board_list.php">전체보기 ></a></b></label></h5>

		<div id="latest"> 


			<ul>
				<!-- 최근 게시 글 DB에서 불러오기 -->
				<?php
				$con = mysqli_connect("localhost", "user1", "12345", "userdata");
				$sql = "select * from board order by num desc limit 5";
				$result = mysqli_query($con, $sql);

				$arrnum =array(1,2,3,4,5);
				$i=0;

				if (!$result)
					echo "최신 글이 존재하지 않습니다!";
				else
				{
					while( $row = mysqli_fetch_array($result) )
					{
						$regist_day = substr($row["regist_day"], 0, 10);
						
						?>
						<li>
							<span><b style="color:black"><?=$arrnum[$i]?><?='.'?></b></span>
							<span><?=$row["subject"]?></span>
							<span><?=$row["id"]?></span>
							<span><?=$row["name"]?></span>
							<span><?=$regist_day?></span>
						</li>
						<?php
						$i++;
					}
				}
			?></ul>
		</div>
	</div>
	<div id="point_rank1">
		<h3><b>인기 글 목록</b></h3>

		<h5><label><b><a href="./board_list.php">전체보기 ></a></b></label></h5>

		<div id="point_rank">

			<ul>
				<!-- 포인트 랭킹 표시하기 -->
				<?php
				$sql = "select * from board order by hit desc limit 5";
				$result = mysqli_query($con, $sql);
				$arrnum =array(1,2,3,4,5);
				$i=0;
				if (!$result)
					echo "아직 가입된 회원이 없습니다!";
				else
				{
					while( $row = mysqli_fetch_array($result) )
					{
						$name = $row["name"];
						$id = $row["id"];
						$hit    = $row["hit"];
						$subject = $row["subject"];
						$name = mb_substr($name, 0, 1)." * ".mb_substr($name, 2, 1);
						?>
						<li>

							<span><b style="color:black"><?=$arrnum[$i]?><?='.'?></b></span>
							<span><?=$subject?></span>
							<span><?=$id?></span>
							<span><?=$name?></span>
							<span><?=$hit?></span>
						</li>
						<?php
						$i++;
					}
				}

				?>
			</ul>
		</div>
	</div>
</div>

<div id="main_content" >
	<h5><b>회원 데이터 통계</b></h5>
	<div id="data_sta" style="border:1px solid #444; "></div>
<br>
		<div id="graph" style="width:110%; padding-left: 3%; float: left;">
			<?php include "graph.php"?>
			<?php  include "graph1.php"?>
			<?php  include "graph2.php"?>
		</div>
	</div>
</div>



	<body>
		<script src="js/jquery-3.6.0.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<header>
			<?php include "header.php";?>
		</header>


		<section>
			<?php include "main.php";?>
		</section> 


		<footer style="margin-top:0px">
			<?php include "footer.php";?>
		</footer>


	</body>
	</html>
