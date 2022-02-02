<?php 
    include('../config/constants.php'); 

    if(isset($_GET['id'])){
        $id = $_GET['id'];

        $sql = "DELETE FROM tbl_vendor WHERE id=$id";

        $res = mysqli_query($conn,$sql);

        if($res==true){
            $_SESSION['vendor-delete'] = "<div class='successfuly-done'>Successfully Deleted Vendor Company.</div>";
            header('location:'.SITEURL.'admin/view-vendor.php');
        } else {
            $_SESSION['vendor-delete'] = "<div class='Failed-to-do'>Failed to Delete Vendor Company.</div>";
            header('location:'.SITEURL.'admin/view-vendor.php');
        }
    } else {
        header('location:'.SITEURL.'admin/view-vendor.php');
    }
?>