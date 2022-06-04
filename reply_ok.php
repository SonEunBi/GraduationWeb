<?php
 $conn = mysqli_connect("localhost", "user1", "12345", "userdata");
$bno  = $_GET["num"];
$page  = $_GET["page"];
    // $userpw = password_hash($_POST['dat_pw'], PASSWORD_DEFAULT);
    // $_POST['dat_user'] && $userpw &&

if($bno && $_POST['content']){

 // name,pw,  ".$_POST['dat_user']."','".$userpw."','
 $insert_query ="insert into reply(con_num,content) values('".$bno."','".$_POST['content']."')";
 $sql = mysqli_query($conn, $insert_query);
 echo "<script>alert('작성되었습니다.'); 
 location.href='board_view.php?num=$bno&page=$page';</script>";

}else{
   echo "<script>alert('댓글 작성에 실패했습니다.'); 
   history.back();</script>";
}
mysqli_close($conn);

?>