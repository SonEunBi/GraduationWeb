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
	<?php include "header.php";?>

	<?php include "reply_idx.php";?>
	<br><br><br><br><br>
</header>  
<body> 

	<div id="board_box">
		<h3>
			가격 공유
		</h3>
		<ul id="board_list">
			<li>
				<span class="col1">번호</span>
				<span class="col2">제목</span>
				<span class="col3">글쓴이</span>
				<span class="col4">사진</span>
				<span class="col5">등록일</span>
				<span class="col6">조회</span>
			</li>
			<?php
			if (isset($_GET["page"]))
				$page = $_GET["page"];
			else
				$page = 1;

			$con = mysqli_connect("localhost", "user1", "12345", "userdata");
			$sql = "select * from board order by num desc";
			$result = mysqli_query($con, $sql);
	$total_record = mysqli_num_rows($result); // 전체 글 수

	$scale = 10;

	// 전체 페이지 수($total_page) 계산 
	if ($total_record % $scale == 0)     
		$total_page = floor($total_record/$scale);      
	else
		$total_page = floor($total_record/$scale) + 1; 

	// 표시할 페이지($page)에 따라 $start 계산  
	$start = ($page - 1) * $scale;      

	$number = $total_record - $start;
	
	for ($i=$start; $i<$start+$scale && $i < $total_record; $i++)
	{
		mysqli_data_seek($result, $i);
      // 가져올 레코드로 위치(포인터) 이동
		$row = mysqli_fetch_array($result);
      // 하나의 레코드 가져오기
		$num         = $row["num"];
		$id          = $row["id"];
		$name        = $row["name"];
		$subject     = $row["subject"];
		$regist_day  = $row["regist_day"];
		$hit         = $row["hit"];

		$file_name    = $row["file_name"];
		$file_type    = $row["file_type"];
		$file_copied  = $row["file_copied"];
		

		?>
		<li>
			<span class="col1"><?=$number?></span>
			<span class="col2"><a href="board_view.php?num=<?=$num?>&page=<?=$page?>"><?=$subject?>&nbsp;</a></span>
			<span class="col3"><?=$name?></span>
			<span class="col4"><?=$row["image"]?></span>
			<span class="col5"><?=$regist_day?></span>
			<span class="col6"><?=$hit?></span>
		</li>

		<?php

 //echo $rep_count; 
		$number--;
	}

	?>

</ul>
<ul id="page_num"> 	
	<?php
	if ($total_page>=2 && $page >= 2)	
	{
		$new_page = $page-1;
		echo "<li><a href='board_list.php?page=$new_page'>◀ 이전</a> </li>";
	}		
	else 
		echo "<li>&nbsp;</li>";

   	// 게시판 목록 하단에 페이지 링크 번호 출력
	for ($i=1; $i<=$total_page; $i++)
	{
		if ($page == $i)     // 현재 페이지 번호 링크 안함
		{
			echo "<li><b> $i </b></li>";
		}
		else
		{
			echo "<li><a href='board_list.php?page=$i'> $i </a><li>";
		}
	}
	if ($total_page>=2 && $page != $total_page)		
	{
		$new_page = $page+1;	
		echo "<li> <a href='board_list.php?page=$new_page'>다음 ▶</a> </li>";
	}
	else 
		echo "<li>&nbsp;</li>";
	// mysqli_close();
	?>
</ul> <!-- page -->	    	
<ul class="buttons">
	<li><button onclick="location.href='board_list.php'">목록</button></li>
	<li>
		<?php 
		if($userid) {
			?>
			<button onclick="location.href='board_form.php'">글쓰기</button>
			<?php
		} else {
			?>
			<a href="javascript:alert('로그인 후 이용해 주세요!')"><button>글쓰기</button></a>
			<?php
		}
		?>
	</li>
</ul>
</div> <!-- board_box -->
<br><br>
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
	</form></div>
</div>
</center>


<footer>
	<?php include "footer.php";?>
</footer>
</body>
</html>
