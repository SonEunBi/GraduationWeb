<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
    </head>
 
    <?php
        if(isset($_GET["num"]) && isset($_GET["prnt"])) {
            $postNum = $_GET["num"];
            $parent = $_GET["prnt"];
        } else {
    ?>    
            <script>
                alert("오류");
                history.back();
            </script>
    <?php
        }
 
        if(preg_match("/[^0-9]+/", $_GET["postNum"]) || preg_match("/[^0-9]+/", $_GET["prnt"])) {
    ?>    
            <script>
                alert("No hack \'~\'");
                history.back();
            </script>
    <?php
        }
    ?>
    <body>
        <div id = main align="center">    
            <h2> 댓글 작성 </h2>
        </div>
            <form method="post" action="./comment.php?postNum=<?=\$postNum?>&prnt=<?=\$parent?>">
                <table align="center">        
                    <tr align="center">            
                        <td> 
                            <textarea type="text" style="resize:none;" cols="105" rows="15" name="cont"></textarea>
                        <td>
                    </tr>
 
                    <tr align="center">
                        <td> 
                            <input type="submit" value="작성"/>
                        </td>
                    <tr>
                <table>        
            </form>
        </div>
    </body>    
</html>
