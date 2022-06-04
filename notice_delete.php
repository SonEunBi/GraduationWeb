<?php
    if (isset($_SESSION["userlevel"])) $userlevel = $_SESSION["userlevel"];
    else $userlevel = "";
  if ( $userlevel != 1 )
    {
        echo("
                    <script>
                    alert('관리자가 아닙니다! 공지 사항 관리는 관리자만 가능합니다!');
                    history.go(-1)
                    </script>
        ");
                exit;
    }


    $num   = $_GET["num"];
    $page   = $_GET["page"];

    $con = mysqli_connect("localhost", "user1", "12345", "userdata");
    $sql = "select * from notice where num = $num";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_array($result);

    $copied_name = $row["file_copied"];

	if ($copied_name)
	{
		$file_path = "./data/".$copied_name;
		unlink($file_path);
    }

    $sql = "delete from notice where num = $num";
    mysqli_query($con, $sql);
    mysqli_close($con);

    echo "
	     <script>
	         location.href = 'notice_list.php?page=$page';
	     </script>
	   ";
?>

