<!DOCTYPE html>
<html>
<?php
    include "./connectDB.php";
 
   $conn = mysqli_connect("localhost", "user1", "12345", "userdata");
    if(isset($_GET["num"]) && isset($_GET["commentNum"])) {
        if(preg_match("/^[0-9]+/", $_GET["num"]) || preg_match("/^[0-9]+/", $_GET["commentNum"])) {  
?>
            <script>
                alert("No hack \'~\'");
                history.back();
            </script>
<?php
        } else {    
            $num = $_GET["num"];
            $commentNum = $_GET["commentNum"];
        }
    } else {
?>
        <script>
            alert("오류");
            history.back();
        </script>
<?php
    }
?>
    <head>
        <meta charset="UTF-8" />
        <title> Update comment </title>
    </head>
 
    <body>
        <?php
            $query = "SELECT content FROM comments WHERE seq=$commentNum";
            $result = mysqli_query($conn, $query);
            $arr = mysqli_fetch_array($result, MYSQLI_ASSOC);
            $content = $arr["content"];
        ?>    
        
        <div id="update_comment" align="center">    
                <h2> 댓글 수정 </h2>    
        </div>
        <div>
            <form method="POST" action="./update_com.php">
                <table align="center">
                    <tr align="center">
                        <td>
                            <textarea type="text" style="resize:none;" cols="105" rows="15" name="commentCont"><?=$content?></textarea>
                        </td>
                    </tr>
                    <tr align="center">
                        <td>
                            <input type="hidden" name="num" value="<?=$num?>" />
                            <input type="hidden" name="commentNum" value="<?=$commentNum?>" />
                            <input type="submit" value="작성" />
                        </td>
                    </tr>
            </form>
        </div>        
    </body>            
</html>
