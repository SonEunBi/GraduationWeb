<?php
$con = mysqli_connect("localhost", "user1", "12345", "userdata");
$rno = $_POST['rno']; 
$bno  = $_POST["b_no"];
$page   = $_POST["page"];

$sql = "select * from reply where idx='".$rno."'";
//reply테이블에서 idx가 rno변수에 저장된 값을 찾음
$result = mysqli_query($con, $sql);
$reply = $result->fetch_array();

$sql2 = "select * from board where num='".$bno."'";
//board테이블에서 idx가 num변수에 저장된 값을 찾음
$result1 = mysqli_query($con, $sql2);
$board = $result1->fetch_array();

// $pwk = $_POST['pw'];
// $bpw = $reply['pw'];

// if(password_verify($pwk, $bpw)) 
// {
	$sql3 = "delete from reply where idx='".$rno."'";
	$result3 = mysqli_query($con, $sql3);
	?>

	<script type="text/javascript">alert('댓글이 삭제되었습니다.');
	location.replace("board_view.php?num=<?php echo $board["num"]; ?>&page=<?=$page?>");</script>
	<?php 

?>
