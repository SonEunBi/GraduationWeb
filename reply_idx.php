<?php

$con = mysqli_connect("localhost", "user1", "12345", "userdata");
$sql = "select * from board order by num desc limit 0,5";
$result = mysqli_query($con, $sql);

while($board = $result->fetch_array())
{
  //subject변수에 DB에서 가져온 subject을 선택
  $subject=$board["subject"]; 
  if(strlen($subject)>30)
  { 
  //subject이 30을 넘어서면 ...표시
    $subject=str_replace($board["subject"],mb_substr($board["subject"],0,30,"utf-8")."...",$board["subject"]);
  }

  $sql2 = "select * from reply where con_num='".$board["num"]."'";
  $sql3 = mysqli_query($con, $sql2);

  //댓글 수 카운트
  $rep_count = mysqli_num_rows($sql3); //num_rows로 정수형태로 출력
}
?>