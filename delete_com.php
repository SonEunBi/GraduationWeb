<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
    </head>
 
    <body>
        <?php
            include "./connectDB.php";
            
            $conn = connectDB();    
            $num = $_GET["num"];
            $commentNum = $_GET["commentNum"];
 
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
            
            $query = "DELETE FROM comments WHERE seq=$commentNum";
            $childResult = mysqli_query($conn, $query);    
            
            $query = "DELETE FROM comments WHERE parent=$commentNum";
            $parentResult = mysqli_query($conn, $query);
 
            if($childResult && $parentResult) {
        ?>
                <script>
                    alert("삭제되었습니다.");
                </script>
        <?php
            } else {    
        ?>
                <script>
                    alert("삭제가 실패했습니다.");
                </script>
        <?php
            }
        ?>
 
        <script>
            document.location.href="./board_view.php?num=<?=$num?>";
        </script>
    </body>
</html>
