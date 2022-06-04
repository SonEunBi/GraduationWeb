<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
    </head>
 
    <body>
        <?php
            include "./connectDB.php";
            $conn = mysqli_connect("localhost", "user1", "12345", "userdata");
 
            $num = $_GET["num"];
            $commentNum = $_GET["commentNum"];
            $content = $_POST["commentCont"];
            $content = htmlspecialchars($content); 
            $query = "UPDATE comments SET content=\"content\"where seq =commentNum";
            $result = mysqli_query($conn, $query);
            
            if($result) { 
        ?>
                <script>
                    alert("댓글이 수정되었습니다.");
                    document.location.href="./board_view.php?num=<?=$num?>";
                </script>
        <?php
            } else {
                    
        ?>    
            <script>
                alert("댓글 수정이 실패했습니다.");
                document.location.href="./board_view.php?num=<?=$num?>";
            </script>
        <?php
            }
        ?>
    </body>
</html>