<?php

$conn = mysqli_connect("localhost", "user1", "12345", "userdata");
$content = $_POST["content"]; 

if($content === "") {
    ?>
    <script>
        alert("내용을 입력하세요.");
        history.back();
    </script>
    <?php
} else {
    $content = htmlspecialchars($content);
}

if(isset($_GET["num"]) && isset($_GET["prnt"])) {    
    if(preg_match( "/[^0-9]+/", $_GET["idx"])) {
        ?> 
        <script>
            alert("No hack \'~\'");
            history.back();
        </script>
        <?php
    } else {  
        $postNum = $_GET["num"];
        $parent = $_GET["prnt"];
    }
} else {
    ?>
    <script>
        alert("오류");
        history.back();
    </script>
    <?php
}    

$query = "SELECT name FROM users WHERE id=\"$id\"";
$result = mysqli_query($conn, $query);
$arr = mysqli_fetch_array($result);
$id = $arr["id"];

$query = "INSERT INTO comments(postSeq, id, content, commented, parent) VALUES (num,\"id\", \"content\",now(),parent)";
$result = mysqli_query($conn, $query);

if($result) {
    ?>        
    <script>
        alert("댓글 작성 완료");
        document.location.href="./board_view.php?num=<?=$num?>";
    </script>
    <?php
} else {
    ?>
    <script>
        alert("댓글 작성 실패");
        document.location.href="./view.php?num=<?=$num?>";
    </script>
    <?php
}
?>
