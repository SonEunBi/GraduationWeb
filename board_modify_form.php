<!DOCTYPE html>
<html>
<head> 
<meta charset="utf-8">
<title>EB 도서관</title>
<link rel="stylesheet" type="text/css" href="./css/common.css">
<link rel="stylesheet" type="text/css" href="./css/board.css">
<script>
  function check_input() {
      if (!document.board_form.subject.value)
      {
          alert("제목을 입력하세요!");
          document.board_form.subject.focus();
          return;
      }
      if (!document.board_form.content.value)
      {
          alert("내용을 입력하세요!");    
          document.board_form.content.focus();
          return;
      }
      document.board_form.submit();
   }
</script>
</head>
<body> 
<header>
    <?php include "header.php";?>
</header> 
<section> 
    </div>
   	<div id="board_box">
	    <h3 id="board_title">
	    		게시판 > 글쓰기
		</h3>
<?php
	$num  = $_GET["num"];
	$page = $_GET["page"];
	
	$con = mysqli_connect("localhost", "user1", "12345", "userdata");
	$sql = "select * from board where num=$num";
	$result = mysqli_query($con, $sql);
	$row = mysqli_fetch_array($result);
	$name       = $row["name"];
	$subject    = $row["subject"];
	$content    = $row["content"];		
	$file_name  = $row["file_name"];
?>
	    <form  name="board_form" method="post" action="board_modify.php?num=<?=$num?>&page=<?=$page?>" enctype="multipart/form-data">
	    	 <ul id="board_form">
				<li>
					<span class="col1">이름 : </span>
					<span class="col2"><?=$name?></span>
				</li>		
	    		<li>
	    			<span class="col1">제목 : </span>
	    			<span class="col2"><input name="subject" type="text" value="<?=$subject?>"></span>
	    		</li>	    	
	    		 <li>
        <span class="col1">부품 : </span>

        <span class="col2">
            <select name="partname" >

                <option>-선택-</option>

                <option value='all'>전체</option>

                <option value='bumper'>범퍼</option>

                <option value='bonnet'>보넷</option>

                <option value='trunk'>트렁크</option>

                <option value='loop'>루프</option>

                <option value='door'>도어</option>

                <option value='staff'>스테프</option>

                <option value='fender'>휀더</option>

                <option value='etc'>기타</option>

            </select>
        </span>
    </li>   
    <li>
        <span class="col1">차종 : </span>
        <span class="col2">
            <select name="cartype" >

               <option>-선택-</option>

                    <option value='Sedan'>세단</option>

                    <option value='Coupe'>쿠페</option>

                    <option value='Wagon'>왜건</option>

                    <option value='SUV'>SUV</option>

                    <option value='Convertible'>컨버터블</option>

                    <option value='Hatchback'>해치백</option>

                    <option value='Limousine'>리무진</option>

                    <option value='Van'>밴</option>

                    <option value='Pickuptrunk'>픽업트럭</option>

            </select>
        </span>
    </li>   

    <li>
        <span class="col1">장소: </span>
        <span class="col2">
            <form name="location">
                <!-- onChange="cat1_change(this.value,h_area2)" -->
                <select name="location"  >

                    <option>-선택-</option>

                    <option value='서울'>서울</option>

                    <option value='부산'>부산</option>

                    <option value='대구'>대구</option>

                    <option value='인천'>인천</option>

                    <option value='광주'>광주</option>

                    <option value='대전'>대전</option>

                    <option value='울산'>울산</option>

                    <option value='강원'>강원</option>

                    <option value='경기'>경기</option>

                    <option value='경기'>경남</option>

                    <option value='경북'>경북</option>

                    <option value='전남'>전남</option>

                    <option value='전북'>전북</option>

                    <option value='제주'>제주</option>

                    <option value='충남'>충남</option>

                    <option value='충북'>충북</option>

                </select>


            </span>
        </li>

	    		<li id="text_area">	
	    			<span class="col1">내용 : </span>
	    			<span class="col2">
	    				<textarea name="content"><?=$content?></textarea>
	    			</span>
	    		</li>
	    		<li>
			        <span class="col1"> 첨부 파일 : </span>
			        <span class="col2"><?=$file_name?></span>
			    </li>
	    	    </ul>
	    	<ul class="buttons">
				<li><button type="button" onclick="check_input()">수정하기</button></li>
				<li><button type="button" onclick="location.href='board_list.php'">목록</button></li>
			</ul>
	    </form>
	</div> <!-- board_box -->
</section> 
<footer>
    <?php include "footer.php";?>
</footer>
</body>
</html>
