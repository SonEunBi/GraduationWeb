<!DOCTYPE html>
<html>
<head> 
	<meta charset="utf-8">
	<title>견적 비교 사이트</title>
	<link rel="stylesheet" type="text/css" href="./css/common.css">
	<link rel="stylesheet" type="text/css" href="./css/main.css">
	<link rel="stylesheet" type="text/css" href="./css/board.css">
	<style type="text/css">
		.re_ct {font-weight:bold; color:blue;}
		button{
			cursor: pointer;       
			height: 30px; 
			background-color: #3A3845; color: whitesmoke; 
			border :hidden;

		}
		#search_view{
			transition-duration: 0.4s;
			cursor: pointer;
			float: absolute;
			width:480px;
			border-radius: 32px;
			height: 55px;
			font-size:medium;
		}
		

	</style>
	
</head>
<header>
	<?php include "reply_idx.php";?>
	<?php include "header.php";?>
	<br><br><br><br><br>
</header>  
<body> 

	<?php

	/* 검색 변수 */
	$catagory = $_GET['catgo'];
	$search_con = $_GET['search'];
	?>
	<div id="board_box">
		
		

		<h1><b>'<?php echo $search_con; ?>'&nbsp;검색결과</b></h1>
		<!-- 	<h4 style="margin-top:30px; border-bottom: 1px solid #444;"><a href="/">홈으로</a></h4> -->
		<table class="list-table" style="border-top: 2px solid #444; text-align:center">
			<thead style="">
				<tr style="text-align:center;">
					<b><th width="70">번호</th>
						<th width="500">제목</th>
						<th width="120">글쓴이</th>
						<th width="100">등록일</th>
						<th width="100">조회수</th></b>
					</tr>
				</thead><br>
				<?php
				$con = mysqli_connect("localhost", "user1", "12345", "userdata");
				$sql2 ="select * from board where $catagory like '%$search_con%' order by num desc";

				$result = mysqli_query($con, $sql2);
			// 			$row=mysqli_fetch_array($result);
  	// $total_record = mysqli_num_rows($result); // 전체 글 수
  	// $num_match = mysqli_num_rows($result);


				while($board = $result->fetch_array()){

					$title=$board["subject"]; 
					if(strlen($title)>30)
					{ 
						$title=str_replace($board["subject"],mb_substr($board["subject"],0,30,"utf-8")."...",$board["subject"]);
					}
					$sql3 = "select * from reply where con_num='".$board['num']."'";
					$result1 = mysqli_query($con, $sql2);
					$rep_count = mysqli_num_rows($result1);
					?>
					<tbody  style="border-bottom: 1px solid #444;">
						<tr>
							<td width="30"><?php echo $board['num']; ?></td>
							<td width="200" style="text-align:left"><?php echo $board['subject']; ?></td>

							<td width="120"><?php echo $board['id']?></td>
							<td width="100"><?php echo $board['regist_day']?></td>
							<td width="100"><?php echo $board['hit']; ?></td>

						</tr>
					</tbody>
				<?php } ?>
			</table><br><br><br><br><br><br>
		</div>
			<center>
				<div id="search_box" style="padding-left:400px">
					<form action="board_search_list.php" method="get">
						<select name="catgo" style="height:30px;float: left;">
							<option value="subject">제목</option>
							<option value="name">글쓴이</option>
							<option value="num">글번호</option>
						</select>
						<input type="text" name="search" size="80" required="required" style="float: left; height:30px;" />
						<button  style="float: left; height:30px; width: 70px;">검색</button>
					</form></div></center>
				</body>
				</html>