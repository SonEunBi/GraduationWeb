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
    $damagedName = array();
    $damagedSrc = array();

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

    for($i=0; $i<$fileNum;$i++){
        if($json_data[$i]=="1"){
            $damagedSrc[$damagedNum] = $arr_post[$i];
            $damagedName[$damagedNum] = $files['name'][$i];
            $damagedSrc[$damagedNum] = $filename[$i];
            $damagedNum++;
        }
        $result_data[$files['name'][$i]] = $json_data[$i];
    }
    $result_jsondata = json_encode($result_data);
    $date = date('Ymdhis');
    $dst_path = str_replace(basename(__FILE__), '', $file_path). "data/json/" . $date. ".json";
    file_put_contents($dst_path, $result_jsondata);
    $dst_path = $date.".json";
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
        <div id="resultBox">
            <label>총 이미지 수 : <?php echo $fileNum?></label>
            <br>
            <label>파손 이미지 수 : <?php echo $damagedNum?></label>
        </div>
        <div id="resultImg" style="padding-bottom: 70px;">
            <img src="./img/result.png">
        </div>
        <div class="resultTable" id="allRet" style="width:80%; height:1000px; overflow:auto">
        <table style="width:80%;" border="1">
            <tr>
                <th>이미지</th>
                <th>파일명</th>
                <th>파손여부</th>
            </tr>
            <?php
                for($i = 0; $i < count($json_data); $i++){
                    $img_path = $filename[$i];
                    ?>
                    <tr onclick="image_popup_All(this);">
                        <td><img style="width:50px; height:40px;" id="result" src=<?=$img_path?>></td>
                        <td><label> <?php echo $files['name'][$i]; ?></label></td>
                        <td><label> 
                            <?php if($json_data[$i] == '1'){
                                echo "Damaged";
                        } else{echo "Clear";}?> </label></td>
                    </tr>
                    <?php
                }
            ?>
        </table>
        </div>
        <div id="board_box" hidden>
            <h1 id="board_title"></h1>
            <br>
            <h3>파손 이미지만 보기</h3>
        </div>
        <div class="resultTable" id="damagedRet" style="width:80%; height:1000px; overflow:auto">
        <table style="width:auto;" border="1">
            <tr>
                <th>이미지</th>
                <th>파일명</th>
                <th>파손여부</th>
            </tr>
            <?php
                for($i = 0; $i < count($damagedSrc); $i++){
                    ?>
                    <tr onclick="image_popup_Damaged(this);">
                        <td><img style="width:300px; height:280px;" id="result" src=<?=$damagedSrc[$i]?>></td>
                        <td><label> <?php echo $damagedName[$i];?></label></td>
                        <td><label> Damaged </label></td>
                    </tr>
                    <?php
                }
            ?>
        </table>
        </div>
        <script src="js/quote.js" type="text/javascript"></script>
        <label class="btn_quote" id="allRet" onclick="showResult(); return false;">전체 결과 보기</label>
        <label class="btn_quote" id="damagedRet" onclick="showDamagedResult(); return false;">파손 이미지만 보기</label>
        <label class="btn_quote" id="ret_down">결과파일 다운로드</label>
        <script>
            function download(filename, textInput) {
                var dataStr = "data:text/json;charset=utf-8," + encodeURIComponent(JSON.stringify(filename));
                var element = document.createElement('a');
                element.setAttribute('href', dataStr);
                element.setAttribute('download', textInput);
                document.body.appendChild(element);
                element.click();
                //document.body.removeChild(element);
            }
                document.querySelector("#ret_down")
                  .addEventListener("click", function () {
                        var text = "<?=$dst_path?>";
                        var filename = <?=$result_jsondata?>;
                        download(filename, text);
            }, false);
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
            function image_popup_Damaged(tr) {
                var imgObj = new Image();
                var index = tr.rowIndex - 1;
                var imglist = '<?php echo json_encode($damagedSrc); ?>';
                var imgSrc = JSON.parse(imglist);
                imgObj.src = imgSrc[index];
                imageWin = window.open("", "profile_popup", "width=" + imgObj.width + "px, height=" + imgObj.height + "px");
                imageWin.document.write("<html><body style='margin:0'>");
                imageWin.document.write("<a href=javascript:window.close()><img src='" + imgObj.src + "' border=0></a>");
                imageWin.document.write("</body><html>");
                imageWin.document.title = imgObj.src;
            }
        </script>
    </center>
    <script> initTable(); </script>
    <footer class="footerG">
    <?php include "footer.php";?>
    </footer>
</body>
</html>