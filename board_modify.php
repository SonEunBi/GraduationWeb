<?php
    $num = $_GET["num"];
    $page = $_GET["page"];

    $subject = $_POST["subject"];
    $content = $_POST["content"];
          
   $repairtype = $_POST['repairtype'];
   $partname = $_POST['partname'];
   $cartype = $_POST['cartype'];
   $location = $_POST['location'];
   $price = $_POST['price'];
    $con = mysqli_connect("localhost", "user1", "12345", "userdata");
    $sql = "update board set subject='$subject', repairtype='$repairtype', partname ='$partname', cartype='$cartype', location='$location', price='$price', content='$content' ";



    $sql .= " where num=$num";
    mysqli_query($con, $sql);

    mysqli_close($con);     

    echo "
	      <script>
	          location.href = 'board_list.php?page=$page';
	      </script>
	  ";
?>

   
