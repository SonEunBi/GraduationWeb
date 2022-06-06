<!doctype html>
    <html>
    <head>
        <meta charset="utf-8">
        <title>부셔진 차</title>
        <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/font-awesome/4.6.2/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="./css/common.css">
        <link rel="stylesheet" type="text/css" href="./css/style.css">
        <?php
        session_start();
        if (isset($_SESSION["userid"])) $userid = $_SESSION["userid"];
        else $userid = "";
        if (isset($_SESSION["username"])) $username = $_SESSION["username"];
        else $username = "";
        ?>		
<script src="js/jquery-3.6.0.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    </head>

    <body>
        <div class ="menu-top-home-fixed">
            <div class="container">
                <div class="col-xs-3">
                </div>
                <div class = "col-xs-9 align-center">

                   <b> <ul class="menu-links"> 
                        <li><a class="logo" href="index.php"><img src="img/logo1.png"></a></li>
                        <li><a href="board_list.php">견적 공유</a></li>
                        <li><a href="inquiry_board_list.php">견적 문의</a></li>
                        <li><a href="free_board_list.php">자유게시판</a></li>        
                        <li><a href="search_db.php">견적 통계</a></li>
                        <li><a href="quote_personal.php">파손 검출 체험</a></li>
                        <li><a href="quote_group.php">파손 검출 시스템</a></li></b>&nbsp;&nbsp;
                        <?php
                        if(!$userid) {
                            ?>                
                            <li><a data-toggle="modal" role="button" class="btn-danger" href="member_form.php">Sign up</a> </li>
                            <li> | </li>
                            <li><a class="btn-link" role="button" data-toggle="modal"  href="login_form.php">Login</a></li>
                            <?php
                        } else {
                            $logged = $username."님";
                            ?>
                            <li><?=$logged?> </li>
                            <li> | </li>
                            <li><a href="logout.php">로그아웃</a> </li>
                            <li> | </li>
                            <li><a href="member_modify_form.php">정보 수정</a></li>
                            <?php
                        }   ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <script src="http://code.jquery.com/jquery-1.12.4.min.js"></script> 


</style>
</head>

</nav>
<script>
    $('nav li').hover(
      function() {
          $('ul', this).stop().slideDown(200);
      },
      function() {
        $('ul', this).stop().slideUp(200);
    }
    );
</script>
</body>
</html>