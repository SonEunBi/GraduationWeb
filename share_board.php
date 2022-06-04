
<!DOCTYPE html>
<html>
<head> 
  <meta charset="utf-8">
  <title>부셔진 차</title>
  <link rel="stylesheet" type="text/css" href="./css/common.css">
  <link rel="stylesheet" type="text/css" href="./css/board.css">

</head>
<body> 
  <header>
    <?php include "header.php";?>
  </header>  
  <div id="board_box"> 
    <h1 id="board_title"></h1>
    <h3>견적 정보 공유</h3>

  </div>


  <style>
    h3{
      margin-bottom: -20px;
      text-align: center;
    }
    #search_btn{
      cursor: pointer;
      width:500px;
      height: 55px;
      border-radius: 84px;
      font-size: large;
    }
    #search_view{
      transition-duration: 0.4s;
      cursor: pointer;
      float: absolute;
      width:480px;
      border-radius: 32px;
      height: 55px;
      font-size:large;
    }
    .footerSc{
      bottom: 0;
      width:100%;
      margin-top: 390px;
    }
  </style> 
  <!-- 검색창 -->
    
    
    
    
    
    
  <div class="search" style="height: 100px; margin-top: 17px;">
    <br><br> <center>
      <form method="post" action="share_board_list.php" style="float=center;">
       <select name="catgo">
            <option>-선택-</option>
            <option value="all">전체</option>
            <option value="bumper">범퍼</option>
            <option value="bonnet">보넷</option>
            <option value="trunk">트렁크</option>
            <option value="loop">루프</option>
            <option value="door">도어</option>
            <option value="staff">스테프</option>
            <option value="fender">휀더</option>
            <option value="etc">기타</option>

      </select>
      <input type="text" name="search" size="40" required="required" /> <button>검색</button></form>
    
    
    
    
       

    <br><br>
   	<div id="board_box">
	    
	    <ul id="board_list">
				<li>
					<span class="col1">번호</span>
					<span class="col2">제목</span>
					<span class="col3">글쓴이</span>
					<span class="col4">부위</span>
					<span class="col5">등록일</span>
					<span class="col6">조회</span>
				</li>
<?php
	if (isset($_GET["page"]))
		$page = $_GET["page"];
	else
		$page = 1;

	$con = mysqli_connect("localhost", "user1", "12345", "sample");
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
      if ($row["file_name"])
      	$file_image = "<img src='./img/file.gif'>";
      else
      	$file_image = " ";
?>
				<li>
					<span class="col1"><?=$number?></span>
					<span class="col2"><a href="board_view.php?num=<?=$num?>&page=<?=$page?>"><?=$subject?></a></span>
					<span class="col3"><?=$name?></span>
					<span class="col4"><?=$file_image?></span>
					<span class="col5"><?=$regist_day?></span>
					<span class="col6"><?=$hit?></span>
				</li>	
<?php
   	   $number--;
   }
   mysqli_close($con);

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
?>
			</ul> <!-- page -->	    	
			<ul class="buttons">
				<li><button onclick="location.href='share_board_list.php'">목록</button></li>
				<li>
<?php 
    if($userid) {
?>
					<button onclick="location.href='share_board_form.php'">글쓰기</button>
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

      
    
    
    
    
    

        <div>
          <h3 id="board_title"></h3>  
        </div> <!-- board_box -->
        <footer class="footerSc">
          <?php include "footer.php";?>
        </footer>
      </body>
      </html>