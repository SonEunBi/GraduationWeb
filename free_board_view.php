
<!DOCTYPE html>
<html>
<head> 
	<meta charset="utf-8">
	<title>비교 견적 게시판</title>
	<link rel="stylesheet" type="text/css" href="./css/common.css">
	<link rel="stylesheet" type="text/css" href="./css/board.css">
	<link rel="stylesheet" type="text/css" href="./css/reply.css">
</head>
</script>
<body> 
	<header>
		<?php include "header.php";?>
	</header>  
	<section>
	</div><br><br><br>
	<div id="board_box">
		<h3 class="title">
			게시판 > 내용보기
		</h3>
		<?php
		$num  = $_GET["num"];
		$page  = $_GET["page"];

		$con = mysqli_connect("localhost", "user1", "12345", "userdata");
		$sql = "select * from freeboard where num=$num";
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

		$content = str_replace(" ", "&nbsp;", $content);
		$content = str_replace("\n", "<br>", $content);

		$new_hit = $hit + 1;
		$sql = "update freeboard set hit=$new_hit where num=$num";   
		mysqli_query($con, $sql);
		?>		
		<ul id="view_content">
			<li>
				<span class="col1"><b>제목 :</b> <?=$subject?></span>
				<span class="col2"><?=$name?> | <?=$regist_day?></span>
				<li>
					<b>정보</b><br><br>
					<table style="border: 2px solid #444; border-radius: 40px/ 40px;" id="wrapper">
						<tr height=50 style="border:1px solid #444; text-align: center;"><th width= 100>부품</th>
							<td width =100> &nbsp;
								<span name ="partname"><b> <?=$partname?>&nbsp;</b></label>&emsp;
								</td></span></td></tr>

								<tr height=50 style="border:1px solid #444; text-align: center;"><th width= 100>가격</th>
									<td width =100> &nbsp;
										<span name ="price"><b> <?=$price?>&nbsp;원</b></label>&emsp;
										</td></span></td></tr>


										<tr height=50 style="border:1px solid #444;text-align: center;"><th width= 100>지역</th>
											<td width =100> &nbsp;
												<span name ="location"><b> <?=$location?>&nbsp;원</b></label>&emsp;
												</td></span></tr>

												
												</tr>
											</table>
										
										</li>

										<li>
											<?php
											if($file_name) {
												$real_name = $file_copied;
												$file_path = "./data/".$real_name;
												$file_size = filesize($file_path);

												echo "▷ 첨부파일 : $file_name ($file_size Byte) &nbsp;&nbsp;&nbsp;&nbsp;
												<a href='download.php?num=$num&real_name=$real_name&file_name=$file_name&file_type=$file_type'>[저장]</a><br><br>";
											}

											?>
											<?=$content?>
										</li>		
									</ul>
									<ul class="buttons">
										<li><button onclick="location.href='free_board_list.php?page=<?=$page?>'">목록</button></li>
										<li><button onclick="location.href='free_board_modify_form.php?num=<?=$num?>&page=<?=$page?>'">수정</button></li>
										<li><button onclick="location.href='free_board_delete.php?num=<?=$num?>&page=<?=$page?>'">삭제</button></li>
										<li><button onclick="location.href='free_board_form.php'">글쓰기</button></li>
									</ul>
									<!-- free_board_box -->


									<!--- 댓글 불러오기 -->
									<div class="reply_view">
										<h3>댓글목록</h3>
										<?php
										$insert_query ="select * from reply where con_num='".$num."' order by idx desc";
										$sql3 = mysqli_query($con, $insert_query);
										while($reply = $sql3->fetch_array()){ 
											?>
											<div class="dap_lo">
												<div><b><?php echo $reply['name'];?></b></div>
												<div class="dap_to comt_edit"><?php echo nl2br("$reply[content]"); ?></div>
												<div class="rep_me dap_to"><?php echo $reply['date']; ?></div>
												<div class="rep_me rep_menu">
													<a class="dat_edit_bt" href="#" method="post">수정</a>
													<a class="dat_delete_bt" href="#">삭제</a>
												</div>

												<!-- 댓글 수정 폼 dialog -->
												<div class="dat_edit">
													<form method="post" action="reply_modify_ok.php">
														<input type="hidden" name="rno" value="<?php echo $reply['idx']; ?>" /><input type="hidden" name="b_no" value="<?php echo $num; ?>">
														<input type="password" name="pw" class="dap_sm" placeholder="비밀번호" />
														<textarea name="content" class="dap_edit_t"><?php echo $reply['content']; ?></textarea>
														<input type="submit" value="수정하기" class="re_mo_bt">
													</form>
												</div>
												<!-- 댓글 삭제 비밀번호 확인 -->
												<div class='dat_delete'>
													<form action="reply_delete.php" method="post">
														<input type="hidden" name="rno" value="<?php echo $reply['idx']; ?>" /><input type="hidden" name="b_no" value="<?php echo $num; ?>">
														<p>비밀번호<input type="password" name="pw" /> <input type="submit" value="확인"></p>
													</form>
												</div>
											</div>
										<?php } ?>

										<!--- 댓글 입력 폼 -->
										<div class="dap_ins">
											<form action="reply_ok.php?idx=<?php echo $num; ?>" method="post">
												<input type="text" name="dat_user" id="dat_user" class="dat_user" size="15" placeholder="아이디">
												<input type="password" name="dat_pw" id="dat_pw" class="dat_pw" size="15" placeholder="비밀번호">
												<div style="margin-top:10px; ">
													<textarea name="content" class="reply_content" id="re_content" ></textarea>
													<button id="rep_bt" class="re_bt">댓글</button>

												</div>
											</form>
										</div>
									</div>
									<!--- 댓글 불러오기 끝 -->

									<div id="foot_box"></div>
								</div>
							</center>
						</section> 
						<footer>
							<?php include "footer.php";?>
						</footer>
					</body>
					</html>
