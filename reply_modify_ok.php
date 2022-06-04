<?php
$con = mysqli_connect("localhost", "user1", "12345", "userdata");
$rno  = $_GET["rno"];
$page  = $_GET["page"];
$bno = $_GET['b_no']; //게시글 번호

$insert_query ="select * from reply where idx='".$rno."'";
// $sql1 = mysqli_query($con, $insert_query);
//reply테이블에서 idx가 rno변수에 저장된 값을 찾음
$reply = $sql1->fetch_array();

$sql2 ="select * from board where num='".$bno."'";
// $result2 = mysqli_query($con, $insert_query);
//board테이블에서 idx가 bno변수에 저장된 값을 찾음
$board = $sql2->fetch_array();

$sql3 ="update reply set content='".$_POST['content']."' where idx = '".$rno."'";
  mysqli_query($con, $sql3);
// $result3 = mysqli_query($con, $sql3);//reply테이블의 idx가 rno변수에 저장된 값의 content를 선택해서 값 저장
  mysqli_close($con);     
echo "<script>alert('수정되었습니다.'); 
 location.href='board_view.php?num=$bno&page=$page';</script>";
?> 
<!-- <script type="text/javascript">alert('수정되었습니다.'); location.replace("board_view.php?num=<?=$bno?>&page=<?=$page?>");</script> -->