<!DOCTYPE html>
<html>
<head> 
    <meta charset="utf-8">
    <title>부셔진 차</title>
    <link rel="stylesheet" type="text/css" href="./css/common.css">
    <link rel="stylesheet" type="text/css" href="./css/board.css">
    <script type="text/javascript" src="/js/share_board.js"></script>

<script type="text/javascript">
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
        <br><br><br>
    </header>  
        <br>
    <section>

    </div>
    <div id="board_box">
       <h3 id="board_title" style="font-size: 25px; text-align:center;" >
         견적 공유  >  글 쓰기
     </h3>


     <form  name="board_form" method="post" action="board_insert.php" enctype="multipart/form-data">
       <ul id="board_form">
        <li>
           <span class="col1" style="font-size : 17px">이름 : </span>
           <span class="col2"style="font-size : 15px"><?=$username?></span>
       </li>      
       <li>
        <span class="col1"style="font-size : 17px">제목 : </span>
        <span class="col2"style="font-size : 15px"><input name="subject" type="text"></span>
    </li>   
    <li>
        <span class="col1"style="font-size : 17px">부품 : </span>

        <span class="col2"style="font-size : 15px">
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
        <span class="col1"style="font-size : 17px">차종 : </span>
        <span class="col2"style="font-size : 15px">
            <select name="cartype" >

                <option>-선택-</option>

                <option value='sedan'>세단</option>

                <option value='coupe'>쿠페</option>

                <option value='wagon'>왜건</option>

                <option value='suv'>SUV</option>

                <option value='convertible'>컨버터블</option>

                <option value='hatchback'>해치백</option>

                <option value='limousine'>리무진</option>

                <option value='van'>밴</option>

                <option value='pickuptrunk'>픽업트럭</option>

            </select>
        </span>
    </li>   

    <li>
        <span class="col1"style="font-size : 17px">장소 : </span>
        <span class="col2"style="font-size : 15px">
            <form name="location">
<!-- onChange="cat1_change(this.value,h_area2)" -->
          
                 <select name="location"  >

                    <option>-선택-</option>

                    <option value='1'>서울</option>

                    <option value='2'>부산</option>

                    <option value='3'>대구</option>

                    <option value='4'>인천</option>

                    <option value='5'>광주</option>

                    <option value='6'>대전</option>

                    <option value='7'>울산</option>

                    <option value='8'>강원</option>

                    <option value='9'>경기</option>

                    <option value='10'>경남</option>

                    <option value='11'>경북</option>

                    <option value='12'>전남</option>

                    <option value='13'>전북</option>

                    <option value='14'>제주</option>

                    <option value='15'>충남</option>

                    <option value='16'>충북</option>

                </select>

              
            </span>
        </li>

        <li>
            <span class="col1"style="font-size : 17px">가격 : </span>
            <span class="col2"style="font-size : 15px"><input name="price" type="text"></span>
        </li>
        <li>
            <span class="col1"style="font-size : 17px">부품번호 : </span>
            <span class="col2"style="font-size : 15px"><input name="partnum" type="text"></span>
        </li>
        <li id="text_area">   
            <span class="col1"style="font-size : 17px">내용 : </span>
            <span class="col2"style="font-size : 15px">
               <textarea name="content"></textarea>
           </span>
       </li>
       <li>
         <span class="col1"style="font-size : 17px"> 첨부 파일 :</span>
         <span class="col2"style="font-size : 15px"><input type="file" name="upfile"
                                
                                   ></span></li>
     </ul>
     <ul class="buttons">
        <li><button type="button" onclick="check_input()"
                      style=" width: 72px;
                       font-size:15px;
                       font-family: 'Nanum Gothic';
                       color: #d4d5d9;
                       line-height: 25px;
                       text-align: center;
                       background: #333f50;
                       border: solid 1px#333f50;
                       border-radius: 12px;">완료</button></li>
        <li><button type="button" onclick="location.href='board_list.php'"
                      style=" width: 72px;
                       font-size:15px;
                       font-family: 'Nanum Gothic';
                       color: #d4d5d9;
                       line-height: 25px;
                       text-align: center;
                       background: #333f50;
                       border: solid 1px#333f50;
                       border-radius: 12px;">목록</button></li>
    </ul>
</form>
</div> <!-- board_box -->
</section> 
<footer>
    <?php include "footer.php";?>
</footer>
</body>
</html>