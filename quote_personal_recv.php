<?php
    set_time_limit(0);
    error_reporting( E_ALL );
    ini_set( "display_errors", 1 );


 
    $files= $_FILES['input_file'];

    // 전송된 파일 개수

    $fileNum= count($files['name']);
    $damagedNum = 0;

    
    //요청 서버 URL 셋팅 
    $url = "http://172.19.88.25:8081/assessment"; 
    //추가할 헤더값이 있을시 추가하면 됨 
    $headers = array( "content-type: application/json", "accept-encoding: gzip" ); 
    //POST방식으로 보낼 JSON데이터 생성 

    $arr_post = array(); 
    $filename = array();

    $file_path = realpath(__FILE__); //php파일의 절대 서버 경로

    for($i=0;$i<$fileNum;$i++){

        $srcName= $files['name'][$i]; //원본파일명
        $tmpName= $files['tmp_name'][$i]; //임시저장소 경로

        $dst_path = str_replace(basename(__FILE__), '', $file_path). "data/uploads/"; //php파일 이름을 뺀 절대 서버 경로

        $date = date('Ymdhis');

        $filename[$i] = 'data/uploads/'. $date. $srcName;

        $dstName= $dst_path . $date . $srcName;
        $arr_post[$i] = $dstName;

        move_uploaded_file($tmpName, $dstName);
 
    }

    
    //배열을 JSON데이터로 생성 
    $post_data = json_encode($arr_post); 

    //CURL함수 사용 
    $ch=curl_init(); 
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
    curl_setopt($ch, CURLOPT_URL, $url); 

    //header값 셋팅(없을시 삭제해도 무방함) 
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers); 

    //POST방식 
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST"); 
    curl_setopt($ch, CURLOPT_POST, true); 

    //POST방식으로 넘길 데이터(JSON데이터)
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data); 
    curl_setopt($ch, CURLOPT_TIMEOUT, 300); 
    $response = curl_exec($ch); 
    if(curl_error($ch))
        { $curl_data = null; } 
    else { $curl_data = $response; } 
    curl_close($ch);

    //받은 JSON데이터를 배열로 만듬 
    $json_data = json_decode($curl_data,true);

    $result_data = array();
?>

<!DOCTYPE html>
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
        <h3>검사 결과</h3>
        <style>
        .footerG{
            bottom: 0;
            width:100%;
            margin-top: 560px;
        }
        </style>
    </div>
    </section> <br><br>
    <center>
        <div id="honeyTip">
            <h4> 오늘의 꿀팁! </h4>
            <br>
            <span></span>
        </div>
        <div class="resultTable" style="width:80%; height:1000px; overflow:auto">
        <table style="width:80%;" border="1">
            <tr>
                <th style="text-align: center;">파손 결과 보기</th>
            </tr>
            <?php
                for($i = 0; $i < count($json_data); $i++){
                    $img_path = $filename[$i];
                    ?>
                    <tr onclick="image_popup_All(this);">
                        <td><img id="result" src=<?=$img_path?>>
                        <label> 파일명 : <?php echo $files['name'][$i]; ?></label>
                        <br>
                        <label> 파손 여부 :
                            <?php if($json_data[$i] == '1'){
                                echo "Damaged";
                                $damagedSrc[$i] = $filename[$i];
                                $damagedName[$i] = $files['name'][$i];
                                $damagedNum++;
                        } else{echo "Clear";}?> </label>
                    </tr>
                    <?php
                }
            ?>
        </table>
        </div>
    </center>
    <script>
        function image_popup_All(tr) {
                var imgObj = new Image();
                var index = tr.rowIndex - 1;
                var imglist = '<?php echo json_encode($filename); ?>';
                var imgSrc = JSON.parse(imglist);
                imgObj.src = imgSrc[index];
                imageWin = window.open("", "profile_popup", "width=" + imgObj.width + "px, height=" + imgObj.height + "px");
                imageWin.document.write("<html><body style='margin:0'>");
                imageWin.document.write("<a href=javascript:window.close()><img src='" + imgObj.src + "' border=0></a>");
                imageWin.document.write("</body><html>");
                imageWin.document.title = imgObj.src;
            }
    </script>
    <script src="./js/honeyTips.js"></script>
    <footer class="footerG">
    <?php include "footer.php";?>
    </footer>
</body>
</html>