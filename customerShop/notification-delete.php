<?php 
    include('../config/constants.php'); 

    if(isset($_GET['id'])){
        $id = $_GET['id'];

        $sql = "DELETE FROM tbl_no WHERE id=$id";

        $res = mysqli_query($conn,$sql);

        if($res==true){
            $_SESSION['notice-delete'] = "<div class='successfuly-done'>Successfully Deleted Notice.</div>";
            header('location:'.SITEURL.'customerShop/notification-all.php');
        } else {
            $_SESSION['notice-delete'] = "<div class='Failed-to-do'>Failed to Delete Notice.</div>";
            header('location:'.SITEURL.'customerShop/notification-all.php');
        }
    } else {
        header('location:'.SITEURL.'customerShop/notification-all.php');
    }
?>