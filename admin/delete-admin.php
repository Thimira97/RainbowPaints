<?php 
     include('../config/constants.php');

    if(isset($_GET['id']) AND isset($_GET['image_name'])){

        $id = $_GET['id'];
        $image_name = $_GET['image_name'];

        if($image_name != ""){
            $path = "../images/profile/".$image_name;

            $remove = unlink($path);

            if($remove==false){
                $_SESSION['remove'] = "<div class='Failed-to-do'>Failed to Remove Image.</div>";
                header('location:'.SITEURL.'admin/view-admin.php');
                die();
            }
        }

        $sql = "DELETE FROM tbl_admin WHERE id=$id";

        $res = mysqli_query($conn,$sql);

        if($res == true){
            $_SESSION['delete'] = "<small class='successfuly-done'>Admin Deleted Successfully.</small>";
            header('location:'.SITEURL.'admin/view-admin.php');
        } else {
            $_SESSION['delete'] = "<div class='Failed-to-do'>Failed to Delete Admin.</div>";
            header('location:'.SITEURL.'admin/view-admin.php');
        }

    } else {
        header('location:'.SITEURL.'admin/admin-management.php');
   }

?>