
<!DOCTYPE html>
<html>
<head> 
	<meta charset="utf-8">
	<title>비교 견적 게시판</title>
	<link rel="stylesheet" type="text/css" href="./css/common.css">
	<link rel="stylesheet" type="text/css" href="./css/board.css">
	<link rel="stylesheet" type="text/css" href="./css/reply.css">
	<link rel="stylesheet" type="text/css" href="./css/style.css">
	<script type="text/javascript" src="common.js"></script>
</head>

<body> 
	<header>
		<?php include "header.php";?>
	</header>  
	<section>
	</div><br><br><br>
	<div id="board_box">
		<h3 class="title">
			견적공유 > 내용보기
		</h3>
		<?php
		$num  = $_GET["num"];
		$page  = $_GET["page"];
		$v_location=array("서울","부산","대구","인천","광주","대전","울산","강원","경기","경남","경북","전남","전북","제주","충남","충북");

		$con = mysqli_connect("localhost", "user1", "12345", "userdata");
		$sql = "select * from inquiryboard where num = $num";
		$result = mysqli_query($con, $sql);
		$row = mysqli_fetch_array($result);

		$id      = $row["id"];
		$name      = $row["name"];
		$regist_day = $row["regist_day"];
		$subject    = $row["subject"];
		$location    = $row["location"];
		$partnum    = $row["partnum"];
		$partname    = $row["partname"];
		$price =$row['price'];
		$content    = $row["content"];
		$file_name    = $row["file_name"];
		$file_type    = $row["file_type"];
		$file_copied  = $row["file_copied"];
		$hit          = $row["hit"];
	$repairtype =$row['repairtype'];

		$content = str_replace(" ", "&nbsp;", $content);
		$content = str_replace("\n", "<br>", $content);

		$new_hit = $hit + 1;
		$sql = "update inquiryboard set hit=$new_hit where num=$num";   
		?>		
		<ul id="view_content">
			<li>
				<span class="col1"><b>제목 | </b> <?=$subject?></span>
				<span class="col2"><?=$name?> | <?=$regist_day?></span>
			</li>
			<li>
				<span class="col1" style="float:left; margin-bottom: 15px; width:450px"><b>수리 유형 | </b> <?=$repairtype?></span>
				<span class="col3" style="float:center;"><b>부품명 | </b> <?=$partname?></span>
				<span class="col5" style="float:right;"><b>지역 | </b> <?= $v_location[$location-1]?></span>
			</li>
			
			<li>
				<span class="col3"><b>가격 | </b><?=$price?></span>
			</li>
			<li><br>&nbsp;&nbsp;
				<span class="col6">&nbsp;&nbsp;<b>내용 | </b></span>
<div id = "content_box" style="border: 3px solid #d3d3d3; margin-left: 80px; width: 900px; heigh: 100px; text-align: left; padding-left: 15px; background-color:white; border-radius: 15px;"><br>
				<span name ="content" > <?=$content?>&nbsp;
				</span>&emsp;
				<br><br><br><br>
				<br><br><br>
			</li>
			<li>
				<br>&nbsp;&nbsp;
				<span class="col6">&nbsp;&nbsp;<b>파일 | </b></span>
				<span name ="file"><b>
					<?php
					if($file_name) {
						$real_name = $file_copied;
						$file_path = "./data/".$real_name;
						$file_size = filesize($file_path);

						echo " $file_name ($file_size Byte) &nbsp;&nbsp;&nbsp;&nbsp;
						<a href='download.php?num=$num&real_name=$real_name&file_name=$file_name&file_type=$file_type'>[저장]</a><br><br>";
					}

				?>&nbsp;</b>
			</span>
		</li>
		<br><br><br>
	</li>


</ul>
<ul class="buttons">
	<li><button onclick="location.href='inquiry_board_list.php?num=<?=$num?>page=<?=$page?>"
		>목록
	</button>
</li>
<li><button onclick="location.href='inquiry_board_modify_form.php?num=<?=$num?>&page=<?=$page?>'"
	>수정
</button>
</li>
<li><button onclick="location.href='inquiry_board_delete.php?num=<?=$num?>&page=<?=$page?>'"
	>삭제
</button>
</li>
<li><button onclick="location.href='inquiry_board_form.php'"
	>글쓰기
</button>
</li>
</ul>
<!-- board_box -->


<!--- 댓글 불러오기 -->
<div class="reply_view">
	<h3>댓글목록</h3>
	<?php
	$sql3 = "select * from reply where con_num='".$num."' order by idx desc";
	$result3 = mysqli_query($con, $sql3);
	while($reply = $result3->fetch_array()){ 
		?>
		<div class="dap_lo">
			<div><b><?php echo $reply['name'];?></b></div>
			<div class="dap_to comt_edit"><?php echo nl2br("$reply[content]"); ?></div>
			<div class="rep_me dap_to"><?php echo $reply['date']; ?></div>
			<div class="rep_me rep_menu">
				<script type="text/javascript">
					$(document).ready(function(){
						$(".dat_edit_bt").click(function(){
							/* dat_edit_bt클래스 클릭시 동작(댓글 수정) */
							var obj = $(this).closest(".dap_lo").find(".dat_edit");
							obj.dialog({
								modal:true,
								width:650,
								height:200,
								title:"댓글 수정"});
						});

						$(".dat_delete_bt").click(function(){
							/* dat_delete_bt클래스 클릭시 동작(댓글 삭제) */
							var obj = $(this).closest(".dap_lo").find(".dat_delete");
							obj.dialog({
								modal:true,
								width:400,
								title:"댓글 삭제확인"});
						});

					});
				</script>
				<a id="dat_edit_bt" href="#">수정</a>
				<a id="dat_delete_bt" href="#">삭제</a>

			</div>
			<!-- 댓글 수정 폼 dialog -->
			<div class="dat_edit">
				<form method="post" action="reply_modify_ok.php">
					<input type="hidden" name="rno" value="<?php echo $reply['idx']; ?>" />
					<input type="hidden" name="b_no" value="<?php echo $num; ?>">
					<input type="hidden" name="page" value="<?php echo $page; ?>">
					<!-- 	<input type="password" name="pw" class="dap_sm" placeholder="비밀번호" /> -->
					<textarea name="content" class="dap_edit_t"><?php echo $reply['content']; ?></textarea>
					<input type="submit" value="수정하기" class="re_mo_bt">
				</form>
			</div>
			<!-- 댓글 삭제 비밀번호 확인 -->
			<div class='dat_delete'>
				<form action="reply_delete.php" method="post">
					<input type="hidden" name="rno" value="<?php echo $reply['idx']; ?>" />
					<input type="hidden" name="b_no" value="<?php echo $num; ?>">
					<input type="hidden" name="page" value="<?php echo $page; ?>">
					<!-- <p>비밀번호<input type="password" name="pw" /> -->
						<input type="submit" value="확인"></p>
					</form>
				</div>
			</div>
		<?php } ?>

		<!--- 댓글 입력 폼 -->
		<div class="dap_ins">
			<form action="reply_ok.php?num=<?php echo $num; ?>" method="post">
				<!-- 	<input type="text" name="dat_user" id="dat_user" class="dat_user" size="15" placeholder="아이디"> -->
				<!-- 	<input type="password" name="dat_pw" id="dat_pw" class="dat_pw" size="15" placeholder="비밀번호"> -->
				<div style="margin-top:10px; ">
					<textarea name="content" class="reply_content" id="re_content" ></textarea>
					<button id="rep_bt" class="re_bt">댓글</button>
				</div>
			</form>
		</div>
	</div><!--- 댓글 불러오기 끝 -->


	<div id="foot_box"></div>
</div>
</center>
</section> 
<footer>
	<?php include "footer.php";?>
</footer>
</body>
</html>
