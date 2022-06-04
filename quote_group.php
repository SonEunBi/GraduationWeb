<!DOCTYPE html>
<?php
set_time_limit(0);
    error_reporting( E_ALL );
    ini_set( "display_errors", 1 );

?>
<html>
<head> 
  <meta charset="utf-8">
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
      <h3>한꺼번에 파손 비교하기</h3>
      <style>

.footerG{
  bottom: 0;
  width:100%;
  margin-top: 560px;
}
</style> 


</div>
<br><br>
<!--
<span class="guide"><br>
간단 검색으로 부품 식별이 어렵거나, 희망하는 차종 정보가 없을 경우 당사 고객센터(1588-8282) 혹은 개인 회원 가입 후 상세 부품검색(WPC)를 이용하여 정확한 정보를 확인하시기 바랍니다. 조회되는 차량 견적 서비스는 일단위 갱신되고 있습니다. <br>
  <br>사진 촬영 시 주의사항<br><br>
▶ 결함 부분을 중앙에 맞추어 초점을 조정해 주십시오.<br>
▶ 물체와의 거리를 최소 20cm 이상 유지해 주십시오.<br>
▶ 밝은 곳에서 촬영을 진행해 주십시오.<br>
▶ 최대한 그림자가 생기지 않도록 사진을 촬영해 주십시오.<br>
▶ 이미지 분석하는 데에 있어서 시간이 소요될 수 있습니다.<br>
▶ 카메라 성능과 채광에 따라 사진 분석에 약간의 오차가 발생할 수 있습니다.<br>

  <br><br>
  견적에 문제가 발생할 경우 고객센터로 전화하시기 바랍니다. 고객센터 1588-8282 (전국)<br></span>
  <br>
  -->
</section> <br><br>
<center>
<script src="js/quote.js" type="text/javascript"></script>
<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
<form name="uploadForm" action="./quote_group_recv.php" id="uploadForm" method="POST" enctype="multipart/form-data">
  <div id="dropZone">
    <img width="130px" height="110px" id="quote_img" src="./img/upload-files.png">
    <div>
    <span id="imgtext">Drop images to upload</span>
    </div>
  </div>
  <input type="file" id="input_file" name="input_file[]" multiple style="left: 100px;" hidden>
  <label class="btn_quote" for="submit_file">단체 견적 확인하기</label>
  <input type="button" id="submit_file" onclick="uploadFile(); return false;" style = "display:none"/>
</form>
<table class="table" width="800px" border="1px">
        <tbody id="fileTableTbody">
        </tbody>
</table>
</center>

<footer class="footerG">
  <?php include "footer.php";?>
</footer>
</body>
</html>

