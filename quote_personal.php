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
		<span class="guide">
			<br>사진 촬영 시 주의사항<br><br>
			▶ 결함 부분을 중앙에 맞추어 초점을 조정해 주십시오.<br>
			▶ 물체와의 거리를 최소 20cm 이상 유지해 주십시오.<br>
			▶ 밝은 곳에서 촬영을 진행해 주십시오.<br>
			▶ 최대한 그림자가 생기지 않도록 사진을 촬영해 주십시오.<br>
			▶ 이미지 분석하는 데에 있어서 시간이 소요될 수 있습니다.<br>
			▶ 카메라 성능과 채광에 따라 사진 분석에 약간의 오차가 발생할 수 있습니다.<br>
<br>
			간단 검색으로 부품 식별이 어렵거나, 희망하는 차종 정보가 없을 경우 당사 고객센터(1588-8282) 혹은 개인 회원 가입 후 상세 부품검색(WPC)를 이용하여 정확한 정보를 확인하시기 바랍니다. 조회되는 차량 견적 서비스는 일단위 갱신되고 있습니다. <br>
			<br><br>
			견적에 문제가 발생할 경우 고객센터로 전화하시기 바랍니다. 고객센터 1588-8282 (전국)<br></span>
			<br>

		</section> <br><br>
		<center>
			<form action="quote_personal_recv.php" method="POST" enctype="multipart/form-data">
			<label class="btn_quote" for="input-file">개인 견적 체험하기</label>
			<input type="file" id="input-file" name ="quote_submit"style = "display:none"/>
			<input type="submit" /></form>
		</center>

		<footer class="footerG">
			<?php include "footer.php";?>
		</footer>
	</body>
	</html>

