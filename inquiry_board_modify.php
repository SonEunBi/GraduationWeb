<?php
    $num = $_GET["num"];
    $page = $_GET["page"];

    $subject = $_POST["subject"];
    $content = $_POST["content"];
          
    $con = mysqli_connect("localhost", "user1", "12345", "sample");
    $sql = "update inquiryboard set subject='$subject', repairtype='$repairtype', partname ='$partname', cartype='$cartype', location='$location', price='$price', content='$content' ";
    $sql .= " where num=$num";
    mysqli_query($con, $sql);

    mysqli_close($con);     

    echo "
	      <script>
	          location.href = 'inquiry_board_list.php?page=$page';
	      </script>
	  ";
?>
