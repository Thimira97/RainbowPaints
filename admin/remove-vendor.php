<?php 
    include('../config/constants.php'); 

    if(isset($_GET['id'])){
        $id = $_GET['id'];

        $sql = "DELETE FROM tbl_vendor WHERE id=$id";

        $res = mysqli_query($conn,$sql);

        if($res==true){
            $_SESSION['remove'] = "<div class='successfuly-done'>Successfully Removed.</div>";
            header('location:'.SITEURL.'admin/approve-vendor.php');
        } else {
            $_SESSION['remove'] = "<div class='Failed-to-do'>Failed to Removed.</div>";
            header('location:'.SITEURL.'admin/approve-vendor.php');
        }
    } else {
        header('location:'.SITEURL.'admin/approve-vendor.php');
    }
?>