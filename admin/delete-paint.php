<?php 
    include('../config/constants.php'); 

    if(isset($_GET['id']) AND isset($_GET['image_name'])){
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];

        if($image_name != ''){
            $path = '../images/paints/'.$image_name;

            $remove = unlink($path);

            if($remove==false){
                $_SESSION['remove'] = "<div class='Failed-to-do'>Failed to Remove Paint Image.</div>";
                header('location:'.SITEURL.'admin/view-paint.php');
                die();
            }
        }

        $sql = "DELETE FROM tbl_paint WHERE id=$id";

        $res = mysqli_query($conn,$sql);

        if($res==true){
            $_SESSION['delete'] = "<div class='success-text'>Successfully Deleted Paint.</div>";
            header('location:'.SITEURL.'admin/view-paint.php');
        } else {
            $_SESSION['delete'] = "<div class='Failed-to-do'>Failed to Delete Paint.</div>";
            header('location:'.SITEURL.'admin/view-paint.php');
        }
    } else {
        header('location:'.SITEURL.'admin/view-paint.php');
    }
?>