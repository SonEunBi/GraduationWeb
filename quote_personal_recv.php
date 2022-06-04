<!DOCTYPE html>
<html>
        <head>
                <meta http-equiv="Content-Type" content="text/html;charset=utf-8" >
        </head>
        <body>
                <?php
                $uploaddir = '/data/';
                $uploadfile = $uploaddir . basename($_FILES['image']['name']);
                move_uploaded_file($_FILES['image']['tmp_name'], $uploadfile);
                ?>
                <img src="<?=$_FILES['image']['name']?>" />
        </body>
</html>