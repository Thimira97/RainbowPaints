<?php 
    include('../config/constants.php'); 

    if(isset($_GET['id'])){
        $id = $_GET['id'];

        $sql = "DELETE FROM tbl_purchase WHERE id=$id";

        $res = mysqli_query($conn,$sql);

        if($res==true){
            $_SESSION['purchase-delete'] = "<div class='successfuly-done'>Successfully Deleted Purchase.</div>";
            header('location:'.SITEURL.'admin/view-raw-purchase.php');
        } else {
            $_SESSION['purchase-delete'] = "<div class='Failed-to-do'>Failed to Delete Purchase.</div>";
            header('location:'.SITEURL.'admin/view-raw-purchase.php');
        }
    } else {
        header('location:'.SITEURL.'admin/view-raw-purchase.php');
    }
?>