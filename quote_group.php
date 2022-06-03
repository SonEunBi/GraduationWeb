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
</section> <br><br>
<center>
<script src="js/quote.js" type="text/javascript"></script>
<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
<form name="uploadForm" action="./quote_group_recv.php" id="uploadForm" method="POST" enctype="multipart/form-data">
  <div id="dropZone">
      <div id="inDropZone">
        <img width="130px" height="110px" id="quote_img" src="./img/upload-files.png">
        <div>
          <label>Drop images to upload</label>
        </div>
      </div>
  </div>
  <input type="file" id="input_file" name="input_file[]" multiple style="left: 100px;" hidden>
  <input type="button" id="submit_file" onclick="uploadFile(); return false;" style = "display:none"/>
</form>
<label class="btn_quote" for="submit_file">단체 견적 확인하기</label>
<div class="resultTable" style="width:80%; height:500px; overflow:auto">
<table class="table" width="800px" border="1px">
        <tbody id="fileTableTbody">
        </tbody>
</table>
</div>
</center>

<footer class="footerG">
  <?php include "footer.php";?>
</footer>
</body>
<script> initTable(); </script>
</html>

