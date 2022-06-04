<<<<<<< HEAD
<!DOCTYPE html>
<html>
<head> 
	<meta charset="utf-8">
	<title>견적 비교 사이트</title>
	<link rel="stylesheet" type="text/css" href="./css/common.css">
	<link rel="stylesheet" type="text/css" href="./css/board.css">
	<style type="text/css">
		.re_ct {font-weight:bold; color:blue;}
	</style>
	
</head>
<header>
		<?php include "reply_idx.php";?>
		<?php include "header.php";?>
	</header>  
<body> 
	

	</div>
	<div id="board_box">
		<h3>
			가격 문의
					</h3>
		<ul id="board_list">
			<li>
				<span class="col1">번호</span>
				<span class="col2">제목</span>
				<span class="col3">글쓴이</span>
				<span class="col4">첨부</span>
				<span class="col5">등록일</span>
				<span class="col6">조회</span>
			</li>
			<?php
			if (isset($_GET["page"]))
				$page = $_GET["page"];
			else
				$page = 1;

			$con = mysqli_connect("localhost", "user1", "12345", "userdata");
			$sql = "select * from inquiryboard order by num desc";
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
		if ($row["file_name"])
			$file_image = "<img src='./img/file.gif'>";
		else
			$file_image = " ";
		?>
		<li>
			<span class="col1"><?=$number?></span>
			<span class="col2"><a href="inquiry_board_view.php?num=<?=$num?>&page=<?=$page?>"><?=$subject?>&nbsp;[<?php echo $rep_count; ?>]</a></span>
			<span class="col3"><?=$name?></span>
			<span class="col4"><?=$file_image?></span>
			<span class="col5"><?=$regist_day?></span>
			<span class="col6"><?=$hit?></span>
		</li>	
		<?php
		$number--;
	}

	$sql = "select * from inquiryboard order by num desc limit 0,5";
        // board테이블에서 num를 기준으로 내림차순해서 5개까지 표시
	$sql1 = mysqli_query($con, $sql);
	while($board = $sql1->fetch_array())
	{
              //title변수에 DB에서 가져온 title을 선택
		$title=$board["subject"]; 
		if(strlen($title)>30)
		{ 
                //title이 30을 넘어서면 ...표시
			$title=str_replace($board["subject"],mb_substr($board["subject"],0,30,"utf-8")."...",$board["subject"]);
		}
              //댓글 수 카운트

		$sql = "select * from reply where con_num='".$board['num']."'";
		$sql2 = mysqli_query($con, $sql);
              //reply테이블에서 con_num이 board의 num와 같은 것을 선택
              $rep_count = mysqli_num_rows($sql2); //num_rows로 정수형태로 출력
          }
          ?>

      </ul>
      <ul id="page_num"> 	
      	<?php
      	if ($total_page>=2 && $page >= 2)	
      	{
      		$new_page = $page-1;
      		echo "<li><a href='inquiry_board_list.php?page=$new_page'>◀ 이전</a> </li>";
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
			echo "<li><a href='inquiry_board_list.php?page=$i'> $i </a><li>";
		}
	}
	if ($total_page>=2 && $page != $total_page)		
	{
		$new_page = $page+1;	
		echo "<li> <a href='inquiry_board_list.php?page=$new_page'>다음 ▶</a> </li>";
	}
	else 
		echo "<li>&nbsp;</li>";
	?>
</ul> <!-- page -->	    	
<ul class="buttons">
	<li><button onclick="location.href='inquiry_board_list.php'"
                  style=" width: 72px;
                       font-size:15px;
                       font-family: 'Nanum Gothic';
                       color: #d4d5d9;
                       line-height: 25px;
                       text-align: center;
                       background: #333f50;
                       border: solid 1px#333f50;
                       border-radius: 12px;">목록</button></li>
	<li>
		<?php 
		if($userid) {
			?>
			<button onclick="location.href='inquiry_board_form.php'"
                      style=" width: 72px;
                       font-size:15px;
                       font-family: 'Nanum Gothic';
                       color: #d4d5d9;
                       line-height: 25px;
                       text-align: center;
                       background: #333f50;
                       border: solid 1px#333f50;
                       border-radius: 12px;">글쓰기</button>
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
</section> 
<footer>
	<?php include "footer.php";?>
</footer>
</body>
</html>
=======
