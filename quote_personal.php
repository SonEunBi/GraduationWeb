<!DOCTYPE html>
<html>
<head> 
	 <meta http-equiv="Content-Type" content="text/html;charset=utf-8" >
	<title>비교 견적 사이트</title>
	<link rel="stylesheet" type="text/css" href="./css/common.css">
	<link rel="stylesheet" type="text/css" href="./css/board.css">
	<link rel="stylesheet" type="text/css"href="./css/quote.css">
</head>
<body> 
	<header>
		<?php include "header.php";?>
	</header>  
	<section>
		<div id="board_box">
			<h1 id="board_title"></h1>
<br>
			<h3>내 차 파손 비교하기</h3>
			<style>
				.footerG{
					bottom: 0;
					width:100%;
					margin-top: 560px;
				}
			</style>


		</div>
		<br><br><br>
		</section> <br><br>
		<center>
			<div id="resultImg" style="padding-bottom: 70px;">
            	<img src="./img/result.png">
        	</div>
			<form action="quote_personal_recv.php" method="POST" enctype="multipart/form-data">
				<input type="file" id="input_file" name ="input_file[]" style = "display:none"/>
				<label class="btn_quote" for="input_file">파일 업로드</label>
				<input type="submit" id="submit_file" hidden></label>
				<label class="btn_quote" for="submit_file" >파손분석 체험하기</label>
			</form>
		</center>

		<footer class="footerG">
			<?php include "footer.php";?>
		</footer>
	</body>
	</html>
